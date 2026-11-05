<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payment_logs', function (Blueprint $table) {
            $table->string('gateway_event_id')
                ->nullable()
                ->unique()
                ->after('gateway');
        });
    }

    public function down(): void
    {
        Schema::table('payment_logs', function (Blueprint $table) {
            $table->dropUnique(
                'payment_logs_gateway_event_id_unique'
            );

            $table->dropColumn('gateway_event_id');
        });
    }
};