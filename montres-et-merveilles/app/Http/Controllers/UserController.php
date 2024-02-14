<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register()
    {
        return view("register");
    }

    public function doRegister(LoginRequest $request)
    {
        $credentials = $request->validate([
            "firstname" => ["required"],
            "lastname" => ["required"],
            "email" => ["required", "email"],
            "password" => ["required", "confirmed"],
        ]);

        User::create([
            "firstname" => $credentials["firstname"],
            "lastname" => $credentials["lastname"],
            "email" => $credentials["email"],
            "password" => Hash::make($credentials["password"]),
        ]);

        return redirect()->intended(route("acceuil.index"));
    }

    public function login()
    {
        return view('login');
    }

    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('acceuil.index'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function doLogout()
    {
        Auth::logout();

        return redirect()->route('acceuil.index');
    }
}
