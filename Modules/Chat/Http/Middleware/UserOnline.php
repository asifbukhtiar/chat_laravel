<?php

namespace Modules\Chat\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Cache;
use Carbon\Carbon;
use Sentinel;

class UserOnline
{
    /**.
     *
     * Handle an incoming request
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Sentinel::check())
        {
            $inactive = Carbon::now()->addMinutes(30);

            Cache::put('is-user-online-'. Sentinel::getUser()->id, true, $inactive);
        }
        return $next($request);
    }
}
