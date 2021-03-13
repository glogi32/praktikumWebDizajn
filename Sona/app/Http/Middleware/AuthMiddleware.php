<?php

namespace App\Http\Middleware;

use App\Http\Controllers\FrontController;
use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
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
        if(session()->has("user")){
            return $next($request);
        }else{
            FrontController::log("Unidentified user tried to gain access to route ".$request->path(),$request);
            return redirect()->back();
        }
    }
}
