<?php

namespace Tests\Feature;

use Tests\TestCase;

class ManualQrisPaymentTest extends TestCase
{
    public function test_manual_qris_payment_route_exists(): void
    {
        $routes = file_get_contents(
            base_path('routes/web.php')
        );

        $this->assertStringContainsString(
            "payment.manual.submit",
            $routes
        );
    }

    public function test_payment_page_contains_manual_qris_option(): void
    {
        $view = file_get_contents(
            resource_path('views/voting/payment.blade.php')
        );

        $this->assertStringContainsString(
            'QRIS Manual',
            $view
        );

        $this->assertStringContainsString(
            'Coming Soon',
            $view
        );
    }

    public function test_payment_status_page_supports_waiting_confirmation(): void
    {
        $view = file_get_contents(
            resource_path('views/voting/payment-status.blade.php')
        );

        $this->assertStringContainsString(
            'waiting_confirmation',
            $view
        );
    }
}