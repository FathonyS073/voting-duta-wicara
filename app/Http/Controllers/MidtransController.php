<?php

namespace App\Http\Controllers;

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


    /**
     * Generate Snap Token
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


    /**
     * Midtrans Notification / Webhook
     */
    public function notification(Request $request)
    {
        try {

            $notification = new \Midtrans\Notification();


            $orderId = $notification->order_id;

            $transactionStatus = $notification->transaction_status;

            $fraudStatus = $notification->fraud_status ?? null;


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
             * SUCCESS
             */
            if (
                $transactionStatus === 'settlement' ||
                (
                    $transactionStatus === 'capture' &&
                    $fraudStatus === 'accept'
                )
            ) {

                DB::transaction(function () use (
                    $transaction,
                    $notification
                ) {

                    /*
                     * Update transaction menjadi paid
                     */
                    $transaction->update([
                        'payment_status' => 'paid',
                        'payment_reference' => $notification->transaction_id,
                        'paid_at' => $transaction->paid_at ?? now(),
                    ]);


                    /*
                     * Buat record vote
                     *
                     * firstOrCreate digunakan agar
                     * satu transaksi hanya menghasilkan
                     * satu record vote.
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

                });

            }


            /*
             * PENDING
             */
            elseif ($transactionStatus === 'pending') {

                $transaction->update([
                    'payment_status' => 'pending',
                    'payment_reference' => $notification->transaction_id,
                ]);

            }


            /*
             * FAILED
             */
            elseif (
                $transactionStatus === 'deny' ||
                $transactionStatus === 'cancel' ||
                $transactionStatus === 'expire'
            ) {

                $transaction->update([
                    'payment_status' => 'failed',
                    'payment_reference' => $notification->transaction_id,
                ]);

            }


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