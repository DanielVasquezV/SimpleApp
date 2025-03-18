<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\GoogleOAuthController;

Route::get('/', function () {
    return view('login');
})->name('login')->middleware('guest');

Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('login-google')->middleware('web');
 
//Handle the oauth login and user data
Route::get('/auth/google/callback', [GoogleOAuthController::class, 'handleGoogleCallback'])->middleware('web');

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');