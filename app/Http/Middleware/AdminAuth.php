<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/admin/login');
        }

        if (!Auth::user()->is_admin) {
            Auth::logout();
            return redirect('/admin/login')->withErrors(['username' => 'Access denied. Admin privileges required.']);
        }

        return $next($request);
    }
}