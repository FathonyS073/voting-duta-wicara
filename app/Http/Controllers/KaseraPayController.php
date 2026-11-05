<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\KaseraPayService;
use Illuminate\Support\Facades\Log;
use Throwable;

class KaseraPayController extends Controller
{
    protected KaseraPayService $kaseraPayService;


    public function __construct(
        KaseraPayService $kaseraPayService
    ) {
        $this->kaseraPayService = $kaseraPayService;
    }


    /*
    |--------------------------------------------------------------------------
    | Create Kasera Payment
    |--------------------------------------------------------------------------
    |
    | Membuat payment request Kasera untuk transaksi Vooters
    | kemudian mengarahkan customer ke Kasera Hosted Checkout.
    |
    | Method ini TIDAK membuat vote.
    | Vote hanya dibuat setelah webhook payment.paid terverifikasi.
    |
    */
    public function create(string $invoice)
    {
        $transaction = Transaction::with([
            'event',
            'candidate',
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
            return redirect()
                ->route(
                    'payment.status',
                    $transaction->invoice_number
                )
                ->with(
                    'info',
                    'Transaksi ini sudah dibayar.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Manual QRIS sedang menunggu verifikasi
        |--------------------------------------------------------------------------
        |
        | Jika customer sudah mengunggah bukti pembayaran manual,
        | jangan izinkan transaksi yang sama membuat pembayaran Kasera.
        |
        */

        if (
            $transaction->payment_status === 'waiting_confirmation' ||
            $transaction->payment_method === 'manual_qris'
        ) {
            return redirect()
                ->route(
                    'payment.status',
                    $transaction->invoice_number
                )
                ->with(
                    'error',
                    'Transaksi ini sedang menunggu verifikasi pembayaran manual.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Gateway lain sudah dipilih
        |--------------------------------------------------------------------------
        |
        | Mencegah satu invoice memiliki dua payment gateway aktif
        | secara bersamaan.
        |
        */

        if (
            !empty($transaction->payment_gateway) &&
            $transaction->payment_gateway !== 'kasera'
        ) {
            return redirect()
                ->route(
                    'payment.show',
                    $transaction->invoice_number
                )
                ->with(
                    'error',
                    'Transaksi ini sudah menggunakan metode pembayaran lain.'
                );
        }


        try {

            /*
            |--------------------------------------------------------------------------
            | Create Kasera Payment Request
            |--------------------------------------------------------------------------
            */

            $kasera = $this->kaseraPayService
                ->createPayment($transaction);


            /*
            |--------------------------------------------------------------------------
            | Simpan Referensi Kasera
            |--------------------------------------------------------------------------
            |
            | payment_gateway  = kasera
            | payment_reference = payreq_xxxxx
            |
            | payment_method tidak dipaksa di sini karena customer
            | dapat memilih metode pembayaran di Kasera Checkout.
            |
            */

            $transaction->update([
                'payment_gateway' => 'kasera',

                'payment_reference' => $kasera['id'],

                'payment_status' => 'pending',
            ]);


            /*
            |--------------------------------------------------------------------------
            | Redirect ke Kasera Hosted Checkout
            |--------------------------------------------------------------------------
            */

            return redirect()->away(
                $kasera['checkout_url']
            );

        } catch (Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | Log Error
            |--------------------------------------------------------------------------
            |
            | API key dan secret tidak pernah dimasukkan ke log.
            |
            */

            Log::error(
                'Kasera create payment error',
                [
                    'invoice' => $transaction->invoice_number,

                    'transaction_id' => $transaction->id,

                    'message' => $e->getMessage(),
                ]
            );


            return redirect()
                ->route(
                    'payment.show',
                    $transaction->invoice_number
                )
                ->with(
                    'error',
                    'Pembayaran Kasera belum dapat dibuat. Silakan coba kembali.'
                );
        }
    }
}