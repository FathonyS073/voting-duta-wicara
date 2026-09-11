<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [

        'event_id',
        'name',
        'description',
        'vote_price',
        'status'

    ];



    protected $casts = [

        'status' => 'boolean',

        'vote_price' => 'integer',

    ];



    /*
    |--------------------------------------------------------------------------
    | Category milik Event
    |--------------------------------------------------------------------------
    */

    public function event()
    {
        return $this->belongsTo(Event::class);
    }



    /*
    |--------------------------------------------------------------------------
    | Category memiliki banyak Candidate
    |--------------------------------------------------------------------------
    */

    public function candidates()
    {
        return $this->belongsToMany(
            Candidate::class,
            'category_candidates'
        );
    }



    /*
    |--------------------------------------------------------------------------
    | Category memiliki banyak Vote
    |--------------------------------------------------------------------------
    */

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }



    /*
    |--------------------------------------------------------------------------
    | Category memiliki banyak Transaction
    |--------------------------------------------------------------------------
    */

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}