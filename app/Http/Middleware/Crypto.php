<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class Crypto
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
        if(!Auth::guard('crypto')->check())
        {
            return redirect("/login");
        }
        else {
            if(Auth::guard('crypto')->user()->status === "2") {
                return redirect("/login");
            }
            else {
                return $next($request);
            }
        }
        
    }
}
