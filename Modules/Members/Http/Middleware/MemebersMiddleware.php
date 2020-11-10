<?php

namespace Modules\Members\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Sentinel;

class MemebersMiddleware
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
        $role = Sentinel::getUser()->roles()->first()->slug;
        if(Sentinel::check()){
            if($role == "admin" || $role == "super-moderator" || $role == "moderator") {
                return redirect('/members/admin');
            }else if($role == "members"){
                //return redirect('/members/my_account');
            }

            return $next($request);
        }

        else{
            return redirect('/members/login')
                ->with(['error' => "You do not have the permission to enter this site. Please login with correct user."]);
        }
    }
}
