<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class checkUploader
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
        if (empty(Session::get('password')) || empty(Session::get('username'))) {
            return redirect('login');

        }

        return $next($request);
    }
}
