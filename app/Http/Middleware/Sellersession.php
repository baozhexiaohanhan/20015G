<?php

namespace App\Http\Middleware;

use Closure;

class Sellersession
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
        $user = $request->session()->get("seller");
        if(!$user){
            return redirect("/business/user_log");
        }
        return $next($request);
    }
}
