<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;

class GoogleOAuthController extends Controller
{
    public function handleGoogleCallback(){
        try
        {
            $googleUser = Socialite::driver('google')->user();
            $user = User::updateOrCreate(
                [
                    'external_id' => $googleUser->id,
                    'external_auth' => 'google',
                ],
                [
                    'name' => $googleUser->name,
                    'avatar' => $googleUser->avatar,
                    'email' => $googleUser->email,
                    'email_verified' => $googleUser->user['verified_email'],
                    'locale' => $googleUser->user['locale'] ?? null,
                    'given_name' => $googleUser->user['given_name'] ?? null,
                    'family_name' => $googleUser->user['family_name'] ?? null,
                    'workspace_domain' => $googleUser->user['hd'] ?? 'gmail.com',
                    'last_login' => now('UTC')->toIso8601String(),
                    'login_count' => DB::raw('login_count + 1'),
                ]
            );    

            Auth::login($user);

            $user->logins()->create([
                'login_time' => now('UTC')->toIso8601String(),
                'ip_address' => request()->ip(),
            ]);

            session(['admin' => $this->checkRole($user)]);

            return redirect()->route('home');
        }
        catch (\Exception $e)
        {
            return redirect()->route('login')->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function checkRole(User $user): bool
    {
        return preg_match('/@(.*\.)?thecodeartisans\.com$/i', $user->email) || preg_match('/qa/i', $user->name) || preg_match('/^dvventura80@gmail\.com$/i', $user->email);
    }
}