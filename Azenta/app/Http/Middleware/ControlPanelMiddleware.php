<?php

namespace App\Http\Middleware;

use Closure;

class ControlPanelMiddleware
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
        $user = $request->session()->get("user");

        if($user->role_id == 1 || $user->role_id == 3){
            return $next($request);

        }else{
            \LogActivity::addToLog($request,"User tried to gain unauthorized access to control panel");
            return redirect()->back();
        }


    }
}
