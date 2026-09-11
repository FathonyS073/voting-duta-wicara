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


          $table->string('invoice_number')
                ->unique();



          // Event
          $table->foreignId('event_id')
                ->constrained()
                ->cascadeOnDelete();



          // Category
          $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();



          // Candidate
          $table->foreignId('candidate_id')
                ->constrained()
                ->cascadeOnDelete();



          $table->integer('vote_amount');


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
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
