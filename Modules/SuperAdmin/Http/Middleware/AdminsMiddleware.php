<?php

namespace Modules\SuperAdmin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Sentinel;

class AdminsMiddleware
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
        if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug == 'superadmin')
        {
            return $next($request);
        }else{
            return redirect('/superadmin/login')
                ->with(['error' => "You do not have the permissions to access. Please login with correct user."]);
        }

    }
}
