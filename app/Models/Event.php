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


    public function categories()
    {
        return $this->hasMany(Category::class);
    }


    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

}