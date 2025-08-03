<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Session::get('role') !== 'user') {
            return redirect()->route('welcome');
        }

        return $next($request);
    }
}
