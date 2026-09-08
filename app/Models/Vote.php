<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{

    protected $fillable = [

        'transaction_id',
        'category_id',
        'candidate_id',
        'vote_amount',

    ];


    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }


    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}