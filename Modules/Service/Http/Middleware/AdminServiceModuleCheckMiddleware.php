<?php

namespace Modules\Service\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminServiceModuleCheckMiddleware
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
        if (addon_published_status('Service') && config('module.current_module_type') == 'service'){
            return $next($request);
        }

        return abort(404);
    }
}
