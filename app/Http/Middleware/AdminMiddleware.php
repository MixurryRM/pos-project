<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check()) {
            if (Auth::user()->role == "superadmin" || Auth::user()->role == "admin") {

                // If the user is trying to access login or register while authenticated as admin or superadmin
                if (in_array($request->route()->getName(), ['login', 'register'])) {
                    return back();
                }

                return $next($request);
            }
        } else {
            return $next($request);
        }

        return back();
    }
}
