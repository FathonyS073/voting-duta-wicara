<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo',
        'banner',
        'start_date',
        'end_date',
        'status'
    ];


    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];



    public function categories()
    {
        return $this->hasMany(Category::class);
    }



    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }



    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }



    public function votes()
    {
        return $this->hasMany(Vote::class);
    }



    public function getRouteKeyName()
    {
        return 'slug';
    }

}