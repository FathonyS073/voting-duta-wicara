<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    protected $fillable = [

        'transaction_id',

        'gateway',

        'gateway_event_id',

        'status',

        'response',

    ];


    protected $casts = [

        'response' => 'array',

    ];


    /*
    |--------------------------------------------------------------------------
    | Payment Log milik Transaction
    |--------------------------------------------------------------------------
    */

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}