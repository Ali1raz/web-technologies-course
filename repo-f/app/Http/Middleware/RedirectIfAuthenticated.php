<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('student')) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
