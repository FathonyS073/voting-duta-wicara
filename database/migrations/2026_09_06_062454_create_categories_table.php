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
    Schema::create('categories', function (Blueprint $table) {

        $table->id();

        // Relasi ke event
        $table->foreignId('event_id')
              ->constrained()
              ->cascadeOnDelete();


        // Nama kategori
        $table->string('name');


        // Deskripsi kategori
        $table->text('description')->nullable();


        // Harga per vote
        $table->integer('vote_price')
              ->default(2000);


        // Status kategori
        $table->boolean('status')
              ->default(true);


        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
