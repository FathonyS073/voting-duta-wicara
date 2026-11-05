<?php

namespace App\Http\Controllers;

use App\Models\PaymentLog;
use App\Models\Transaction;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class KaseraWebhookController extends Controller
{
    public function handle(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Ambil RAW BODY
        |--------------------------------------------------------------------------
        |
        | Signature Kasera harus diverifikasi menggunakan raw request body.
        | Jangan menggunakan $request->all() untuk verifikasi signature.
        |
        */

        $rawBody = $request->getContent();

        $signatureHeader = (string) $request->header(
            'Kasera-Signature-V1',
            ''
        );

        $webhookSecret = (string) config(
            'services.kasera.webhook_secret'
        );


        /*
        |--------------------------------------------------------------------------
        | Verifikasi Signature
        |--------------------------------------------------------------------------
        */
        $isValidSignature = $this->isValidSignature(
    $rawBody,
    $signatureHeader,
    $webhookSecret
);

/*
|--------------------------------------------------------------------------
| TEMPORARY DEBUG SIGNATURE
|--------------------------------------------------------------------------
*/

$debugTimestamp = null;
$debugV1Count = 0;

foreach (explode(',', $signatureHeader) as $part) {
    $part = trim($part);

    if (str_starts_with($part, 't=')) {
        $debugTimestamp = substr($part, 2);
    }

    if (str_starts_with($part, 'v1=')) {
        $debugV1Count++;
    }
}

$legacyHeader = (string) $request->header(
    'Kasera-Signature',
    ''
);

$legacyMatches = false;

if (
    $legacyHeader !== '' &&
    $webhookSecret !== ''
) {
    $legacyExpected = hash_hmac(
        'sha256',
        $rawBody,
        $webhookSecret
    );

    $legacyMatches = hash_equals(
        $legacyExpected,
        trim($legacyHeader)
    );
}

Log::info('Kasera webhook signature diagnostic', [
    'v1_header_present' =>
        $signatureHeader !== '',

    'v1_header_length' =>
        strlen($signatureHeader),

    'v1_count' =>
        $debugV1Count,

    'timestamp_present' =>
        $debugTimestamp !== null,

    'timestamp_valid' =>
        $debugTimestamp !== null
        && ctype_digit($debugTimestamp),

    'timestamp_age_seconds' =>
        (
            $debugTimestamp !== null &&
            ctype_digit($debugTimestamp)
        )
            ? abs(time() - (int) $debugTimestamp)
            : null,

    'raw_body_length' =>
        strlen($rawBody),

    'secret_loaded' =>
        $webhookSecret !== '',

    'secret_length' =>
        strlen($webhookSecret),

    'secret_prefix_ok' =>
        str_starts_with(
            $webhookSecret,
            'whsec_'
        ),

    'legacy_header_present' =>
        $legacyHeader !== '',

    'legacy_matches' =>
        $legacyMatches,

    'v1_matches' =>
        $isValidSignature,
]);

if (!$isValidSignature) {
    Log::warning(
        'Kasera webhook invalid signature'
    );

    return response()->json([
        'message' => 'Invalid signature.',
    ], 400);
}


        /*
        |--------------------------------------------------------------------------
        | Decode Event
        |--------------------------------------------------------------------------
        */

        $event = json_decode(
            $rawBody,
            true
        );

        if (!is_array($event)) {
            return response()->json([
                'message' => 'Invalid JSON.',
            ], 400);
        }


        $eventId = $event['id'] ?? null;

        $eventType = $event['type'] ?? null;

        $data = is_array($event['data'] ?? null)
            ? $event['data']
            : [];


        if (
            empty($eventId) ||
            empty($eventType)
        ) {
            return response()->json([
                'message' => 'Invalid event.',
            ], 400);
        }


        /*
|--------------------------------------------------------------------------
| Cocokkan Kasera-Event-Id
|--------------------------------------------------------------------------
|
| Kasera dapat merepresentasikan event ID dengan atau tanpa prefix "evt_".
| Normalisasi keduanya sebelum dibandingkan.
|
*/

$headerEventId = (string) $request->header(
    'Kasera-Event-Id',
    ''
);

if ($headerEventId !== '') {

    $bodyEventId = (string) $eventId;

    $normalizedBodyEventId = str_starts_with(
        $bodyEventId,
        'evt_'
    )
        ? substr($bodyEventId, 4)
        : $bodyEventId;

    $normalizedHeaderEventId = str_starts_with(
        $headerEventId,
        'evt_'
    )
        ? substr($headerEventId, 4)
        : $headerEventId;

    if (
        !hash_equals(
            $normalizedBodyEventId,
            $normalizedHeaderEventId
        )
    ) {
        Log::warning(
            'Kasera webhook event id mismatch',
            [
                'event_id' => $eventId,
            ]
        );

        return response()->json([
            'message' => 'Event ID mismatch.',
        ], 400);
    }
}


        /*
        |--------------------------------------------------------------------------
        | Hanya proses event pembayaran
        |--------------------------------------------------------------------------
        */

        $allowedEvents = [
            'payment.paid',
            'payment.expired',
            'payment.failed',
        ];

        if (
            !in_array(
                $eventType,
                $allowedEvents,
                true
            )
        ) {
            return response()->json([
                'message' => 'Event ignored.',
            ], 200);
        }


        /*
        |--------------------------------------------------------------------------
        | Validasi Sandbox / Live
        |--------------------------------------------------------------------------
        */

        $mode = (string) config(
            'services.kasera.mode',
            'sandbox'
        );

        $livemode = (bool) (
            $event['livemode'] ?? false
        );

        $expectedLivemode =
            $mode === 'live';


        if ($livemode !== $expectedLivemode) {
            Log::warning(
                'Kasera webhook mode mismatch',
                [
                    'event_id' => $eventId,
                    'livemode' => $livemode,
                    'configured_mode' => $mode,
                ]
            );

            return response()->json([
                'message' => 'Mode mismatch.',
            ], 400);
        }


        /*
        |--------------------------------------------------------------------------
        | Ambil Data Payment
        |--------------------------------------------------------------------------
        */

        $paymentRequestId =
            $data['payment_request_id'] ?? null;

        $externalId =
            $data['external_id'] ?? null;

        $amount =
            $data['amount'] ?? null;


        if (
            empty($paymentRequestId) ||
            empty($externalId) ||
            !is_numeric($amount)
        ) {
            return response()->json([
                'message' => 'Incomplete payment data.',
            ], 400);
        }


        /*
        |--------------------------------------------------------------------------
        | Cari transaksi berdasarkan payment_request_id Kasera
        |--------------------------------------------------------------------------
        |
        | payment_reference Vooters berisi payreq_...
        |
        */

        $transaction = Transaction::where(
            'payment_reference',
            $paymentRequestId
        )
            ->where(
                'payment_gateway',
                'kasera'
            )
            ->first();


        /*
        |--------------------------------------------------------------------------
        | Event valid tetapi bukan transaksi Vooters
        |--------------------------------------------------------------------------
        */

        if (!$transaction) {
            Log::warning(
                'Kasera webhook transaction not found',
                [
                    'event_id' => $eventId,
                    'payment_request_id' =>
                        $paymentRequestId,
                ]
            );

            return response()->json([
                'message' => 'Event ignored.',
            ], 200);
        }


        try {

            $result = DB::transaction(
                function () use (
                    $transaction,
                    $event,
                    $eventId,
                    $eventType,
                    $externalId,
                    $amount,
                    $data
                ) {

                    /*
                    |--------------------------------------------------------------------------
                    | Lock transaksi
                    |--------------------------------------------------------------------------
                    */

                    $transaction = Transaction::whereKey(
                        $transaction->id
                    )
                        ->lockForUpdate()
                        ->firstOrFail();


                    /*
                    |--------------------------------------------------------------------------
                    | Deduplikasi Event
                    |--------------------------------------------------------------------------
                    */

                    $alreadyProcessed =
                        PaymentLog::where(
                            'gateway_event_id',
                            $eventId
                        )->exists();


                    if ($alreadyProcessed) {
                        return 'duplicate';
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Validasi Invoice
                    |--------------------------------------------------------------------------
                    */

                    if (
                        !hash_equals(
                            (string) $transaction->invoice_number,
                            (string) $externalId
                        )
                    ) {

                        PaymentLog::create([
                            'transaction_id' =>
                                $transaction->id,

                            'gateway' => 'kasera',

                            'gateway_event_id' =>
                                $eventId,

                            'status' =>
                                'rejected_identity_mismatch',

                            'response' => $event,
                        ]);


                        Log::warning(
                            'Kasera webhook invoice mismatch',
                            [
                                'event_id' => $eventId,
                                'transaction_id' =>
                                    $transaction->id,
                            ]
                        );


                        return 'rejected';
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Validasi Nominal
                    |--------------------------------------------------------------------------
                    */

                    if (
                        (int) $transaction->total_amount
                        !==
                        (int) $amount
                    ) {

                        PaymentLog::create([
                            'transaction_id' =>
                                $transaction->id,

                            'gateway' => 'kasera',

                            'gateway_event_id' =>
                                $eventId,

                            'status' =>
                                'rejected_amount_mismatch',

                            'response' => $event,
                        ]);


                        Log::warning(
                            'Kasera webhook amount mismatch',
                            [
                                'event_id' => $eventId,

                                'transaction_id' =>
                                    $transaction->id,

                                'expected_amount' =>
                                    (int) $transaction->total_amount,

                                'received_amount' =>
                                    (int) $amount,
                            ]
                        );


                        return 'rejected';
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | PAYMENT PAID
                    |--------------------------------------------------------------------------
                    */

                    if (
                        $eventType === 'payment.paid'
                    ) {

                        $paidAt =
                            !empty($data['paid_at'])
                                ? Carbon::parse(
                                    $data['paid_at']
                                )
                                : now();


                        $transaction->update([

                            'payment_gateway' =>
                                'kasera',

                            'payment_status' =>
                                'paid',

                            'paid_at' =>
                                $transaction->paid_at
                                ?? $paidAt,

                        ]);


                        /*
                        |--------------------------------------------------------------------------
                        | Buat Vote
                        |--------------------------------------------------------------------------
                        |
                        | firstOrCreate + unique transaction_id
                        | mencegah vote ganda.
                        |
                        */

                        Vote::firstOrCreate(
                            [
                                'transaction_id' =>
                                    $transaction->id,
                            ],
                            [
                                'event_id' =>
                                    $transaction->event_id,

                                'category_id' =>
                                    $transaction->category_id,

                                'candidate_id' =>
                                    $transaction->candidate_id,

                                'vote_amount' =>
                                    $transaction->vote_amount,
                            ]
                        );
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | PAYMENT EXPIRED
                    |--------------------------------------------------------------------------
                    */

                    if (
                        $eventType === 'payment.expired' &&
                        $transaction->payment_status !== 'paid'
                    ) {
                        $transaction->update([
                            'payment_status' =>
                                'expired',
                        ]);
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | PAYMENT FAILED
                    |--------------------------------------------------------------------------
                    */

                    if (
                        $eventType === 'payment.failed' &&
                        $transaction->payment_status !== 'paid'
                    ) {
                        $transaction->update([
                            'payment_status' =>
                                'failed',
                        ]);
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Simpan Webhook Log
                    |--------------------------------------------------------------------------
                    */

                    PaymentLog::create([

                        'transaction_id' =>
                            $transaction->id,

                        'gateway' =>
                            'kasera',

                        'gateway_event_id' =>
                            $eventId,

                        'status' =>
                            $eventType,

                        'response' =>
                            $event,

                    ]);


                    return 'processed';
                },
                3
            );


            return response()->json([
                'message' => 'Webhook accepted.',
                'result' => $result,
            ], 200);

        } catch (Throwable $e) {

            Log::error(
                'Kasera webhook processing error',
                [
                    'event_id' => $eventId,
                    'message' => $e->getMessage(),
                ]
            );


            /*
            |--------------------------------------------------------------------------
            | 500 sengaja
            |--------------------------------------------------------------------------
            |
            | Agar Kasera melakukan retry jika terjadi
            | kegagalan internal aplikasi/database.
            |
            */

            return response()->json([
                'message' =>
                    'Webhook processing failed.',
            ], 500);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Verifikasi Kasera-Signature-V1
    |--------------------------------------------------------------------------
    */

    private function isValidSignature(
        string $rawBody,
        string $header,
        string $secret,
        int $toleranceSeconds = 300
    ): bool {

        if (
            $header === '' ||
            $secret === ''
        ) {
            return false;
        }


        $timestamp = null;

        $signatures = [];


        foreach (
            explode(',', $header) as $part
        ) {

            $part = trim($part);


            if (
                str_starts_with(
                    $part,
                    't='
                )
            ) {
                $timestamp =
                    substr($part, 2);

                continue;
            }


            if (
                str_starts_with(
                    $part,
                    'v1='
                )
            ) {
                $signatures[] =
                    substr($part, 3);
            }
        }


        if (
            $timestamp === null ||
            !ctype_digit($timestamp) ||
            empty($signatures)
        ) {
            return false;
        }


        $timestampInteger =
            (int) $timestamp;


        /*
        |--------------------------------------------------------------------------
        | Anti Replay
        |--------------------------------------------------------------------------
        */

        if (
            abs(
                time() -
                $timestampInteger
            ) > $toleranceSeconds
        ) {
            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | HMAC SHA-256
        |--------------------------------------------------------------------------
        */

        $signedPayload =
            $timestamp .
            '.' .
            $rawBody;


        $expectedSignature =
            hash_hmac(
                'sha256',
                $signedPayload,
                $secret
            );


        /*
        |--------------------------------------------------------------------------
        | Bisa terdapat lebih dari satu v1
        |--------------------------------------------------------------------------
        |
        | Kasera dapat mengirim dua signature ketika
        | signing secret sedang dirotasi.
        |
        */

        foreach (
            $signatures as $signature
        ) {

            $signature =
                strtolower(
                    trim($signature)
                );


            if (
                strlen($signature) !== 64 ||
                !ctype_xdigit($signature)
            ) {
                continue;
            }


            if (
                hash_equals(
                    $expectedSignature,
                    $signature
                )
            ) {
                return true;
            }
        }


        return false;
    }
}