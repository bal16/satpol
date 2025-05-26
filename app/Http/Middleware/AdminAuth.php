<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next): \Symfony\Component\HttpFoundation\Response
    {

        if (auth()->user() && auth()->user()->is_admin) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}