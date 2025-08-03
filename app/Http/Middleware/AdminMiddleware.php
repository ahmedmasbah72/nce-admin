<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Session::get('role') !== 'admin') {
            return redirect()->route('welcome');
        }

        return $next($request);
    }
}
