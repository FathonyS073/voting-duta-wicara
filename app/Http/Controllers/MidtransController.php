<?php

namespace App\Http\Controllers;

use App\Models\PaymentLog;
use App\Models\Transaction;
use App\Models\Vote;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class MidtransController extends Controller
{
    protected MidtransService $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }


    /*
    |--------------------------------------------------------------------------
    | Generate Midtrans Snap Token
    |--------------------------------------------------------------------------
    */
public function token(string $invoice)
{
    try {

        $transaction = Transaction::with([
            'candidate',
            'event',
            'category',
        ])
            ->where('invoice_number', $invoice)
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Transaksi sudah dibayar
        |--------------------------------------------------------------------------
        */

        if ($transaction->payment_status === 'paid') {
            return response()->json([
                'message' => 'Transaksi ini sudah dibayar.',
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Transaksi sudah gagal / expired
        |--------------------------------------------------------------------------
        */

        if ($transaction->payment_status === 'failed') {
            return response()->json([
                'message' => 'Transaksi ini sudah tidak dapat dibayar.',
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Gunakan kembali Snap Token yang sudah pernah dibuat
        |--------------------------------------------------------------------------
        |
        | Ini penting ketika:
        |
        | - customer sudah memilih QRIS
        | - status transaksi menjadi pending
        | - popup ditutup
        | - customer ingin melanjutkan pembayaran
        |
        */

        if (!empty($transaction->snap_token)) {

            return response()->json([
                'snap_token' => $transaction->snap_token,
            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Belum memiliki Snap Token → buat token baru
        |--------------------------------------------------------------------------
        */

        $snapToken = $this->midtransService
            ->createTransaction($transaction);


        /*
        |--------------------------------------------------------------------------
        | Simpan token agar bisa digunakan kembali
        |--------------------------------------------------------------------------
        */

        $transaction->snap_token = $snapToken;
        $transaction->save();


        return response()->json([
            'snap_token' => $snapToken,
        ]);

    } catch (Throwable $e) {

        Log::error('Midtrans Snap Token Error', [
            'invoice' => $invoice,
            'message' => $e->getMessage(),
        ]);


        return response()->json([
            'message' => 'Gagal membuat pembayaran.',
        ], 500);
    }
}


    /*
    |--------------------------------------------------------------------------
    | Midtrans Notification / Webhook
    |--------------------------------------------------------------------------
    */
    public function notification(Request $request)
    {
        try {

            /*
            |--------------------------------------------------------------------------
            | Ambil data asli dari request Midtrans
            |--------------------------------------------------------------------------
            */

            $orderId = (string) $request->input('order_id', '');

            $statusCode = (string) $request->input('status_code', '');

            $grossAmount = (string) $request->input('gross_amount', '');

            $signatureKey = (string) $request->input('signature_key', '');

            $incomingTransactionId = (string) $request->input(
                'transaction_id',
                ''
            );


            /*
            |--------------------------------------------------------------------------
            | Validasi field penting
            |--------------------------------------------------------------------------
            */

            if (
                $orderId === '' ||
                $statusCode === '' ||
                $grossAmount === '' ||
                $signatureKey === '' ||
                $incomingTransactionId === ''
            ) {

                Log::warning('Invalid Midtrans notification payload', [
                    'order_id' => $orderId,
                ]);


                return response()->json([
                    'message' => 'Invalid notification payload.',
                ], 400);
            }



            /*
            |--------------------------------------------------------------------------
            | Verifikasi Signature Midtrans
            |--------------------------------------------------------------------------
            |
            | Formula:
            |
            | SHA512(
            |     order_id +
            |     status_code +
            |     gross_amount +
            |     ServerKey
            | )
            |
            */

            $serverKey = (string) config('midtrans.server_key');


            $expectedSignature = hash(
                'sha512',
                $orderId .
                $statusCode .
                $grossAmount .
                $serverKey
            );


            if (!hash_equals($expectedSignature, $signatureKey)) {

                Log::warning('Invalid Midtrans signature', [
                    'order_id' => $orderId,
                ]);


                return response()->json([
                    'message' => 'Invalid signature.',
                ], 403);
            }



            /*
            |--------------------------------------------------------------------------
            | Cari transaksi lokal
            |--------------------------------------------------------------------------
            */

            $transaction = Transaction::where(
                'invoice_number',
                $orderId
            )->first();


            if (!$transaction) {

                Log::warning('Midtrans transaction not found', [
                    'order_id' => $orderId,
                ]);


                return response()->json([
                    'message' => 'Transaction not found.',
                ], 404);
            }



            /*
            |--------------------------------------------------------------------------
            | Verifikasi Nominal Pembayaran
            |--------------------------------------------------------------------------
            |
            | Contoh:
            |
            | Database : Rp10.000
            | Midtrans : 10000.00
            |
            | Harus sama.
            |
            */

            if (!is_numeric($grossAmount)) {

                Log::warning('Invalid Midtrans gross amount', [
                    'order_id' => $orderId,
                ]);


                return response()->json([
                    'message' => 'Invalid payment amount.',
                ], 422);
            }


            $expectedAmount = number_format(
                (float) $transaction->total_amount,
                2,
                '.',
                ''
            );


            $receivedAmount = number_format(
                (float) $grossAmount,
                2,
                '.',
                ''
            );


            if (!hash_equals($expectedAmount, $receivedAmount)) {

                Log::warning('Midtrans amount mismatch', [
                    'order_id' => $orderId,
                    'expected_amount' => $expectedAmount,
                    'received_amount' => $receivedAmount,
                ]);


                return response()->json([
                    'message' => 'Payment amount mismatch.',
                ], 422);
            }



            /*
            |--------------------------------------------------------------------------
            | Ambil status langsung dari Midtrans
            |--------------------------------------------------------------------------
            |
            | Midtrans Notification SDK melakukan pengecekan status transaksi
            | menggunakan Server Key.
            |
            */

            $notification = new \Midtrans\Notification();


            $midtransOrderId = (string) ($notification->order_id ?? '');

            $midtransTransactionId = (string) (
                $notification->transaction_id ?? ''
            );

            $transactionStatus = (string) (
                $notification->transaction_status ?? ''
            );

            $midtransStatusCode = (string) (
                $notification->status_code ?? ''
            );

            $midtransGrossAmount = (string) (
                $notification->gross_amount ?? ''
            );

            $fraudStatus = $notification->fraud_status ?? null;

            $paymentMethod = $notification->payment_type ?? null;

            $paymentReference = $notification->transaction_id ?? null;



            /*
            |--------------------------------------------------------------------------
            | Cocokkan data Request dengan data Midtrans
            |--------------------------------------------------------------------------
            */

            if (
                $midtransOrderId !== $orderId ||
                $midtransTransactionId !== $incomingTransactionId
            ) {

                Log::warning('Midtrans notification identity mismatch', [
                    'order_id' => $orderId,
                ]);


                return response()->json([
                    'message' => 'Transaction identity mismatch.',
                ], 403);
            }



            /*
            |--------------------------------------------------------------------------
            | Verifikasi nominal dari hasil pengecekan Midtrans
            |--------------------------------------------------------------------------
            */

            if (
                !is_numeric($midtransGrossAmount) ||
                number_format(
                    (float) $midtransGrossAmount,
                    2,
                    '.',
                    ''
                ) !== $expectedAmount
            ) {

                Log::warning('Midtrans verified amount mismatch', [
                    'order_id' => $orderId,
                ]);


                return response()->json([
                    'message' => 'Verified payment amount mismatch.',
                ], 422);
            }



            /*
            |--------------------------------------------------------------------------
            | Simpan Webhook Valid ke Payment Log
            |--------------------------------------------------------------------------
            */

            PaymentLog::create([
                'transaction_id' => $transaction->id,
                'gateway' => 'midtrans',
                'status' => $transactionStatus,
                'response' => $request->all(),
            ]);



            /*
            |--------------------------------------------------------------------------
            | Atomic Payment Processing
            |--------------------------------------------------------------------------
            */

            DB::transaction(function () use (
                $orderId,
                $transactionStatus,
                $midtransStatusCode,
                $fraudStatus,
                $paymentMethod,
                $paymentReference
            ) {

                /*
                |--------------------------------------------------------------------------
                | Lock Transaction
                |--------------------------------------------------------------------------
                */

                $transaction = Transaction::where(
                    'invoice_number',
                    $orderId
                )
                    ->lockForUpdate()
                    ->firstOrFail();



                /*
                |--------------------------------------------------------------------------
                | Tentukan apakah pembayaran benar-benar SUCCESS
                |--------------------------------------------------------------------------
                |
                | Syarat:
                |
                | status_code = 200
                |
                | transaction_status:
                | settlement / capture
                |
                | fraud_status:
                | accept atau tidak tersedia
                |
                */

                $fraudAccepted =
                    $fraudStatus === null ||
                    $fraudStatus === 'accept';


                $isSuccess =
                    $midtransStatusCode === '200' &&
                    $fraudAccepted &&
                    in_array(
                        $transactionStatus,
                        [
                            'settlement',
                            'capture',
                        ],
                        true
                    );



                /*
                |--------------------------------------------------------------------------
                | PAYMENT SUCCESS
                |--------------------------------------------------------------------------
                */

                if ($isSuccess) {

                    $transaction->update([
                        'payment_status' => 'paid',

                        'payment_method' =>
                            $paymentMethod
                            ?? $transaction->payment_method,

                        'payment_reference' =>
                            $paymentReference
                            ?? $transaction->payment_reference,

                        'paid_at' =>
                            $transaction->paid_at
                            ?? now(),
                    ]);



                    /*
                    |--------------------------------------------------------------------------
                    | Buat Vote
                    |--------------------------------------------------------------------------
                    |
                    | Proteksi:
                    |
                    | 1. lockForUpdate()
                    | 2. firstOrCreate()
                    | 3. UNIQUE votes.transaction_id
                    |
                    */

                    Vote::firstOrCreate(
                        [
                            'transaction_id' => $transaction->id,
                        ],
                        [
                            'event_id' => $transaction->event_id,

                            'category_id' =>
                                $transaction->category_id,

                            'candidate_id' =>
                                $transaction->candidate_id,

                            'vote_amount' =>
                                $transaction->vote_amount,
                        ]
                    );


                    return;
                }



                /*
                |--------------------------------------------------------------------------
                | Jangan turunkan transaksi yang sudah PAID
                |--------------------------------------------------------------------------
                */

                if ($transaction->payment_status === 'paid') {
                    return;
                }



                /*
                |--------------------------------------------------------------------------
                | PAYMENT PENDING
                |--------------------------------------------------------------------------
                */

                if ($transactionStatus === 'pending') {

                    $transaction->update([
                        'payment_status' => 'pending',

                        'payment_method' =>
                            $paymentMethod
                            ?? $transaction->payment_method,

                        'payment_reference' =>
                            $paymentReference
                            ?? $transaction->payment_reference,
                    ]);


                    return;
                }



                /*
                |--------------------------------------------------------------------------
                | PAYMENT FAILED
                |--------------------------------------------------------------------------
                */

                if (
                    in_array(
                        $transactionStatus,
                        [
                            'deny',
                            'cancel',
                            'expire',
                        ],
                        true
                    )
                ) {

                    $transaction->update([
                        'payment_status' => 'failed',

                        'payment_method' =>
                            $paymentMethod
                            ?? $transaction->payment_method,

                        'payment_reference' =>
                            $paymentReference
                            ?? $transaction->payment_reference,
                    ]);
                }

            });



            return response()->json([
                'message' => 'Notification received.',
            ]);

        } catch (Throwable $e) {

            Log::error('Midtrans Notification Error', [
                'message' => $e->getMessage(),
            ]);


            return response()->json([
                'message' => 'Notification processing failed.',
            ], 500);
        }
    }
}