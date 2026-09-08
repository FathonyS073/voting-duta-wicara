<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Candidate extends Model
{
    protected $fillable = [

        'event_id',
        'name',
        'slug',
        'photo',
        'city',
        'province',
        'bio',
        'education',
        'achievement',
        'vision',
        'mission',
        'instagram',
        'tiktok',
        'status'

    ];


    public function event()
    {
        return $this->belongsTo(Event::class);
    }


    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'category_candidates'
        );
    }


    public function votes()
    {
        return $this->hasMany(Vote::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($candidate) {
            $candidate->slug = Str::slug($candidate->name);
        });
    }
}