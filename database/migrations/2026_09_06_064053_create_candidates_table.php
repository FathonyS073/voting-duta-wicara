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
    Schema::create('candidates', function (Blueprint $table) {

        $table->id();


        // Relasi ke event
        $table->foreignId('event_id')
              ->constrained()
              ->cascadeOnDelete();


        // Informasi peserta
        $table->string('name');

        $table->string('slug')
              ->unique();


        // Foto utama
        $table->string('photo')
              ->nullable();


        // Asal daerah
        $table->string('city')
              ->nullable();


        $table->string('province')
              ->default('Jawa Timur');


        // Profil
        $table->text('bio')
              ->nullable();


        // Pendidikan
        $table->string('education')
              ->nullable();


        // Prestasi
        $table->text('achievement')
              ->nullable();


        // Visi misi
        $table->text('vision')
              ->nullable();


        $table->text('mission')
              ->nullable();


        // Sosial media
        $table->string('instagram')
              ->nullable();


        $table->string('tiktok')
              ->nullable();


        // Status finalis
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
        Schema::dropIfExists('candidates');
    }
};
