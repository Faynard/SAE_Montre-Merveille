<?php

namespace App\Http\Controllers;

class AccueilController extends Controller
{
    // Cette fonction permet de retourner la vue de l'accueil
    public function index()
    {
        return view('accueil');
    }
}
