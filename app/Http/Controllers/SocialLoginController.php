<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $user = User::where('email', $socialUser->email)->first();

        if ($user) {
            $user->update([
                'provider_id' => $socialUser->id,
                'provider' => $provider,
                'provider_token' => $socialUser->token,
            ]);
        } else {
            $user = User::create([
                'name' => $socialUser->name,
                'nickname' => $socialUser->nickname,
                'email' => $socialUser->email,
                'provider_id' => $socialUser->id,
                'provider' => $provider,
                'provider_token' => $socialUser->token,
                'role' => 'user'
            ]);
        }

        Auth::login($user);

        return to_route('userHome');
    }
}
