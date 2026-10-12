<?php

namespace Tests\Feature;

use Tests\TestCase;

class PaymentSettingsPageTest extends TestCase
{
    public function test_payment_settings_view_uses_filament_native_form(): void
    {
        $view = file_get_contents(
            resource_path('views/filament/pages/payment-settings.blade.php')
        );

        $this->assertStringContainsString(
            '{{ $this->form }}',
            $view
        );

        $this->assertStringNotContainsString(
            '<input',
            $view
        );

        $this->assertStringNotContainsString(
            '<textarea',
            $view
        );
    }
}