<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Affiche la page d'inscription
    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('accueil.index');
        }

        return view("user/register");
    }

    // Action du controller pour l'inscription
    public function doRegister(LoginRequest $request)
    {
        $credentials = $request->validate([
            "firstname" => ["required"],
            "lastname" => ["required"],
            "email" => ["required", "email", "unique:users,email"],
            "password" => ["required", "confirmed"],
        ]);

        // Création d'un nouvel utilisateur dans la base de données
        User::create([
            "firstname" => $credentials["firstname"],
            "lastname" => $credentials["lastname"],
            "email" => $credentials["email"],
            "password" => Hash::make($credentials["password"]),
        ]);

        // Si l'on peut connecter l'utilisateur, on regénère la session
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
        }

        // Redirige l'utilisateur vers la page d'accueil ou la page qu'il voulait visiter
        return redirect()->intended(route("accueil.index"));
    }

    // Affiche la page de connexion
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('accueil.index');
        }
        return view('user/login');
    }

    // Action du controller pour la connexion
    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Si l'on peut connecter l'utilisateur, on regénère la session et on le redirige vers la page d'accueil ou la page qu'il voulait visiter
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('accueil.index'));
        }

        // Sinon on retourne un message d'erreur et on redirige l'utilisateur vers la page de connexion
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Action du controller pour la déconnexion
    public function doLogout()
    {
        Auth::logout();

        return redirect()->route('accueil.index');
    }

    // Affiche la page de profil
    public function profile()
    {
        $user = Auth::user();

        $cart = $user->cart();

        return view("user/profile", ['user' => $user, 'quantityItems' => $cart->quantityItems]);
    }

    // Action du controller pour la mise à jour du profil
    public function update(LoginRequest $request)
    {
        $credentials = $request->validate([
            "firstname" => ["required"],
            "lastname" => ["required"],
            "password" => ["required", "confirmed"],
        ]);

        $user = Auth::user();

        $user->update([
            "firstname" => $credentials["firstname"],
            "lastname" => $credentials["lastname"],
            "password" => Hash::make($credentials["password"]),
        ]);

        return redirect()->route('user.profile');
    }

    // Action du controller pour la suppression du profil
    public function delete()
    {
        $user = Auth::user();

        User::destroy($user->id);
        Auth::logout(); // on déconnecte l'utilisateur pour pas qu'il ne reste connecté avec un compte supprimé

        return redirect()->route('accueil.index');
    }
}
