<?php

namespace Modules\RideShare\Http\Controllers\Api\UserManagement\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\RideShare\Http\Resources\UserManagement\LastLocationResource;
use Modules\RideShare\Interface\TripManagement\Service\TripRequestServiceInterface;
use Modules\RideShare\Interface\UserManagement\Service\UserLastLocationServiceInterface;

class LocationController extends Controller
{
    protected $userLastLocationService;
    protected $tripRequestService;

    public function __construct(UserLastLocationServiceInterface $userLastLocationService, TripRequestServiceInterface $tripRequestService)
    {
        $this->userLastLocationService = $userLastLocationService;
        $this->tripRequestService = $tripRequestService;
    }

    public function storeLastLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'type' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'zone_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(responseFormatter(constant: DEFAULT_400, errors: errorProcessor($validator)), 400);
        }
        if ($request->user_id) {
            $userLastLocation = $this->userLastLocationService->findOneBy(criteria: ['user_id' => $request->user_id]);
            $attributes = [
                'user_id' => $request->user_id,
                'type' => $request->type,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'zone_id' => $request->zone_id
            ];
            if ($userLastLocation) {
                $this->userLastLocationService->update(id: $userLastLocation->id, data: $attributes);
            } else {
                $this->userLastLocationService->create($attributes);
            }
        }
        return response()->json(responseFormatter(constant: DEFAULT_200, content: ''));
    }

    public function getLastLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ride_request_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(responseFormatter(constant: DEFAULT_400, errors: errorProcessor($validator)), 403);
        }
        $trip = $this->tripRequestService->findOne(id: $request['ride_request_id']);
        if (!$trip) {
            return response()->json(responseFormatter(constant: TRIP_REQUEST_404), 403);
        }
        $userLastLocation = $this->userLastLocationService->findOneBy(criteria: ['user_id' => $trip->customer_id]);
        $latLocation = LastLocationResource::make($userLastLocation);
        return response()->json(responseFormatter(constant: DEFAULT_200, content: $latLocation));
    }
}
