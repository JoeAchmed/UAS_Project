<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AuthDbo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if user is authenticated
        if (!Session::get('user_id')) {
            // User is not authenticated, redirect or abort the request
            return redirect()->route('admin.login');
            // Alternatively, you can abort the request with a 401 Unauthorized status
            // return abort(401);
        }

        // User is authenticated, proceed with the request
        return $next($request);
    }
}
