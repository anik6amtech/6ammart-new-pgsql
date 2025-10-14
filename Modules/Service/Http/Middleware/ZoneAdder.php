<?php

namespace Modules\Service\Http\Middleware;

use App\Models\Zone;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

class ZoneAdder
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse)  $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (request()->is('api/*/service/customer?*') || request()->is('api/*/service/customer/*')) {
            Config::set('zone_id', $request->header('zoneId') ?? null);
//            if (preg_match('/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i', Config::get('zone_id'))) {
                $zone = Zone::active()->where('id', $request->header('zoneId'))->first();
                if (!isset($zone)) {
                    return response()->json(response_formatter(ZONE_404), 401);
                }
//            }
        }
        return $next($request);
    }
}
