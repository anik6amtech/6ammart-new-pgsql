<?php

namespace Modules\Service\Http\Middleware;

use App\CentralLogics\Helpers;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ProviderManagement\Serviceman;

class ServiceServiceManTokenIsValid
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
        if (request()->bearerToken() === null && isset($_SERVER['HTTP_AUTHORIZATION'])) {
            request()->headers->set('Authorization', $_SERVER['HTTP_AUTHORIZATION']);
        }

        $header = $request->header('authorization');

        if (!$header) {
            return response()->json(['message' => 'Unauthorized. Token missing.'], 401);
        }

        if (str_starts_with($header, 'Bearer ')) {
            $token = str_replace('Bearer ', '', $header);
        } else {
            $token = $header;
        }

        $serviceman = Serviceman::where('auth_token', $token)->first();

        if (!$serviceman) {
            return response()->json(['message' => 'Invalid or expired token.'], 401);
        }

        auth('serviceman')->login($serviceman);

        return $next($request);
    }
}
