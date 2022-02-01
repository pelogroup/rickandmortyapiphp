<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HttpsProtocol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    //*
    // ADDED BY Watchiba  HttpsProtocol TO FORCE THE USE OF HTTPS
     public function handle(Request $request, Closure $next)
    {
        if (!$request->secure()) {
               return redirect()->secure($request->getRequestUri());
            }
        return $next($request);
    }
    //*/
}
