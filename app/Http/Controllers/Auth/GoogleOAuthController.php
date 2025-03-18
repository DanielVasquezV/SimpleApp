<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleOAuthController extends Controller
{
    public function handleGoogleCallback(){
        $user = Socialite::driver('google')->user();

        $userExists = User::where('external_id', $user->id)->where('external_auth', 'google')->first();

        if($userExists){
            $userExists->incrementLoginCount();
            Auth::login($userExists);
        }
        else
        {
            User::create([
                'external_id' => $user->id,
                'external_auth' => 'google',
                'name' => $user->name,
                'given_name' => $user->user['given_name'] ?? null,
                'family_name' => $user->user['family_name'] ?? null,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'email_verified'=> $user->user['verified_email'],
                'password' => null,
                'login_count' => 1,
                'last_login' => now()->toIso8601String()
            ]);
            
            Auth::login($user);
        }

        return redirect()->route('home');
    }
}