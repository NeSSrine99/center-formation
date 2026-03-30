<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Vous devez être connecté.');
        }

        $user = Auth::user();

        foreach ($roles as $role) {
            if ($user && $user->role && $user->role->name === $role) {
                return $next($request);
            }
        }

        return redirect('/dashboard')->with('error', 'Accès refusé. Vous n\'avez pas les permissions requises.');
    }
}
