<?php

namespace App\Http\Middleware;
use Illuminate\Routing\Route;
use Closure;
use App\Model\Admin;

class CheckLogin
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
        $admin_name = Request()->session()->get('admin_name');
        $admin_id = Request()->session()->get('admin_id');

        if(!$admin_name){
            return redirect('login');die;
        }
        return $next($request);
    }
}
