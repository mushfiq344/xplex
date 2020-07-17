<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session as Session;
class checkSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty(Session::get('password')) || empty(Session::get('username')) || Session::get('admin_type')!='admin') {
            return redirect('login');

        }

        return $next($request);
    }
}
