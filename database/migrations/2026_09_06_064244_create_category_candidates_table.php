<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('category_candidates', function (Blueprint $table) {
            $table->id();
            /*
            |--------------------------------------------------------------------------
            | Relasi Category
            |--------------------------------------------------------------------------
            */
            $table->foreignId('category_id')
                  ->constrained()
                  ->cascadeOnDelete();
            /*
            |--------------------------------------------------------------------------
            | Relasi Candidate
            |--------------------------------------------------------------------------
            */
            $table->foreignId('candidate_id')
                  ->constrained()
                  ->cascadeOnDelete();
            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */
            $table->index('category_id');
            $table->index('candidate_id');
            /*
            |--------------------------------------------------------------------------
            | Hindari duplikasi
            |--------------------------------------------------------------------------
            */
            $table->unique([
                'category_id',
                'candidate_id'
            ]);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('category_candidates');
    }
};