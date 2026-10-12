<?php

namespace Tests\Feature;

use Tests\TestCase;

class ManualPaymentAdminVerificationTest extends TestCase
{
    public function test_transaction_table_supports_manual_payment_verification(): void
    {
        $table = file_get_contents(
            app_path(
                'Filament/Resources/Transactions/Tables/TransactionsTable.php'
            )
        );

        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        $this->assertStringContainsString(
            'waiting_confirmation',
            $table
        );

        $this->assertStringContainsString(
            'Menunggu Verifikasi',
            $table
        );


        /*
        |--------------------------------------------------------------------------
        | Admin Actions
        |--------------------------------------------------------------------------
        */

        $this->assertStringContainsString(
            'Lihat Bukti',
            $table
        );

        $this->assertStringContainsString(
            'Verifikasi',
            $table
        );

        $this->assertStringContainsString(
            'Tolak',
            $table
        );


        /*
        |--------------------------------------------------------------------------
        | Atomic Verification
        |--------------------------------------------------------------------------
        */

        $this->assertStringContainsString(
            'DB::transaction',
            $table
        );

        $this->assertStringContainsString(
            'lockForUpdate',
            $table
        );

        $this->assertStringContainsString(
            'Vote::firstOrCreate',
            $table
        );


        /*
        |--------------------------------------------------------------------------
        | Payment Status Transition
        |--------------------------------------------------------------------------
        */

        $this->assertStringContainsString(
            "'payment_status' => 'paid'",
            $table
        );

        $this->assertStringContainsString(
            "'payment_status' => 'failed'",
            $table
        );
    }
}