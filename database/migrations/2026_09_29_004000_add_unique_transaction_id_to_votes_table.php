<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('votes', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Satu Transaction hanya boleh memiliki satu Vote
            |--------------------------------------------------------------------------
            */

            $table->unique(
                'transaction_id',
                'votes_transaction_id_unique'
            );

        });
    }


    public function down(): void
    {
        Schema::table('votes', function (Blueprint $table) {

            $table->dropUnique(
                'votes_transaction_id_unique'
            );

        });
    }
};