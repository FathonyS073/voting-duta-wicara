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


    public function event()
    {
        return $this->belongsTo(Event::class);
    }


    public function candidates()
    {
        return $this->belongsToMany(
            Candidate::class,
            'category_candidates'
        );
    }


    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

}