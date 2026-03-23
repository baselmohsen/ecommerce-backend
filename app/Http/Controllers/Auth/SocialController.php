<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();

            // Find user by provider_id or email
            $user = User::where('provider', $provider)
                        ->where('provider_id', $socialUser->getId())
                        ->first();

            if (!$user) {
                $user = User::firstOrCreate(
                    ['email' => $socialUser->getEmail()],
                    [
                        'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'User',
                        'password' => Hash::make(Str::random(16)),
                        'provider' => $provider,
                        'provider_id' => $socialUser->getId(),
                    ]
                );
            }

            Auth::login($user);

            return redirect()->route('home');

        } catch (\Exception $e) {
            \Log::error('Social Login Error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors('Authentication failed.');
        }
    }
}