<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;
        
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $notif = array(
                    'message' => 'Vous êtes déjà connecté.', 
                    'alert-type' => 'info'
                );

                if (Auth::user()->role == 'agent') {
                    return redirect()->route('agent.dashboard')->with($notif);
                }

                if (Auth::user()->role == 'user') {
                    return redirect()->route('dashboard')->with($notif);
                }

                if (Auth::user()->role == 'admin') {
                    return redirect()->route('admin.dashboard')->with($notif);
                }
            } 
        }

        return $next($request);
    }
}
