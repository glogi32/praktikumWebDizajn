<?php

namespace App\Http\Middleware;

use Closure;

class IsLogged
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
        if($request->session()->has("user")) {
            return $next($request);
        }else{
            \LogActivity::addToLog($request,"Unauthorized user tried to gain access to control panel");
            return redirect()->back();
        }
    }
}
