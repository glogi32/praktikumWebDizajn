<?php

namespace App\Http\Middleware;

use App\Http\Controllers\FrontController;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
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
        if(session("user")->role->name == "Admin"){
            return $next($request);
        }else{
            FrontController::log("User tried to gain unauthorized access to route ".$request->path(),$request);
            return redirect()->back();
        }
    }
}
