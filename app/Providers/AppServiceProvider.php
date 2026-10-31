<?php

namespace App\Providers;

use App\Models\User;
use Filament\Facades\Filament;
use Filament\Support\Facades\FilamentTimezone;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        /*
        |--------------------------------------------------------------------------
        | FILAMENT TIMEZONE
        |--------------------------------------------------------------------------
        */

        FilamentTimezone::set('Asia/Jakarta');

        /*
        |--------------------------------------------------------------------------
        | PASSWORD RESET URL
        |--------------------------------------------------------------------------
        |
        | Mengarahkan link reset password Laravel ke halaman reset password
        | milik panel Admin Filament Vooters.
        |
        */

        ResetPassword::createUrlUsing(
            function (User $user, string $token): string {
                return Filament::getPanel('admin')
                    ->getResetPasswordUrl($token, $user);
            }
        );
    }
}