<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $socialUser = Socialite::driver('google')->user();

            $registeredUser = User::where('email', $socialUser->email)->first();

            if ($registeredUser) {
                Auth::login($registeredUser);
                return $this->redirectBasedOnRole($registeredUser->Role);
            } else {
                $username = str_replace(' ', '', strtolower($socialUser->name));
                $user = User::create([
                    'google_id' => $socialUser->id,
                    'google_token' => $socialUser->token,
                    'google_refresh_token' => $socialUser->refreshToken,
                    'username' => $username,
                    'email' => $socialUser->email,
                    'NamaLengkap' => $socialUser->name,
                    'Alamat' => null,
                    'password' => bcrypt('password'),
                    'Role' => 3,
                ]);
                Auth::login($user);
                return redirect()->intended(route('flash'));
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    private function redirectBasedOnRole($role)
    {
        if ($role === 1 || $role === 2) {
            return redirect()->intended(route('dashboard'));
        } else {
            return redirect()->intended(route('flash'));
        }
    }
}
