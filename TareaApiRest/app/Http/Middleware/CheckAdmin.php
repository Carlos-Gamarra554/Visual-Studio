<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->role === 'administrador') {
            return $next($request);
        }

        return response()->json(['error' => 'Acceso denegado. Se requiere rol de administrador.'], 403);
    }
}