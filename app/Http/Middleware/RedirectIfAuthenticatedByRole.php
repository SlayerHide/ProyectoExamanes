<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticatedByRole
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->rol === 'administrador') {
                return redirect()->route('dashboard.administrador');
            } elseif ($user->rol === 'docente') {
                return redirect()->route('dashboard.docente');
            } elseif ($user->rol === 'alumno') {
                return redirect()->route('dashboard.alumno');
            }
        }

        return $next($request);
    }
}
