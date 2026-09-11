<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    protected $fillable = [

        'invoice_number',

        'event_id',

        'category_id',

        'candidate_id',


        /*
        |--------------------------------------------------------------------------
        | Data Customer
        |--------------------------------------------------------------------------
        */

        'customer_name',

        'customer_email',

        'customer_phone',



        /*
        |--------------------------------------------------------------------------
        | Detail Vote
        |--------------------------------------------------------------------------
        */

        'vote_amount',

        'total_amount',



        /*
        |--------------------------------------------------------------------------
        | Payment
        |--------------------------------------------------------------------------
        */

        'payment_method',

        'payment_status',

        'payment_reference',

        'payment_proof',

        'paid_at',

    ];



    protected $casts = [

        'paid_at' => 'datetime',

    ];



    /*
    |--------------------------------------------------------------------------
    | Transaction milik Event
    |--------------------------------------------------------------------------
    */

    public function event()
    {
        return $this->belongsTo(Event::class);
    }



    /*
    |--------------------------------------------------------------------------
    | Transaction memilih Candidate
    |--------------------------------------------------------------------------
    */

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }



    /*
    |--------------------------------------------------------------------------
    | Transaction menggunakan Category
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }



    /*
    |--------------------------------------------------------------------------
    | Transaction menghasilkan banyak Vote
    |--------------------------------------------------------------------------
    */

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

}