<?php

namespace Modules\RideShare\Http\Controllers\Api\BusinessManagement\Rider;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Modules\RideShare\Interface\BusinessManagement\Service\BusinessSettingServiceInterface;
use Modules\RideShare\Interface\BusinessManagement\Service\CancellationReasonServiceInterface;
use Modules\RideShare\Interface\BusinessManagement\Service\SafetyAlertReasonServiceInterface;
use Modules\RideShare\Interface\BusinessManagement\Service\SafetyPrecautionServiceInterface;
use Modules\RideShare\Interface\TripManagement\Service\TripRequestServiceInterface;
use Modules\RideShare\Interface\UserManagement\Service\UserLastLocationServiceInterface;
use Modules\RideShare\Interface\ZoneManagement\Service\ZoneServiceInterface;

class ConfigController extends Controller
{
    protected $businessSettingService;
    // protected $settingService;
    protected $cancellationReasonService;
    // protected $parcelCancellationReasonService;
    protected $zoneService;
    // protected $questionAnswerService;
    protected $safetyAlertReasonService;

    protected $safetyPrecautionService;

    public function __construct(
        BusinessSettingServiceInterface    $businessSettingService, 
        // SettingServiceInterface $settingService,
        CancellationReasonServiceInterface $cancellationReasonService, 
        // ParcelCancellationReasonServiceInterface $parcelCancellationReasonService,
        ZoneServiceInterface               $zoneService, 
        // QuestionAnswerServiceInterface $questionAnswerService,
        SafetyAlertReasonServiceInterface  $safetyAlertReasonService, 
        SafetyPrecautionServiceInterface $safetyPrecautionService
    ) {
        $this->businessSettingService = $businessSettingService;
        // $this->settingService = $settingService;
        $this->cancellationReasonService = $cancellationReasonService;
        // $this->parcelCancellationReasonService = $parcelCancellationReasonService;
        $this->zoneService = $zoneService;
        // $this->questionAnswerService = $questionAnswerService;
        $this->safetyAlertReasonService = $safetyAlertReasonService;
        $this->safetyPrecautionService = $safetyPrecautionService;
    }

    public function cancellationReasonList()
    {
        $ongoingRide = $this->cancellationReasonService->getBy(criteria: ['cancellation_type' => 'ongoing_ride', 'user_type' => 'driver', 'is_active' => 1])->pluck('title')->toArray();
        $acceptedRide = $this->cancellationReasonService->getBy(criteria: ['cancellation_type' => 'accepted_ride', 'user_type' => 'driver', 'is_active' => 1])->pluck('title')->toArray();
        $data = [
            'ongoing_ride' => $ongoingRide,
            'accepted_ride' => $acceptedRide,
        ];
        return response(responseFormatter(DEFAULT_200, $data));
    }

    public function getZone(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'lat' => 'required',
            'lng' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(responseFormatter(DEFAULT_400, null, null, null, errorProcessor($validator)), 400);
        }

        $point = new Point($request->lat, $request->lng);
        $zone = $this->zoneService->getByPoints($point)->where('status', 1)->first();

        if ($zone) {
            return response()->json(responseFormatter(DEFAULT_200, $zone), 200);
        }

        return response()->json(responseFormatter(ZONE_RESOURCE_404), 403);
    }

    /**
     * Summary of placeApiAutocomplete
     * @param Request $request
     * @return JsonResponse
     */
    /* public function placeApiAutocomplete(Request $request): JsonResponse
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'search_text' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(responseFormatter(DEFAULT_400, null, null, null, errorProcessor($validator)), 400);
        }

        $mapApiKey = businessConfig(GOOGLE_MAP_API)?->value['map_api_key_server'] ?? null;

        $url = 'https://places.googleapis.com/v1/places:autocomplete';
        $data = [
            'input' => $request->input('search_text'),
            // Optionally, you can add more parameters here
            // 'components' => 'country:IN', // Example: Restrict results to a specific country
        ];

        // API Headers
        $headers = [
            'Content-Type' => 'application/json',
            'X-Goog-Api-Key' => $mapApiKey,
            'X-Goog-FieldMask' => '*'
        ];

        // Send POST request
        $response = Http::withHeaders($headers)->post($url, $data);
        return response()->json(responseFormatter(DEFAULT_200, $response->json()), 200);
    } */

    /* public function distanceApi(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'origin_lat' => 'required',
            'origin_lng' => 'required',
            'destination_lat' => 'required',
            'destination_lng' => 'required',
            'mode' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(responseFormatter(DEFAULT_400, null, null, null, errorProcessor($validator)), 400);
        }

        $mapApiKey = businessConfig(GOOGLE_MAP_API)?->value['map_api_key_server'] ?? null;
        $response = Http::get(MAP_API_BASE_URI . '/distancematrix/json?origins=' . $request['origin_lat'] . ',' . $request['origin_lng'] . '&destinations=' . $request['destination_lat'] . ',' . $request['destination_lng'] . '&travelmode=' . $request['mode'] . '&key=' . $mapApiKey);

        return response()->json(responseFormatter(DEFAULT_200, $response->json()), 200);
    } */

   /*  public function geocodeApi(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'lat' => 'required',
            'lng' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(responseFormatter(DEFAULT_400, null, null, null, errorProcessor($validator)), 400);
        }
        $mapApiKey = businessConfig(GOOGLE_MAP_API)?->value['map_api_key_server'] ?? null;
        $response = Http::get(MAP_API_BASE_URI . '/geocode/json?latlng=' . $request->lat . ',' . $request->lng . '&key=' . $mapApiKey);
        return response()->json(responseFormatter(DEFAULT_200, $response->json()), 200);
    } */

    /* public function predefinedQuestionAnswerList(): JsonResponse
    {
        $predefinedQAs = $this->questionAnswerService->getBy(criteria: ['is_active' => true], orderBy: ['created_at' => 'desc']);

        return response()->json(responseFormatter(DEFAULT_200, $predefinedQAs), 200);
    } */

    public function otherEmergencyContactList(): JsonResponse
    {
        $criteria = [
            'type' => 'ride_share_business_settings',
            'key' => 'emergency_other_number'
        ];
        if(businessConfig(key: 'emergency_call_status')?->value == 1) {
            $emergencyOtherNumberList = $this->businessSettingService->findOneBy(criteria: $criteria)?->value;
            $emergencyOtherNumberList = json_decode($emergencyOtherNumberList);
        } else {
            $emergencyOtherNumberList = [];
        }
        // $emergencyOtherNumberList = businessConfig(key: 'emergency_call_status')?->value == 1 ? $this->businessSettingService->findOneBy(criteria: $criteria)?->value : null;
        return response()->json(responseFormatter(constant: DEFAULT_200, content: $emergencyOtherNumberList));
    }

    public function safetyAlertReasonList(): JsonResponse
    {
        $criteria = [
            'is_active' => 1,
            'reason_for_whom' => DRIVER
        ];
        $safetyAlertReasons = businessConfig(key: 'safety_alert_reason_status')?->value == 1
            ? $this->safetyAlertReasonService->getBy(criteria: $criteria)->pluck('reason')->map(function ($reason) {
                return ['reason' => $reason];
            })
            : null;
        return response()->json(responseFormatter(constant: DEFAULT_200, content: $safetyAlertReasons));
    }

    public function safetyPrecautionList(): JsonResponse
    {
        $criteria = [
            'is_active' => 1,
            ['for_whom', 'like', '%' . DRIVER . '%'],
        ];
        $safetyPrecautions = $this->safetyPrecautionService->getBy(criteria: $criteria);
        $responseData = $safetyPrecautions->map(function ($item) {
            return [
                'title' => $item['title'],
                'description' => $item['description'],
            ];
        });
        return response()->json(responseFormatter(constant: DEFAULT_200, content: $responseData));
    }
}
