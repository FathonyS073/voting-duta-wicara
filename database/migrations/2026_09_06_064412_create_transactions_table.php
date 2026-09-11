<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{


    public function up(): void
    {

        Schema::create('transactions', function (Blueprint $table) {


            $table->id();



            /*
            |--------------------------------------------------------------------------
            | Invoice
            |--------------------------------------------------------------------------
            */

            $table->string('invoice_number')
                  ->unique();



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
            | Data Customer
            |--------------------------------------------------------------------------
            */

            $table->string('customer_name')
                  ->nullable();


            $table->string('customer_email')
                  ->nullable();


            $table->string('customer_phone')
                  ->nullable();



            /*
            |--------------------------------------------------------------------------
            | Vote
            |--------------------------------------------------------------------------
            */

            $table->integer('vote_amount');



            /*
            |--------------------------------------------------------------------------
            | Pembayaran
            |--------------------------------------------------------------------------
            */

            $table->integer('total_amount');


            $table->string('payment_method')
                  ->nullable();



            $table->enum('payment_status',[

                'pending',
                'waiting_confirmation',
                'paid',
                'failed',
                'expired'

            ])
            ->default('pending');



            $table->string('payment_reference')
                  ->nullable();


            $table->string('payment_proof')
                  ->nullable();



            $table->timestamp('paid_at')
                  ->nullable();



            $table->timestamps();


        });

    }




    public function down(): void
    {

        Schema::dropIfExists('transactions');

    }

};