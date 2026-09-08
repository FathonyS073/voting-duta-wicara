<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VotingController;


Route::get('/',
    [VotingController::class, 'index']
)
->name('home');


Route::get('/event/{id}',
    [VotingController::class, 'event']
)
->name('event.detail');


Route::get('/candidate/{id}',
    [VotingController::class, 'candidate']
)
->name('candidate.detail');


Route::get('/candidate/{id}/vote',
    [VotingController::class, 'vote']
)
->name('candidate.vote');