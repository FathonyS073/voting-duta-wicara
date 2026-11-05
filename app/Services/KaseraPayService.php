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
     * Membuat payment request Kasera.
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

            'external_id' => $transaction->invoice_number,

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
        | Invoice yang sama selalu menggunakan key yang sama.
        | Dengan demikian retry request tidak menghasilkan
        | dua payment request Kasera.
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

        return $response->json();
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