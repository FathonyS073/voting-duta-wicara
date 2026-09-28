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
            | Transaksi yang sudah dibayar tidak boleh membuat token baru
            |--------------------------------------------------------------------------
            */

            if ($transaction->payment_status === 'paid') {

                return response()->json([
                    'message' => 'Transaksi ini sudah dibayar.',
                ], 422);

            }


            $snapToken = $this->midtransService
                ->createTransaction($transaction);


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
            | Ambil Notification Midtrans
            |--------------------------------------------------------------------------
            */

            $notification = new \Midtrans\Notification();


            $orderId = $notification->order_id;

            $transactionStatus = $notification->transaction_status;

            $fraudStatus = $notification->fraud_status ?? null;

            $paymentMethod = $notification->payment_type ?? null;

            $paymentReference = $notification->transaction_id ?? null;


            /*
            |--------------------------------------------------------------------------
            | Pastikan transaksi tersedia
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
            | Simpan semua Webhook ke Payment Log
            |--------------------------------------------------------------------------
            |
            | Payment Log boleh memiliki notification berulang.
            |
            | Contoh:
            |
            | pending
            | settlement
            | settlement
            |
            | semuanya tetap dicatat.
            |
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
            |
            | lockForUpdate() memastikan dua webhook tidak memproses
            | transaction yang sama secara bersamaan.
            |
            */

            DB::transaction(function () use (
                $orderId,
                $transactionStatus,
                $fraudStatus,
                $paymentMethod,
                $paymentReference
            ) {

                /*
                |--------------------------------------------------------------------------
                | Ambil ulang transaction + LOCK ROW
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
                | PAYMENT SUCCESS
                |--------------------------------------------------------------------------
                */

                $isSuccess =
                    $transactionStatus === 'settlement' ||
                    (
                        $transactionStatus === 'capture' &&
                        $fraudStatus === 'accept'
                    );


                if ($isSuccess) {

                    /*
                    |--------------------------------------------------------------------------
                    | Update menjadi PAID
                    |--------------------------------------------------------------------------
                    |
                    | paid_at tidak ditimpa jika sebelumnya sudah ada.
                    |
                    */

                    $transaction->update([
                        'payment_status' => 'paid',
                        'payment_method' => $paymentMethod
                            ?? $transaction->payment_method,
                        'payment_reference' => $paymentReference
                            ?? $transaction->payment_reference,
                        'paid_at' => $transaction->paid_at ?? now(),
                    ]);


                    /*
                    |--------------------------------------------------------------------------
                    | Buat Vote
                    |--------------------------------------------------------------------------
                    |
                    | Perlindungan sekarang memiliki 3 lapisan:
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
                            'category_id' => $transaction->category_id,
                            'candidate_id' => $transaction->candidate_id,
                            'vote_amount' => $transaction->vote_amount,
                        ]
                    );


                    return;
                }



                /*
                |--------------------------------------------------------------------------
                | JANGAN TURUNKAN STATUS TRANSAKSI YANG SUDAH PAID
                |--------------------------------------------------------------------------
                |
                | Misalnya webhook datang:
                |
                | settlement
                | lalu pending terlambat
                |
                | transaksi tetap PAID.
                |
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
                        'payment_method' => $paymentMethod
                            ?? $transaction->payment_method,
                        'payment_reference' => $paymentReference
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
                        'payment_method' => $paymentMethod
                            ?? $transaction->payment_method,
                        'payment_reference' => $paymentReference
                            ?? $transaction->payment_reference,
                    ]);

                }

            });



            /*
            |--------------------------------------------------------------------------
            | Success Response
            |--------------------------------------------------------------------------
            */

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