<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VotingController;


Route::get(
    '/',
    [VotingController::class, 'index']
)->name('home');


Route::get(
    '/events',
    [VotingController::class, 'events']
)->name('events.index');

Route::get(
    '/tentang',
    [VotingController::class, 'about']
)->name('about');


Route::get(
    '/event/{event}',
    [VotingController::class, 'event']
)->name('event.detail');


Route::get(
    '/candidate/{candidate}',
    [VotingController::class, 'candidate']
)->name('candidate.detail');


Route::get(
    '/candidate/{candidate}/vote',
    [VotingController::class, 'vote']
)->name('candidate.vote');


Route::post(
    '/candidate/{candidate}/checkout',
    [VotingController::class, 'checkout']
)->name('candidate.checkout');


Route::get(
    '/payment/{invoice}',
    [VotingController::class, 'payment']
)->name('payment.show');