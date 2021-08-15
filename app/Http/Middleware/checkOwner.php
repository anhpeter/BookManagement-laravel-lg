<?php

namespace App\Http\Middleware;

use App\Common\Helper\Message;
use Closure;
use Illuminate\Http\Request;

class checkOwner
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
        if (!$request->user()->hasRole(['admin']) && $request->profile != $request->user()->id)
            return redirect()->back()->with(['message' => Message::$noPermission]);
        return $next($request);
    }
}
