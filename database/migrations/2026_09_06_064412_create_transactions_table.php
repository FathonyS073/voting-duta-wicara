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
    Schema::create('transactions', function (Blueprint $table) {

        $table->id();


        // Nomor transaksi
        $table->string('invoice_number')
              ->unique();


        // Relasi kategori
        $table->foreignId('category_id')
              ->constrained()
              ->cascadeOnDelete();


        // Relasi finalis
        $table->foreignId('candidate_id')
              ->constrained()
              ->cascadeOnDelete();



        // Jumlah vote yang dibeli
        $table->integer('vote_amount');



        // Total pembayaran
        $table->integer('total_amount');



        // Data pembayaran
        $table->string('payment_method')
              ->nullable();


        // Status pembayaran
        $table->enum('payment_status', [

            'pending',
            'waiting_confirmation',
            'paid',
            'failed',
            'expired'

        ])->default('pending');



        // Untuk payment gateway
        $table->string('payment_reference')
              ->nullable();



        // Jika sementara manual upload bukti
        $table->string('payment_proof')
              ->nullable();



        // Waktu pembayaran berhasil
        $table->timestamp('paid_at')
              ->nullable();



        $table->timestamps();

    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
