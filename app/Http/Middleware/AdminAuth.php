<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {

        if (auth()->user() && auth()->user()->is_admin) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
