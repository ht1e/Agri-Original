<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response   
    {
        //dd(Auth::check());

        if(Auth::check() && Auth::user()->ND_MaVT == 2)
            return $next($request);

        return redirect()->route('403');

       
    }
}
