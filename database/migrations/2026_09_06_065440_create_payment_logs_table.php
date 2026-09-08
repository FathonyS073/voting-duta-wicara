<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('payment_logs', function (Blueprint $table) {

        $table->id();


        $table->foreignId('transaction_id')
              ->constrained()
              ->cascadeOnDelete();


        // Nama gateway
        $table->string('gateway')
              ->nullable();


        // Status dari gateway
        $table->string('status')
              ->nullable();


        // Response JSON dari payment gateway
        $table->json('response')
              ->nullable();


        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_logs');
    }
};
