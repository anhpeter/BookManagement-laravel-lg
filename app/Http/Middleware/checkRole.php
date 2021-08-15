<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {

        if (!$request->user())
            return redirect('login');
        else if (!$request->user()->hasRole($roles))
            return redirect('home');
        return $next($request);
    }
}
