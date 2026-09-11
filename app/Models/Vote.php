<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{

    protected $fillable = [

        'event_id',

        'transaction_id',

        'category_id',

        'candidate_id',

        'vote_amount',

    ];



    /*
    |--------------------------------------------------------------------------
    | Vote milik Event
    |--------------------------------------------------------------------------
    */

    public function event()
    {
        return $this->belongsTo(Event::class);
    }



    /*
    |--------------------------------------------------------------------------
    | Vote berasal dari Transaction
    |--------------------------------------------------------------------------
    */

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }



    /*
    |--------------------------------------------------------------------------
    | Vote diberikan kepada Candidate
    |--------------------------------------------------------------------------
    */

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }



    /*
    |--------------------------------------------------------------------------
    | Vote menggunakan Category
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}