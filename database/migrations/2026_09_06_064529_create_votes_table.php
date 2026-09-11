<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('votes', function (Blueprint $table) {


            $table->id();



            /*
            |--------------------------------------------------------------------------
            | Relasi Event
            |--------------------------------------------------------------------------
            */

            $table->foreignId('event_id')
                  ->constrained()
                  ->cascadeOnDelete();



            /*
            |--------------------------------------------------------------------------
            | Relasi Transaction
            |--------------------------------------------------------------------------
            */

            $table->foreignId('transaction_id')
                  ->constrained()
                  ->cascadeOnDelete();



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
            | Jumlah Vote
            |--------------------------------------------------------------------------
            */

            $table->integer('vote_amount');



            /*
            |--------------------------------------------------------------------------
            | Index Ranking
            |--------------------------------------------------------------------------
            */

            $table->index('event_id');

            $table->index('candidate_id');

            $table->index('category_id');



            $table->timestamps();


        });

    }




    public function down(): void
    {

        Schema::dropIfExists('votes');

    }

};