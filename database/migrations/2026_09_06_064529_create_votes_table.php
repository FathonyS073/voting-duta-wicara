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
    Schema::create('votes', function (Blueprint $table) {
    
        $table->id();
    
    
        // Relasi event
        $table->foreignId('event_id')
              ->constrained()
              ->cascadeOnDelete();
    
    
        // Relasi transaksi
        $table->foreignId('transaction_id')
              ->constrained()
              ->cascadeOnDelete();
    
    
        // Relasi kategori
        $table->foreignId('category_id')
              ->constrained()
              ->cascadeOnDelete();
    
    
        // Relasi kandidat
        $table->foreignId('candidate_id')
              ->constrained()
              ->cascadeOnDelete();
    
    
    
        // Jumlah vote
        $table->integer('vote_amount');
    
    
        $table->timestamps();
    
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
