<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VotingController;



/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/

Route::get('/',
    [VotingController::class, 'index']
)
->name('home');



/*
|--------------------------------------------------------------------------
| Detail Event
|--------------------------------------------------------------------------
*/

Route::get('/event/{event}',
    [VotingController::class, 'event']
)
->name('event.detail');



/*
|--------------------------------------------------------------------------
| Detail Candidate
|--------------------------------------------------------------------------
*/

Route::get('/candidate/{candidate}',
    [VotingController::class, 'candidate']
)
->name('candidate.detail');



/*
|--------------------------------------------------------------------------
| Voting Candidate
|--------------------------------------------------------------------------
*/

Route::get('/candidate/{candidate}/vote',
    [VotingController::class, 'vote']
)
->name('candidate.vote');



/*
|--------------------------------------------------------------------------
| Checkout Vote
|--------------------------------------------------------------------------
*/

Route::post('/candidate/{candidate}/checkout',
    [VotingController::class, 'checkout']
)
->name('candidate.checkout');



/*
|--------------------------------------------------------------------------
| Payment
|--------------------------------------------------------------------------
*/

Route::get('/payment/{invoice}',
    [VotingController::class, 'payment']
)
->name('payment.show');