<?php

namespace Modules\Service\Http\Controllers\Api\Customer\CustomerModule;

use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Modules\Service\Entities\ServiceManagement\Service;

class CustomerController extends Controller
{

    private $customer;

    public function __construct(User $user)
    {
        $this->customer = $user;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function checkExistingCustomer(Request $request): JsonResponse
    {
        $newUserValidator = Validator::make($request->all(), [
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        if ($newUserValidator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($newUserValidator)), 400);
        }

        if (User::where('phone', $request['phone'])->exists()) {
            return response()->json(response_formatter(USER_EXIST_400, null, [["error_code" => "phone", "message" => translate('Phone already taken')]]), 400);
        }
        return response()->json(response_formatter(DEFAULT_200, null), 200);
    }

    public function getZone(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'lat' => 'required',
            'lng' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $point = new Point($request->lat, $request->lng);
        $zone = Zone::whereContains('coordinates', $point)->active()->first();

        if ($zone) {
            $zone['formatted_coordinates'] = serviceFormatCoordinates($zone->coordinates);

            $services = Service::withoutGlobalScope('zone_wise_data')->where('is_active', 1)->whereHas('category', function ($query) use ($zone) {
                $query->ofStatus(1)->withoutGlobalScope('zone_wise_data')->whereHas('zones', function ($query) use ($zone) {
                    $query->where('zone_id', $zone->id);
                });
            })->count();

            return response()->json(response_formatter(DEFAULT_200, [
                'zone' => $zone,
                'available_services_count' => $services,
            ]), 200);
        }

        return response()->json(response_formatter(ZONE_RESOURCE_404), 200);
    }

}
