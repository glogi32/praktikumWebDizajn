<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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

        if(session("user")->role_id == 1) {
            return $next($request);
        }else
        {
            \LogActivity::addToLog($request,"User tried to gain unauthorized access to log page");
            return redirect()->back();
        }
    }
}
