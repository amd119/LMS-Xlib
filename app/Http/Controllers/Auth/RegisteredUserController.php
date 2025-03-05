<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{

    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'NamaLengkap' => 'required',
            'Alamat' => 'required',
            'password' => 'required|confirmed|min:6', Rules\Password::defaults(),
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'NamaLengkap' => $request->NamaLengkap,
            'Alamat' => $request->Alamat,
            'password' => Hash::make($request->password),
            'Role' => 3,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('flash', absolute: false));
    }
}
