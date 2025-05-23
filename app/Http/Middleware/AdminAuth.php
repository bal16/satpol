<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next): \Symfony\Component\HttpFoundation\Response
    {

        if (!session()->has('admin')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}

