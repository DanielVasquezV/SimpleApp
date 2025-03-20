<?php

use App\Http\Controllers\AdminDashboardController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\GoogleOAuthController;

Route::get('/', function () {
    return view('login');
})->name('login')->middleware('authenticated');

Route::get('/auth/google', function () {
    return Socialite::driver('google')
        ->scopes([
            'email',
            'profile',
            'openid'
        ])
        ->redirect();
})->name('login-google')->middleware('web');

//Handle the oauth login and user data
Route::get('/auth/google/callback', [GoogleOAuthController::class, 'handleGoogleCallback']);

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('check.auth');

Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin')->middleware('check.auth');

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');