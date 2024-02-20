<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizedAdmin
{
    /**
     * Handle an incoming request.
     * si l'utilisateur n'est pas admin, on le redirige vers la page d'accueil
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (auth()->user()->role !== 'admin') {
            return redirect()->route('accueil.index');
        }

        return $next($request);
    }
}
