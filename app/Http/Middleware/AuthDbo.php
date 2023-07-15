<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class AuthDbo extends Facade
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next, $role)
    {
        // Check if user is authenticated
        if (!Session::get('user_id')) {
            // User is not authenticated, redirect or abort the request
            return redirect()->route('admin.login');
            // Alternatively, you can abort the request with a 401 Unauthorized status
            // return abort(401);
        }

        $roles = explode('-', $role);
        foreach ($roles as $group) {
            if (Session::get('role') == $group) {
                return $next($request);
            }
        }

        // User is authenticated, proceed with the request
        return redirect()->route('admin.login');
    }
}