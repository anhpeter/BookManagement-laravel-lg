<?php

namespace App\Http\Middleware;

use App\Common\Helper\Message;
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
        if (!$request->user()->hasRole($roles))
            return redirect()->back()->with(['message' => Message::$noPermission]);
        return $next($request);
    }
}
