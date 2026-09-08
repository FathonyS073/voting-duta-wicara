<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    protected $fillable = [
        'invoice_number',
        'category_id',
        'candidate_id',
        'vote_amount',
        'total_amount',
        'payment_method',
        'payment_status',
        'payment_reference',
        'payment_proof',
        'paid_at',
    ];
    protected $casts = [
    'paid_at' => 'datetime',
    ];


    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

}