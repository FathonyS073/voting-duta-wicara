<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class KaseraPayService
{
    protected string $baseUrl;

    protected string $apiKey;

    public function __construct()
    {
        $this->baseUrl = rtrim(
            (string) config('services.kasera.base_url'),
            '/'
        );

        $this->apiKey = (string) config(
            'services.kasera.api_key'
        );

        if ($this->apiKey === '') {
            throw new RuntimeException(
                'Kasera API key belum dikonfigurasi.'
            );
        }
    }

    /**
     * Membuat payment request Kasera Hosted Checkout.
     */
    public function createPayment(
        Transaction $transaction
    ): array {
        $payload = [
            'amount' => (int) $transaction->total_amount,

            'description' => sprintf(
                'Pembayaran voting Vooters - %s',
                $transaction->invoice_number
            ),

            /*
            |--------------------------------------------------------------------------
            | Reference Vooters
            |--------------------------------------------------------------------------
            |
            | external_id digunakan untuk menghubungkan payment request
            | Kasera dengan invoice internal Vooters.
            |
            */
            'external_id' => $transaction->invoice_number,

            /*
            |--------------------------------------------------------------------------
            | Hosted Checkout
            |--------------------------------------------------------------------------
            |
            | Dengan object checkout, Kasera akan menyediakan halaman
            | checkout untuk customer.
            |
            */
            'checkout' => [
                'steps' => [
                    'customer',
                    'payment_method',
                    'payment',
                ],

                'is_name_required' => true,
                'is_email_required' => false,
                'is_phone_required' => false,
            ],

            /*
            |--------------------------------------------------------------------------
            | Return URL
            |--------------------------------------------------------------------------
            |
            | Setelah pembayaran selesai, customer dapat kembali
            | ke halaman status transaksi Vooters.
            |
            | Return URL BUKAN bukti bahwa pembayaran berhasil.
            | Status PAID tetap ditentukan dari webhook Kasera.
            |
            */
            'return_url' => route(
                'payment.status',
                $transaction->invoice_number
            ),
        ];


        /*
        |--------------------------------------------------------------------------
        | Idempotency Key
        |--------------------------------------------------------------------------
        |
        | Invoice yang sama selalu menggunakan idempotency key yang sama.
        | Jika request terkirim ulang karena timeout/retry, Kasera
        | mengembalikan payment request yang sama dan tidak membuat
        | pembayaran duplikat.
        |
        */
        $idempotencyKey =
            'vooters-' . $transaction->invoice_number;


        $response = Http::withToken($this->apiKey)
            ->acceptJson()
            ->asJson()
            ->withHeaders([
                'Idempotency-Key' => $idempotencyKey,
            ])
            ->timeout(30)
            ->post(
                $this->baseUrl . '/transactions',
                $payload
            );


        $this->ensureSuccessful($response);


        $data = $response->json();


        /*
        |--------------------------------------------------------------------------
        | Validasi Response
        |--------------------------------------------------------------------------
        |
        | Hosted Checkout harus memberikan ID payment request
        | dan checkout_url.
        |
        */
        if (
            empty($data['id']) ||
            empty($data['checkout_url'])
        ) {
            throw new RuntimeException(
                'Response Kasera tidak memiliki payment request ID atau checkout URL.'
            );
        }


        return $data;
    }


    /**
     * Pastikan response API berhasil.
     */
    protected function ensureSuccessful(
        Response $response
    ): void {
        if ($response->successful()) {
            return;
        }


        throw new RuntimeException(
            'Kasera API Error [' .
            $response->status() .
            ']: ' .
            $response->body()
        );
    }
}