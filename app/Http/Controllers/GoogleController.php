<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Carbon;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            $user = User::updateOrCreate(
                ['email' => $googleUser->email],
                [
                    'name' => $googleUser->name,
                    'google_id' => $googleUser->id,
                    'password' => encrypt('google-auth-dummy'), // Password acak yang aman
                    'role' => 'masyarakat',
                ]
            );

            $user->email_verified_at = now();
            $user->save();

            Auth::login($user, true);

            return redirect()->intended('dashboard');

        } catch (\Exception $e) {
            return redirect('/login')
                   ->with('error', 'Login dengan Google gagal: '.$e->getMessage());
        }
    }
}

