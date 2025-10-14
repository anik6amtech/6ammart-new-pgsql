<?php

namespace Modules\Service\Http\Middleware;

use App\Models\DataSetting;
use Closure;
use Illuminate\Http\Request;
use Modules\BusinessSettingsModule\Entities\BusinessSettings;

class EnsureBiddingIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $bidding_status = DataSetting::where('key', 'bidding_status')->where('type', 'service_business_settings')->first()->value ?? 0;

        if (!$bidding_status) {
            return response()->json(DEFAULT_403);
        }
        return $next($request);
    }
}
