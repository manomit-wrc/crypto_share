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
            return redirect("/");
        } else {
            if($request->segment(1) == 'login' || $request->segment(1) == 'register') {
                return redirect('/dashboard');
            }
            else {
                return $next($request);
            }
        } 
    }
}
