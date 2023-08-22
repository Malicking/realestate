<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if ($request->user()->role !== $role) {
            // juste au cas où un utilateur veut accéder à un compte pour lequel 
            // il n'a pas le rôle requis, le retourner en arrière (back)
            return back(); 
        }
        return $next($request);
    }
}
