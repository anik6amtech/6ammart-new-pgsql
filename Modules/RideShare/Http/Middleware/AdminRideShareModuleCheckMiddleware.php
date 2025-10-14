<?php

namespace Modules\RideShare\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminRideShareModuleCheckMiddleware
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
        if (addon_published_status('RideShare') && config('module.current_module_type') == 'ride-share'){
            return $next($request);
        }

        return abort(404);
    }
}
