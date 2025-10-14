<?php

namespace Modules\RideShare\Http\Controllers\Api\TripManagement\Customer;

use App\CentralLogics\Helpers;
use App\Traits\Payment;
use Carbon\Carbon;
use Exception;
use Illuminate\Validation\Rule;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Modules\RideShare\Entities\TripManagement\FareBidding;
use Modules\RideShare\Entities\TripManagement\RideRequestCoordinate;
use Modules\RideShare\Entities\TripManagement\RideRequestTime;
use Modules\RideShare\Events\CustomerTripCancelledAfterOngoingEvent;
use Modules\RideShare\Events\CustomerTripCancelledEvent;
use Modules\RideShare\Events\CustomerTripRequestEvent;
use Modules\RideShare\Events\DriverTripCancelledEvent;
use Modules\RideShare\Http\Resources\TripManagement\FareBiddingResource;
use Modules\RideShare\Http\Resources\TripManagement\TripRequestResource;
use Modules\RideShare\Http\Resources\UserManagement\LastLocationResource;
use Modules\RideShare\Interface\FareManagement\Service\TripFareServiceInterface;
use Modules\RideShare\Interface\PromotionManagement\Service\CouponSetupServiceInterface;
use Modules\RideShare\Interface\UserManagement\Service\UserLastLocationServiceInterface;
use Modules\RideShare\Interface\ZoneManagement\Service\ZoneServiceInterface;
use Modules\RideShare\Jobs\SendPushNotificationJob;
use Modules\RideShare\Repositories\TripManagement\FareBiddingRepository;
use Modules\RideShare\Repositories\TripManagement\RecentAddressRepository;
use Modules\RideShare\Repositories\TripManagement\RejectedDriverRequestRepository;
use Modules\RideShare\Repositories\TripManagement\TempTripNotificationRepository;
use Modules\RideShare\Repositories\TripManagement\TripRequestRepository;
use Modules\RideShare\Repositories\UserManagement\DriverDetailsRepository;
use Modules\RideShare\Repositories\UserManagement\DriverRepository;
use Modules\RideShare\Repositories\UserManagement\UserLastLocationRepository;
use Modules\RideShare\Repositories\ZoneManagement\ZoneRepository;
use Modules\RideShare\Traits\TransactionManagement\TransactionTrait;
use Modules\RideShare\Traits\TripManagement\CommonTrait;
use Modules\RideShare\Traits\TripManagement\CouponCalculationTrait;
use Modules\RideShare\Traits\TripManagement\DiscountCalculationTrait;
use Modules\RideShare\Traits\UserManagement\LevelUpdateCheckerTrait;

class TripRequestController extends Controller
{
    use CommonTrait, TransactionTrait, Payment, CouponCalculationTrait, DiscountCalculationTrait, LevelUpdateCheckerTrait;

    public function __construct(
        private TripRequestRepository           $trip,
        private ZoneRepository                  $zone,
        private RecentAddressRepository         $address,
        private FareBiddingRepository           $bidding,
        private UserLastLocationRepository      $lastLocation,
        private UserLastLocationServiceInterface      $userLastLocationService,
        private DriverRepository                $driver,
        private DriverDetailsRepository         $driverDetails,
        private RejectedDriverRequestRepository $rejected_request,
        private TempTripNotificationRepository  $temp_notification,

        private ZoneServiceInterface           $zoneService,
        private CouponSetupServiceInterface    $couponSetupService,
        private TripFareServiceInterface       $tripFareService,
    )
    {
    }

    /**
     * Summary of rideResumeStatus
     * @return JsonResponse
     */
    public function rideResumeStatus(): JsonResponse
    {
        $trip = $this->getResumeRide();
        if (!$trip) {
            return response()->json(responseFormatter(constant: TRIP_REQUEST_404));
        }
        $trip = TripRequestResource::make($trip);

        return response()->json(responseFormatter(constant: DEFAULT_200, content: $trip));
    }

    /**
     * Show estimate fare calculation trip and parcel.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getEstimatedFare(Request $request): JsonResponse
    {

        $trip = $this->getResumeRide();
        if ($request->type == "ride_request" && $trip) {
            return response()->json(responseFormatter(INCOMPLETE_RIDE_403), 403);
        }
        $validator = Validator::make($request->all(), [
            'pickup_coordinates' => 'required',
            'destination_coordinates' => 'required',
            'pickup_address' => 'required',
            'destination_address' => 'required',
            'type' => 'required|in:parcel,ride_request',
            'parcel_weight' => 'required_if:type,parcel',
        ]);
        if ($validator->fails()) {
            return response()->json(responseFormatter(constant: DEFAULT_400, errors: errorProcessor($validator)), 403);
        }

        $user = auth('api')->user();

        $pickup_coordinates = json_decode($request['pickup_coordinates'], true);
        $destination_coordinates = json_decode($request['destination_coordinates'], true);
        $pickup_point = new Point($pickup_coordinates[0], $pickup_coordinates[1]);
        $destination_point = new Point($destination_coordinates[0], $destination_coordinates[1]);


        $intermediate_coordinates = [];
        if (!is_null($request['intermediate_coordinates'])) {
            $intermediate_coordinates = json_decode($request->intermediate_coordinates, true);
            $maximum_intermediate_point = 2;
            if (count($intermediate_coordinates) > $maximum_intermediate_point) {

                return response()->json(responseFormatter(MAXIMUM_INTERMEDIATE_POINTS_403), 403);
            }
        }
        $zone = $this->zoneService->getByPoints($pickup_point)->where('status', 1)->first();
        if (!$zone) {
            return response()->json(responseFormatter(ZONE_404), 403);
        }

        $pickup_location_coverage = $this->zoneService->getByPoints($pickup_point)->where('id', $zone->id)->first();

        $destination_location_coverage = $this->zone->getByPoints($destination_point)->whereId($zone->id)->first();

        if (!$pickup_location_coverage || !$destination_location_coverage) {
            return response()->json(responseFormatter(ZONE_RESOURCE_404), 403);
        }

        if ($request->type == 'ride_request') {
            $trip_fare = $this->tripFareService->getBy(criteria: [
                'zone_id' => $zone->id
            ], relations: ['zone', 'vehicleCategory']);
            // Filter out entries where vehicleCategory is null or status is 0
            $trip_fare = $trip_fare->filter(function ($item) {
                return $item->vehicleCategory !== null && $item->vehicleCategory->is_active != 0;
            });
            
            // Convert back to object and reset keys
            $trip_fare = $trip_fare->values();

            //Get to know in zone's vehicle category car and motorcycle available or not
            $available_categories = $trip_fare->map(function ($query) {
                return $query->vehicleCategory->type;
            })->unique()
                ->toArray();

            if (empty($available_categories)) {

                return response()->json(responseFormatter(NO_ACTIVE_CATEGORY_IN_ZONE_404), 403);
            }
        } else {
            // $parcel_weights = $this->parcel_weight->get(limit: 99999, offset: 1);
            // $parcel_weight_id = null;

            // $parcel_category_id = $request->parcel_category_id;

            // foreach ($parcel_weights as $pw) {
            //     if ($request->parcel_weight >= $pw->min_weight && $request->parcel_weight <= $pw->max_weight) {
            //         $parcel_weight_id = $pw['id'];
            //     }
            // }
            // if (is_null($parcel_weight_id)) {

            //     return response()->json(responseFormatter(PARCEL_WEIGHT_400), 403);
            // }

            // $relations = [
            //     'fares' => [
            //         ['parcel_weight_id', '=', $parcel_weight_id],
            //         ['zone_id', '=', $zone->id],
            //         ['parcel_category_id', '=', $parcel_category_id],
            //     ],
            //     'zone' => []
            // ];
            // $whereHasRelations = [
            //     'fares' => [
            //         'parcel_weight_id' => $parcel_weight_id,
            //         'zone_id' => $zone->id,
            //         'parcel_category_id' => $parcel_category_id,
            //     ]
            // ];
            // $trip_fare = $this->parcelFareService->findOneBy(criteria: ['zone_id' => $zone->id], whereHasRelations: $whereHasRelations, relations: $relations);
        }

        $get_routes = getRoutes(
            originCoordinates: $pickup_coordinates,
            destinationCoordinates: $destination_coordinates,
            intermediateCoordinates: $intermediate_coordinates,
            drivingMode: $request->type == 'ride_request' ? (count($available_categories) == 2 ? ["DRIVE", 'TWO_WHEELER'] : ($available_categories[0] == 'car' ? ['DRIVE'] : ['TWO_WHEELER'])) : ['TWO_WHEELER'],
        );
        
        if ($get_routes[1]['status'] !== "OK") {
            return response()->json(responseFormatter(ROUTE_NOT_FOUND_404, $get_routes[1]['error_detail']), 403);
        }

        $estimated_fare = $this->estimatedFare(
            tripRequest: $request->all(),
            routes: $get_routes,
            zone_id: $zone->id,
            zone: $zone,
            tripFare: $trip_fare,
            beforeCreate: true
        );
        $pickup_point = DB::raw("ST_GeomFromText('POINT({$pickup_coordinates[0]} {$pickup_coordinates[1]})', 4326)");
        $destination_point = DB::raw("ST_GeomFromText('POINT({$destination_coordinates[0]} {$destination_coordinates[1]})', 4326)");

        //Recent address store
        $this->address->store(attributes: [
            'user_id' => $user?->id,
            'zone_id' => $zone->id,
            'pickup_coordinates' => $pickup_point,
            'destination_coordinates' => $destination_point,
            'pickup_address' => $request->pickup_address,
            'destination_address' => $request->destination_address,
        ]);

        return response()->json(responseFormatter(DEFAULT_200, $estimated_fare), 200);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function createRideRequest(Request $request): JsonResponse
    {
        $trip = $this->getResumeRide();
        if ($request->type == "ride_request" && $trip && $request->ride_request_id == null) {
            return response()->json(responseFormatter(INCOMPLETE_RIDE_403), 403);
        }
        $validator = Validator::make($request->all(), [
            // Coordinates and Address Information
            'pickup_coordinates' => 'required_if:ride_request_id,null',
            'destination_coordinates' => 'required_if:ride_request_id,null',
            'customer_coordinates' => 'required_if:ride_request_id,null',
            'customer_request_coordinates' => 'required_if:ride_request_id,null',
            'pickup_address' => 'required_if:ride_request_id,null',
            'destination_address' => 'required_if:ride_request_id,null',

            // Trip and Fare Information
            'estimated_distance' => 'required_if:ride_request_id,null',
            'estimated_time' => 'required_if:ride_request_id,null',
            'estimated_fare' => 'required_if:ride_request_id,null|numeric',
            'bid' => 'required|bool',
            'actual_fare' => ['nullable',
                Rule::requiredIf(function () use ($request) {
                    return $request->bid;
                }), 'numeric'],

            // Return and Cancellation Fees
            'return_fee' => [
                Rule::requiredIf(function () use ($request) {
                    return $request->type === 'parcel' && is_null($request->ride_request_id);
                })
            ],
            'cancellation_fee' => [
                Rule::requiredIf(function () use ($request) {
                    return $request->type === 'parcel' && is_null($request->ride_request_id);
                })
            ],

            // Vehicle Category
            'vehicle_category_id' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    return $request->type === 'ride_request' && is_null($request->ride_request_id);
                }),
            ],

            // Other Fields
            'note' => 'sometimes',
            'type' => 'required|in:parcel,ride_request',

            // Sender and Receiver Information (required only for parcel type)
            'sender_name' => 'required_if:type,parcel',
            'sender_phone' => 'required_if:type,parcel',
            'sender_address' => 'required_if:type,parcel',
            'receiver_name' => 'required_if:type,parcel',
            'receiver_phone' => 'required_if:type,parcel',
            'receiver_address' => 'required_if:type,parcel',

            // Parcel Information (required for parcel type)
            'parcel_category_id' => 'required_if:type,parcel',
            'weight' => 'required_if:type,parcel',
            'payer' => 'required_if:type,parcel',

            // Additional Fare Fields
            'extra_estimated_fare' => 'sometimes|numeric',
            'extra_discount_fare' => 'sometimes|numeric',
            'extra_discount_amount' => 'sometimes|numeric',
            'extra_return_fee' => 'sometimes|numeric',
            'extra_cancellation_fee' => 'sometimes|numeric',
            'extra_fare_amount' => 'sometimes|numeric',
            'extra_fare_fee' => 'sometimes|numeric',

            // Encoded Polyline and Zone Information
            'encoded_polyline' => 'sometimes',
            'zone_id' => 'required|exists:zones,id',

        ]);

        if ($validator->fails()) {

            return response()->json(responseFormatter(constant: DEFAULT_400, errors: errorProcessor($validator)), 403);
        }
        if ($request->ride_request_id) {
            $save_trip = $this->trip->getBy(column: 'id', value: $request['ride_request_id']);
            $pickup_point = $save_trip->coordinate->pickup_coordinates;
            $destination_point = $save_trip->coordinate->destination_coordinates;
        } else {
            $pickup_coordinates = json_decode($request['pickup_coordinates'], true);
            $destination_coordinates = json_decode($request['destination_coordinates'], true);
            $pickup_point = new Point($pickup_coordinates[0], $pickup_coordinates[1]);
            $destination_point = new Point($destination_coordinates[0], $destination_coordinates[1]);
        }

        $zone = $this->zoneService->getByPoints($pickup_point)->where('status', 1)->first();
        if (!$zone) {
            return response()->json(responseFormatter(ZONE_404), 403);
        }

        $pickup_location_coverage = $this->zone->getByPoints($pickup_point)->whereId($zone->id)->first();
        $destination_location_coverage = $this->zone->getByPoints($destination_point)->whereId($zone->id)->first();

        if (!$pickup_location_coverage || !$destination_location_coverage) {
            return response()->json(responseFormatter(ZONE_RESOURCE_404), 403);
        }

        $extraFare = $this->checkZoneExtraFare($zone);
        if (array_key_exists('bid', $request->all()) && $request['bid']) {
            $estimatedFare = $request['actual_fare'];
            $actualFare = $request['actual_fare'];
            $riseRequestCount = 1;
            $returnFee = $request->type == PARCEL ? $request->return_fee : 0;
            $cancellationFee = $request->type == PARCEL ? $request->cancellation_fee : 0;
        } elseif (!empty($extraFare)) {
            $estimatedFare = $request['extra_estimated_fare'];
            $actualFare = $request['extra_estimated_fare'];
            $riseRequestCount = 0;
            $returnFee = $request->type == PARCEL ? $request->extra_return_fee : 0;
            $cancellationFee = $request->type == PARCEL ? $request->extra_cancellation_fee : 0;
        } else {
            $estimatedFare = $request['estimated_fare'];
            $actualFare = $request['estimated_fare'];
            $riseRequestCount = 0;
            $returnFee = $request->type == PARCEL ? $request->return_fee : 0;
            $cancellationFee = $request->type == PARCEL ? $request->cancellation_fee : 0;
        }

        try {
            DB::beginTransaction();
            if ($request->ride_request_id) {
                $save_trip = $this->trip->getBy(column: 'id', value: $request['ride_request_id']);
                $save_trip->estimated_fare = $estimatedFare;
                $save_trip->actual_fare = $actualFare;
                $save_trip->rise_request_count = $riseRequestCount;
                if ($save_trip->discount_id != null) {
                    $save_trip->discount_id = null;
                    $save_trip->discount_amount = null;
                }
                $save_trip->save();
            } else {
                $customer_coordinates = json_decode($request['customer_coordinates'], true);
                $customer_point = new Point($customer_coordinates[0], $customer_coordinates[1]);
                $request->merge([
                    'customer_id' => auth('api')->id(),
                    'zone_id' => $zone->id,
                    'pickup_coordinates' => $pickup_point,
                    'destination_coordinates' => $destination_point,
                    'estimated_fare' => $estimatedFare,
                    'actual_fare' => $actualFare,
                    'return_fee' => $returnFee,
                    'cancellation_fee' => $cancellationFee,
                    'customer_request_coordinates' => $customer_point,
                    'rise_request_count' => $riseRequestCount
                ]);
                $save_trip = $this->trip->store(attributes: $request->all());
            }

            if ($request->bid) {
                $final = $this->trip->getBy(column: 'id', value: $save_trip->id, attributes: ['relations' => 'driver.lastLocations', 'time', 'coordinate', 'fee']);
            } else {
                $tripDiscount = $this->trip->getBy(column: 'id', value: $save_trip->id);
                $vat_percent = (double)get_cache('ride_vat') ?? 1;
                $estimatedAmount = $tripDiscount->actual_fare / (1 + ($vat_percent / 100));
                $discount = $this->getEstimatedDiscount(user: $tripDiscount->customer, zoneId: $tripDiscount->zone_id, tripType: $tripDiscount->type, vehicleCategoryId: $tripDiscount->vehicle_category_id, estimatedAmount: $estimatedAmount);
                if ($discount['discount_amount'] != 0) {
                    $save_trip->discount_amount = $discount['discount_amount'];
                    $save_trip->discount_id = $discount['discount_id'];
                    $save_trip->save();
                }
                $final = $this->trip->getBy(column: 'id', value: $tripDiscount->id, attributes: ['relations' => 'driver.lastLocations', 'time', 'coordinate', 'fee']);
            }
            DB::commit();

            $search_radius = (double)(get_cache('search_radius') ?? 5);
            // Find drivers list based on pickup locations
            $find_drivers = $this->findNearestDriver(
                latitude: $pickup_coordinates[0] ?? $final->coordinate->pickup_coordinates->latitude,
                longitude: $pickup_coordinates[1] ?? $final->coordinate->pickup_coordinates->longitude,
                zone_id: $zone->id,
                radius: $search_radius,
                vehicleCategoryId: $request->vehicle_category_id ?? $final->vehicle_category_id,
                requestType: $request->type ?? $final->type,
                parcelWeight: $request->weight ?? null
            );
            //Send notifications to drivers
            info(count($find_drivers).'_________');
            if (!empty($find_drivers)) {
                $notify = [];
                foreach ($find_drivers as $key => $value) {
                    if ($value->driver?->fcm_token) {
                        $notify[$key]['user_id'] = $value->driver->id;
                        $notify[$key]['ride_request_id'] = $final->id;
                        $notify[$key]['user_type'] = DRIVER;
                    }

                }
                $requestType = $final->type == PARCEL ? 'parcel_request' : RIDE_REQUEST;
                $push = getNotification(key:'driver_new_' . $requestType);
                $notification = [
                    'title' => translate($push['title']),
                    'description' => translate($push['description']),
                    'status' => $push['status'],
                    'ride_request_id' => $final->id,
                    'type' => $final->type,
                    'action' => $push['action'],
                ];
                if (!empty($notify)) {
info($find_drivers);
                    dispatch(new SendPushNotificationJob($notification, $find_drivers, 'driver'))->onQueue('high');
                    $this->temp_notification->store(['data' => $notify]);
                }
                foreach ($find_drivers as $key => $value) {
                    try {
                        checkPusherConnection(CustomerTripRequestEvent::broadcast($value->driver, $final));
                    } catch (Exception $exception) {
                        info("trip request event error: ".$exception->getMessage());
                    }
                }
            }
            //Send notifications to admins
            if (!is_null(Helpers::get_business_data('push_notification_service_file_content'))) {
                // sendTopicNotification(
                //     'admin_message',
                //     translate('new_request_notification'),
                //     translate('new_request_has_been_placed'),
                //     'null',
                //     $final->id,
                //     $request->type);
                $data = [
                    'title' => translate('new_request_notification'),
                    'description' => translate('messages.new_request_has_been_placed'),
                    'order_id' => $save_trip->id,
                    'image' => '',
                    // 'module_id' => $$save_trip->module_id,
                    'order_type' => $save_trip->type,
                    'zone_id' => $save_trip->zone_id,
                    'type' => 'new_order',
                ];
                Helpers::send_push_notif_to_topic($data, 'admin_message', 'order_request', url('/').'/admin/order/list/all');
            }
            //Trip API resource
            $trip = new TripRequestResource($final);
            return response()->json(responseFormatter(TRIP_REQUEST_STORE_200, $trip));
        }catch (\Exception $exception){
            
            Log::error('Trip Request Create Error', [
                'message' => $exception->getMessage(),
                'line' => $exception->getLine(),
                'file' => $exception->getFile(),
                'trace' => $exception->getTraceAsString(),
            ]);
            return response()->json(errorResponseFormatter(message: $exception->getMessage(), code: 500), 500);
        }


    }

    /**
     * @param $ride_request_id
     * @param Request $request
     * @return JsonResponse
     */
    public function biddingList($ride_request_id, Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric',
            'offset' => 'required|numeric',
        ]);
        if ($validator->fails()) {

            return response()->json(responseFormatter(constant: DEFAULT_400, errors: errorProcessor($validator)), 403);
        }
        $tripRequest = $this->trip->getBy(column: 'id', value: $ride_request_id);
        if ($tripRequest->current_status == PENDING) {
            $bidding = $this->bidding->get(limit: $request['limit'], offset: $request['offset'], dynamic_page: true, attributes: [
                'ride_request_id' => $ride_request_id,
                'relations' => ['driver_last_location', 'driver', 'trip_request', 'driver.rider_vehicle.model'],
                'withAvgRelation' => 'driverReceivedReviews',
                'withAvgColumn' => 'rating',
            ]);
            $bidding = FareBiddingResource::collection($bidding);

            return response()->json(responseFormatter(constant: DEFAULT_200, content: $bidding, limit: $request['limit'], offset: $request['offset']));
        }
        return response()->json(responseFormatter(constant: DEFAULT_200, content: []));

    }


    public function ignoreBidding(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'bidding_id' => 'required',
        ]);
        if ($validator->fails()) {

            return response()->json(responseFormatter(constant: DEFAULT_400, errors: errorProcessor($validator)), 403);
        }

        $bidding = $this->bidding->getBy(column: 'id', value: $request['bidding_id']);
        if (!$bidding) {

            return response()->json(responseFormatter(constant: DRIVER_BID_NOT_FOUND_403), 403);
        }

        $this->bidding->update(attributes: [
            'column' => 'id',
            'is_ignored' => 1
        ], id: $request->bidding_id);
        if ($bidding->driver_id) {
            if (!is_null($bidding->driver->fcm_token)) {
                $push = getNotification(key:'driver_customer_rejected_bid');
                sendDeviceNotification(fcm_token: $bidding->driver->fcm_token,
                    title: translate($push['title']),
                    description: translate(textVariableDataFormat(value: $push['description'], tripId: $bidding->trip_request->ref_id)),
                    status: $push['status'],
                    ride_request_id: $bidding->ride_request_id,
                    type: $bidding->ride_request_id,
                    action: $push['action'],
                    user_id: $bidding->driver->id
                );
            }
        }

        return response()->json(responseFormatter(constant: DEFAULT_200));
    }


    /**
     *
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function requestAction(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'ride_request_id' => 'required',
            'driver_id' => 'required',
            'action' => 'required|in:accepted,rejected',
        ]);

        if ($validator->fails()) {

            return response()->json(responseFormatter(constant: DEFAULT_400, errors: errorProcessor($validator)), 403);
        }

        $trip = $this->trip->getBy(column: 'id', value: $request['ride_request_id'], attributes: ['relations' => 'coordinate']);
        $driver = $this->driver->getBy(column: 'id', value: $request['driver_id'], attributes: ['relations' => ['vehicle', 'driverDetails', 'lastLocations']]);

        if (Cache::get($request['ride_request_id']) == ACCEPTED && $trip->driver_id == $driver->id) {

            return response()->json(responseFormatter(DEFAULT_UPDATE_200));
        }

        $user_status = $driver->driverDetails->availability_status;
        if ($user_status != 'on_bidding' && $user_status != 'available') {

            return response()->json(responseFormatter(constant: DRIVER_403), 403);
        }
        if (!$trip) {
            return response()->json(responseFormatter(constant: TRIP_REQUEST_404), 403);
        }
        if (!$driver->rider_vehicle) {
            return response()->json(responseFormatter(constant: DEFAULT_404), 403);
        }
        if (get_cache('bid_on_fare') ?? 1) {
            $checkBid = $this->bidding->getBy(column: 'ride_request_id', value: $request['ride_request_id'], attributes: [
                'additionalColumn' => 'driver_id',
                'additionalValue' => $request['driver_id']
            ]);

            if (!$checkBid) {
                return response()->json(responseFormatter(constant: DRIVER_BID_NOT_FOUND_403), 403);
            }

        }

        $env = env('APP_MODE');
        $otp = $env != "live" ? '0000' : rand(1000, 9999);
        $attributes = [
            'column' => 'id',
            'driver_id' => $driver->id,
            'otp' => $otp,
            'vehicle_id' => $driver->rider_vehicle->id,
            'current_status' => ACCEPTED,
            'trip_status' => ACCEPTED,
            'vehicle_category_id' => $driver->rider_vehicle->category_id,
        ];

        if ($request['action'] == ACCEPTED) {
            DB::beginTransaction();
            Cache::put($trip->id, ACCEPTED, now()->addHour());

            //set driver availability_status as on_trip
            $driverDetails = $this->driverDetails->getBy(column: 'user_id', value: $driver->id);
            if ($trip->type == RIDE_REQUEST) {
                $driverDetails->ride_count = 1;
            } 
            $driverDetails->save();

            //deleting exiting rejected driver request for this trip
            $this->rejected_request->destroyData([
                'column' => 'ride_request_id',
                'value' => $trip->id,
            ]);
            if (get_cache('bid_on_fare') ?? 0) {
                $all_bidding = $this->bidding->get(limit: 200, offset: 1, attributes: [
                    'ride_request_id' => $request['ride_request_id'],
                ]);

                if (count($all_bidding) > 0) {
                    $actual_fare = $all_bidding
                        ->where('driver_id', $request['driver_id'])
                        ->firstWhere('ride_request_id', $request['ride_request_id'])
                        ->bid_fare;
                    $attributes['actual_fare'] = $actual_fare;
                    $attributes['estimated_fare'] = $actual_fare;
                }
            }


            $data = $this->temp_notification->get([
                'relations' => 'user',
                'ride_request_id' => $request['ride_request_id'],
                'whereNotInColumn' => 'user_id',
                'whereNotInValue' => [$driver->id]
            ]);

            $push = getNotification('customer_another_driver_assigned');
            if (!empty($data)) {
                $notification['title'] = translate($push['title']);
                $notification['description'] = translate($push['description']);
                $notification['status'] = $push['status'];
                $notification['ride_request_id'] = $trip->id;
                $notification['type'] = $trip->type;
                $notification['action'] = $push['action'];

                dispatch(new SendPushNotificationJob($notification, $data))->onQueue('high');
                $this->temp_notification->delete($trip->id);
            }
            $driver_arrival_time = getRoutes(
                originCoordinates: [
                    $trip->coordinate->pickup_coordinates->latitude,
                    $trip->coordinate->pickup_coordinates->longitude
                ],
                destinationCoordinates: [
                    $driver->lastLocations->latitude,
                    $driver->lastLocations->longitude
                ],
            );
            if ($driver_arrival_time[1]['status'] !== "OK") {
                return response()->json(responseFormatter(ROUTE_NOT_FOUND_404, $driver_arrival_time[1]['error_detail']), 403);
            }
            if ($trip->type == 'ride_request') {
                $attributes['driver_arrival_time'] = (double)($driver_arrival_time[0]['duration']) / 60;
            }

            //Trip update
            $this->trip->update(attributes: $attributes, id: $request['ride_request_id']);
            $updateTripDiscount = $this->trip->getBy(column: 'id', value: $request['ride_request_id']);
            $updateTripDiscount->discount_id = null;
            $updateTripDiscount->discount_amount = null;
            $updateTripDiscount->save();
            DB::commit();
            if (get_cache('bid_on_fare') ?? 0) {

                $acceptDriverBid = $this->bidding->getBy(column: 'ride_request_id', value: $request['ride_request_id'], attributes: [
                    'additionalColumn' => 'driver_id',
                    'additionalValue' => $request['driver_id']
                ]);
                $all_bidding = $this->bidding->get(limit: 200, offset: 1, attributes: [
                    'ride_request_id' => $request['ride_request_id'],
                    'without_ids' => [$acceptDriverBid->id],
                ]);
                if ($all_bidding->isNotEmpty()) {
                    $this->bidding->destroyData([
                        'column' => 'id',
                        'ids' => $all_bidding->pluck('id')
                    ]);
                }
            }
            $push = getNotification('driver_bid_accepted');
            sendDeviceNotification(fcm_token: $driver->fcm_token,
                title: translate($push['title']),
                description: translate(textVariableDataFormat(value: $push['description'])),
                status: $push['status'],
                ride_request_id: $trip->id,
                type: $trip->type,
                action: $push['action'],
                user_id: $driver->id);
        } else {
            if (get_cache('bid_on_fare') ?? 0) {
                $all_bidding = $this->bidding->get(limit: 200, offset: 1, attributes: [
                    'ride_request_id' => $request['ride_request_id'],
                ]);

                if (count($all_bidding) > 0) {
                    $this->bidding->destroyData([
                        'column' => 'id',
                        'ids' => $all_bidding->pluck('id')
                    ]);
                }

            }
        }

        return response()->json(responseFormatter(constant: BIDDING_ACTION_200));
    }

    public function rideStatusUpdate($ride_request_id, Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json(responseFormatter(constant: DEFAULT_400, errors: errorProcessor($validator)), 403);
        }

        $trip = $this->trip->getBy(column: 'id', value: $ride_request_id, attributes: ['relations' => 'driver.lastLocations', 'time', 'coordinate', 'fee']);
        if (!$trip) {
            return response()->json(responseFormatter(constant: TRIP_REQUEST_404), 403);
        }
        if ($trip->current_status == CANCELLED) {
            return response()->json(responseFormatter(TRIP_STATUS_CANCELLED_403), 403);
        }
        if ($trip->current_status == COMPLETED) {
            return response()->json(responseFormatter(TRIP_STATUS_COMPLETED_403), 403);
        }
        if ($trip->current_status == RETURNING) {
            return response()->json(responseFormatter(TRIP_STATUS_RETURNING_403), 403);
        }
        $attributes = [
            'column' => 'id',
            'value' => $ride_request_id,
            'trip_status' => $request['status'],
            'ride_cancellation_reason' => $request['cancel_reason'] ?? null
        ];


        if ($request->status == 'cancelled' && ($trip->current_status == ACCEPTED || $trip->current_status == PENDING)) {
            //referral
            if ($trip->customer->referralCustomerDetails && $trip->customer->referralCustomerDetails->is_used == 0) {
                $trip->customer->referralCustomerDetails()->update([
                    'is_used' => 1
                ]);
                if ($trip->customer?->referralCustomerDetails?->ref_by_earning_amount && $trip->customer?->referralCustomerDetails?->ref_by_earning_amount > 0) {
                    $shareReferralUser = $trip->customer?->referralCustomerDetails?->shareRefferalCustomer;
                    $this->customerReferralEarningTransaction($shareReferralUser, $trip->customer?->referralCustomerDetails?->ref_by_earning_amount);

                    $push = getNotification('other_referral_reward_received');
                    sendDeviceNotification(fcm_token: $shareReferralUser?->cm_firebase_token,
                        title: translate($push['title']),
                        description: translate(textVariableDataFormat(value: $push['description'], referralRewardAmount: getCurrencyFormat($trip->customer?->referralCustomerDetails?->ref_by_earning_amount))),
                        status: $push['status'],
                        ride_request_id: $shareReferralUser?->id,
                        action: $push['action'],
                        user_id: $shareReferralUser?->id
                    );
                }
            }
            $data = $this->temp_notification->get([
                'ride_request_id' => $request['ride_request_id'],
                'relations' => 'user'
            ]);
            $push = getNotification('driver_customer_canceled_trip');
            info("ttttt-1");
            if (!empty($data)) {
                info("ttttt-2");
                if ($trip->driver_id) {
                    info("ttttt-3");
                    if (!is_null($trip->driver->fcm_token)) {
                        sendDeviceNotification(fcm_token: $trip->driver->fcm_token,
                            title: translate($push['title']),
                            description: translate(textVariableDataFormat(value: $push['description'])),
                            status: $push['status'],
                            ride_request_id: $request['ride_request_id'],
                            type: $trip->type,
                            action: $push['action'],
                            user_id: $trip->driver->id
                        );
                    }
                    try {
                        info("driver trip cancelled event fired");
                        // checkPusherConnection(DriverTripCancelledEvent::broadcast($trip->driver, $trip));
                        checkPusherConnection(DriverTripCancelledEvent::broadcast($trip));
                    
                    } catch (Exception $exception) {
                        info("driver trip cancelled event error: ".$exception->getMessage());
                    }
                    
                    try {
                        info("customer trip cancelled event fired");
                        checkPusherConnection(CustomerTripCancelledEvent::broadcast($trip->driver, $trip));
                    } catch (Exception $exception) {
                        info("customer trip cancelled event error: ".$exception->getMessage());
                    }

                    //set driver availability_status as on_trip
                    $driverDetails = $this->driverDetails->getBy(column: 'user_id', value: $trip->driver_id);
                    if ($trip->type == RIDE_REQUEST) {
                        $driverDetails->ride_count = 0;
                    } else {
                        --$driverDetails->parcel_count;
                    }
                    $driverDetails->availability_status = 'available';
                    $driverDetails->save();
                    $attributes['driver_id'] = $trip->driver_id;
                } else {
                    info("ttttt-4");
                    $notification = [
                        'title' => translate($push['title']),
                        'description' => translate($push['description']),
                        'status' => $push['status'],
                        'ride_request_id' => $trip->id,
                        'type' => $trip->type,
                        'action' => $push['action']
                    ];

                    info('_________'.$data);
                    
                    dispatch(new SendPushNotificationJob($notification, $data))->onQueue('high');
                    foreach ($data as $tempNotification) {
                        try {
                            info("customer trip cancelled event fired");
                            checkPusherConnection(CustomerTripCancelledEvent::broadcast($tempNotification->user, $trip));
                        } catch (Exception $exception) {
                            info("customer trip cancelled event error: ".$exception->getMessage());

                        }
                    }
                }
                $this->temp_notification->delete($trip->id);
            }
        }
        if ($trip->is_paused) {

            return response()->json(responseFormatter(TRIP_REQUEST_PAUSED_404), 403);
        }

        if ($trip->driver_id && ($request->status == 'completed' || $request->status == 'cancelled') && $trip->current_status == ONGOING) {
            if ($request->status == 'cancelled') {
                $attributes['fee']['cancelled_by'] = 'customer';
            }
            $attributes['coordinate']['drop_coordinates'] = new Point($trip->driver->lastLocations->latitude, $trip->driver->lastLocations->longitude);

            //set driver availability_status as on_trip
            $driverDetails = $this->driverDetails->getBy(column: 'user_id', value: $trip->driver_id);
            if ($trip->type == RIDE_REQUEST) {
                $driverDetails->ride_count = 0;
            }
            $driverDetails->availability_status = 'available';
            $driverDetails->save();
            $tripType = $trip->type == RIDE_REQUEST ? 'trip' : PARCEL;

            //Get status wise notification message
            $push = getNotification('customer_trip_completed');
            if (!is_null($trip->driver->fcm_token)) {
                sendDeviceNotification(fcm_token: $trip->driver->fcm_token,
                    title: translate($push['title']),
                    description: translate(textVariableDataFormat(value: $push['description'])),
                    status: $push['status'],
                    ride_request_id: $request['ride_request_id'],
                    type: $trip->type,
                    action: $push['action'],
                    user_id: $trip->driver->id
                );
            }
            try {
                checkPusherConnection(CustomerTripCancelledAfterOngoingEvent::broadcast($trip));
            } catch (Exception $exception) {

            }

        }

        DB::beginTransaction();
        if ($request->status == 'cancelled' && $trip->driver_id && $trip->current_status == ONGOING) {
            $this->trip->updateRelationalTable($attributes);
            // $this->customerLevelUpdateChecker(auth()->user());
            $this->driverLevelUpdateChecker($trip->driver);
        } elseif ($request->status == 'completed' && $trip->driver_id && $trip->current_status == ONGOING) {
            $this->trip->updateRelationalTable($attributes);
            // $this->customerLevelUpdateChecker(auth()->user());
            $this->driverLevelUpdateChecker($trip->driver);
        } else {
            $this->trip->updateRelationalTable($attributes);
        }
        DB::commit();


        return response()->json(responseFormatter(DEFAULT_UPDATE_200, TripRequestResource::make($trip)));
    }

    /**
     * @param $ride_request_id
     * @return JsonResponse
     */
    public function rideDetails($ride_request_id): JsonResponse
    {
        $attributes = [
            'relations' => [
                'driver' => function ($query) {
                    $query->withAvg('receivedReviews', 'rating')->withCount('receivedReviews');
                },
                'vehicle.model', 'vehicleCategory', 'tripStatus',
                'coordinate', 'fee', 'time'
            ],
            'withAvgRelation' => 'driverReceivedReviews',
            'withAvgColumn' => 'rating',
            'withCountRelation' => 'driverReceivedReviews'
        ];

        $data = $this->trip->getBy('id', $ride_request_id, $attributes);
        if (!$data) {

            return response()->json(responseFormatter(DEFAULT_404), 403);
        }
        $resource = TripRequestResource::make($data->append('distance_wise_fare'));

        return response()->json(responseFormatter(DEFAULT_200, $resource));

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function rideList(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'filter' => Rule::in([TODAY, PREVIOUS_DAY, THIS_WEEK, LAST_WEEK, LAST_7_DAYS, THIS_MONTH, LAST_MONTH, THIS_YEAR, ALL_TIME, CUSTOM_DATE]),
            'status' => Rule::in([ALL, PENDING, ONGOING, COMPLETED, CANCELLED, RETURNED]),
            'start' => 'required_if:filter,==,custom_date|required_with:end',
            'end' => 'required_if:filter,==,custom_date|required_with:end',
            'limit' => 'required|numeric',
            'offset' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(responseFormatter(constant: DEFAULT_400, errors: errorProcessor($validator)), 403);
        }
        if (!is_null($request->filter) && $request->filter != CUSTOM_DATE) {
            $date = getDateRange($request->filter);
        } elseif (!is_null($request->filter)) {
            $date = getDateRange([
                'start' => $request->start,
                'end' => $request->end
            ]);
        }
        $attributes = [
            'column' => 'customer_id',
            'value' => auth('api')->id(),
            'withAvgRelation' => 'driverReceivedReviews',
            'withAvgColumn' => 'rating',
        ];
        if (!empty($date)) {
            $attributes['from'] = $date['start'];
            $attributes['to'] = $date['end'];
        }
        if (!is_null($request->status) && $request->status != ALL) {
            $attributes['column_name'] = 'current_status';
            $attributes['column_value'] = [$request->status];
        }
        $relations = ['driver', 'vehicle.model', 'vehicleCategory', 'time', 'coordinate', 'fee'];
        $data = $this->trip->get(
            limit: $request['limit'], 
            offset: $request['offset'], 
            dynamic_page: true, 
            attributes: $attributes, 
            relations: $relations
        );
        $resource = TripRequestResource::setData('distance_wise_fare')::collection($data);

        return response()->json(responseFormatter(constant: DEFAULT_200, content: $resource, limit: $request['limit'], offset: $request['offset']));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function filteredRideList(Request $request, $status): JsonResponse
    {
        if(!in_array($status, ['running', 'history'])) {
            abort(404);
        }
        $validator = Validator::make($request->all(), [
            'filter' => Rule::in([TODAY, PREVIOUS_DAY, THIS_WEEK, LAST_WEEK, LAST_7_DAYS, THIS_MONTH, LAST_MONTH, THIS_YEAR, ALL_TIME, CUSTOM_DATE]),
            // 'status' => Rule::in([ALL, PENDING, ONGOING, COMPLETED, CANCELLED, RETURNED]),
            'start' => 'required_if:filter,==,custom_date|required_with:end',
            'end' => 'required_if:filter,==,custom_date|required_with:end',
            'limit' => 'required|numeric',
            'offset' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(responseFormatter(constant: DEFAULT_400, errors: errorProcessor($validator)), 403);
        }
        if (!is_null($request->filter) && $request->filter != CUSTOM_DATE) {
            $date = getDateRange($request->filter);
        } elseif (!is_null($request->filter)) {
            $date = getDateRange([
                'start' => $request->start,
                'end' => $request->end
            ]);
        }
        $attributes = [
            'column' => 'customer_id',
            'value' => auth('api')->id(),
            'withAvgRelation' => 'driverReceivedReviews',
            'withAvgColumn' => 'rating',
        ];
        if (!empty($date)) {
            $attributes['from'] = $date['start'];
            $attributes['to'] = $date['end'];
        }
        if ($status == 'running') {
            $attributes['column_name'] = 'current_status';
            $attributes['column_value'] = [PENDING, ONGOING, ACCEPTED];
        } else {
            $attributes['whereNotInColumn'] = 'current_status';
            $attributes['whereNotInValue'] = [PENDING, ONGOING, ACCEPTED];
        }
        
        $relations = ['driver', 'vehicle.model', 'vehicleCategory', 'time', 'coordinate', 'fee'];
        $data = $this->trip->get(
            limit: $request['limit'], 
            offset: $request['offset'], 
            dynamic_page: true, 
            attributes: $attributes, 
            relations: $relations
        );
        $resource = TripRequestResource::setData('distance_wise_fare')::collection($data);

        return response()->json(responseFormatter(constant: DEFAULT_200, content: $resource, limit: $request['limit'], offset: $request['offset']));
    }


    /**
     * Calculate final trip cost.
     *
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function finalFareCalculation(Request $request): JsonResponse
    {
        $trip = $this->trip->getBy(column: 'id', value: $request['ride_request_id']
            , attributes: ['relations' =>
                ['vehicleCategory.tripFares', 'coupon', 'time', 'coordinate', 'fee', 'tripStatus']
            ]
        );

        if (!$trip) {
            return response()->json(responseFormatter(constant: TRIP_REQUEST_404), 403);
        }

        if ($trip->current_status != 'completed' && $trip->current_status != 'cancelled' && $trip->type == 'ride_request') {

            return response()->json(responseFormatter(constant: TRIP_STATUS_NOT_COMPLETED_200));
        }

        if ($trip->customer_id != auth('api')->id() && $trip->driver_id != auth('delivery_men')->id()) {

            return response()->json(responseFormatter(constant: DEFAULT_404), 403);
        }
        if ($trip->discount_amount != null && $trip->discount_amount > 0 && $trip->actual_fare == $trip->discount_amount) {
            $trip = $this->trip->getBy(column: 'id', value: $request['ride_request_id']
                , attributes: ['relations' => [
                    'vehicleCategory.tripFares', 'customer', 'driver', 'coupon', 'discount', 'time', 'coordinate', 'fee', 'tripStatus']
                ]
            );
            $trip = new TripRequestResource($trip->append('distance_wise_fare'));
            return response()->json(responseFormatter(constant: DEFAULT_200, content: $trip));
        }
        if ($trip->paid_fare != 0) {
            $trip = $this->trip->getBy(column: 'id', value: $request['ride_request_id']
                , attributes: ['relations' => [
                    'vehicleCategory.tripFares', 'customer', 'driver', 'coupon', 'discount', 'time', 'coordinate', 'fee', 'tripStatus']
                ]
            );
            $trip = new TripRequestResource($trip->append('distance_wise_fare'));
            return response()->json(responseFormatter(constant: DEFAULT_200, content: $trip));
        }


        if ($trip->type == 'ride_request') {
            $fare = $trip->vehicleCategory->tripFares->where('zone_id', $trip->zone_id)->first();
            if (!$fare) {
                return response()->json(responseFormatter(ZONE_404), 403);
            }
        } else {
            $fare = null;
        }

        DB::beginTransaction();
        //final fare calculation trait
        $calculated_data = $this->calculateFinalFare($trip, $fare);

        $attributes = [
            'extra_fare_amount' => round($calculated_data['extra_fare_amount'], 2),
            'paid_fare' => round($calculated_data['final_fare'], 2),
            'actual_fare' => round($calculated_data['actual_fare'], 2),
            'column' => 'id',
            'actual_distance' => $calculated_data['actual_distance'],
        ];
        $this->trip->update(attributes: $attributes, id: $request['ride_request_id']);

        $bid_on_fare = FareBidding::where('ride_request_id', $request['ride_request_id'])->where('is_ignored', 0)->first();
        if (($bid_on_fare || $trip->rise_request_count > 0) && $trip->type == 'ride_request') {
            $this->finalFareCouponAutoApply($trip->customer, $request['ride_request_id']);
        } else {
            $this->finalFareDiscountAutoApply($trip->customer, $request['ride_request_id']);
            $this->finalFareCouponAutoApply($trip->customer, $request['ride_request_id']);
        }
        DB::commit();
        $trip = $this->trip->getBy(column: 'id', value: $request['ride_request_id']
            , attributes: ['relations' =>
                ['vehicleCategory.tripFares', 'coupon', 'time', 'coordinate', 'fee', 'tripStatus']
            ]
        );
        $amount = $trip->paid_fare + $trip->return_fee;
        if ($trip->type == PARCEL && $trip->current_status == RETURNING && $trip?->parcel?->payer == "receiver") {
            $trip->paid_fare += $trip->return_fee;
            $trip->due_amount = $amount;
            $trip->save();
        }

        //referral user reward
        if ($trip->customer->referralCustomerDetails && $trip->customer->referralCustomerDetails->is_used == 0) {
            $trip->customer->referralCustomerDetails()->update([
                'is_used' => 1
            ]);
            if ($trip->customer?->referralCustomerDetails?->ref_by_earning_amount && $trip->customer?->referralCustomerDetails?->ref_by_earning_amount > 0) {
                $shareReferralUser = $trip->customer?->referralCustomerDetails?->shareRefferalCustomer;
                $this->customerReferralEarningTransaction($shareReferralUser, $trip->customer?->referralCustomerDetails?->ref_by_earning_amount);

                $push = getNotification('other_referral_reward_received');
                sendDeviceNotification(fcm_token: $shareReferralUser?->cm_firebase_token,
                    title: translate($push['title']),
                    description: translate(textVariableDataFormat(value: $push['description'], referralRewardAmount: getCurrencyFormat($trip->customer?->referralCustomerDetails?->ref_by_earning_amount))),
                    status: $push['status'],
                    ride_request_id: $shareReferralUser?->id,
                    action: $push['action'],
                    user_id: $shareReferralUser?->id
                );
            }

        }
        $trip = $this->trip->getBy(column: 'id', value: $request['ride_request_id']
            , attributes: ['relations' => [
                'vehicleCategory.tripFares', 'customer', 'driver', 'coupon', 'discount', 'time', 'coordinate', 'fee', 'tripStatus']
            ]
        );
        $trip = new TripRequestResource($trip->append('distance_wise_fare'));
        return response()->json(responseFormatter(constant: DEFAULT_200, content: $trip));
    }

    /**
     * Summary of driversNearMe
     * @param Request $request
     * @return JsonResponse
     */
    public function driversNearMe(Request $request): JsonResponse
    {
        if (is_null($request->header('zoneId'))) {
            return response()->json(responseFormatter(ZONE_404));
        }

        // Find drivers list based on customer last locations
        $driver_list = $this->findNearestDriver(
            latitude: $request->latitude,
            longitude: $request->longitude,
            zone_id: $request->header('zoneId'),
            radius: (double)(get_cache('search_radius') ?? 50)
        );
        $lastLocationDriver = LastLocationResource::collection($driver_list);
        return response()->json(responseFormatter(constant: DEFAULT_200, content: $lastLocationDriver));
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function arrivalTime(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'ride_request_id' => 'required'
        ]);

        if ($validator->fails()) {

            return response()->json(responseFormatter(constant: DEFAULT_400, errors: errorProcessor($validator)), 403);
        }
        $time = RideRequestTime::query()->where('ride_request_id', $request->ride_request_id)->first();
        if (!$time) {

            return response()->json(responseFormatter(TRIP_REQUEST_404), 403);
        }
        $time->customer_arrives_at = now();
        $time->save();

        return response()->json(responseFormatter(constant: DEFAULT_UPDATE_200));
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function coordinateArrival(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'ride_request_id' => 'required',
            'is_reached' => 'required|in:coordinate_1,coordinate_2,destination',
        ]);

        if ($validator->fails()) {

            return response()->json(responseFormatter(constant: DEFAULT_400, errors: errorProcessor($validator)), 403);
        }

        $trip = RideRequestCoordinate::query()->where('ride_request_id', $request->ride_request_id)->first();
        if ($request->is_reached == 'coordinate_1') {
            $trip->is_reached_1 = true;
        }
        if ($request->is_reached == 'coordinate_2') {
            $trip->is_reached_2 = true;
        }
        if ($request->is_reached == 'destination') {
            $trip->is_reached_destination = true;
        }
        $trip->save();

        return response()->json(responseFormatter(DEFAULT_UPDATE_200));

    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function storeScreenshot(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'ride_request_id' => 'required',
            'file' => 'required|mimes:jpg,png,webp'
        ]);

        if ($validator->fails()) {

            return response()->json(responseFormatter(constant: DEFAULT_400, errors: errorProcessor($validator)), 403);
        }

        $this->trip->update([
            'column' => 'id',
            'map_screenshot' => $request->file,
        ], $request->ride_request_id);

        return response()->json(responseFormatter(DEFAULT_200));
    }


    /**
     * Summary of findNearestDriver
     * @param mixed $latitude
     * @param mixed $longitude
     * @param mixed $zone_id
     * @param mixed $radius
     * @param null $vehicleCategoryId
     * @return mixed
     */
    private function findNearestDriver($latitude, $longitude, $zone_id, $radius = 50, $vehicleCategoryId = null, $requestType = null, $parcelWeight = null): mixed
    {
        /*
         * replace 6371000 with 6371 for kilometer and 3956 for miles
         */
        $attributes = [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'radius' => $radius,
            'zone_id' => $zone_id,
        ];
        if ($vehicleCategoryId) {
            $attributes['vehicle_category_id'] = $vehicleCategoryId;
        }

        if ($requestType) {
            $attributes['service'] = $requestType;
        }

        if ($requestType) {
            $driverList = $this->lastLocation->getNearestDrivers($attributes);
            return $driverList->filter(function ($driver) use ($requestType) {
                $rideCount = $driver->driverDetails->ride_count ?? 0;
                if ($requestType === RIDE_REQUEST && ($rideCount >= 2 || $driver->driver->getDriverAcceptedTrip())) {
                    return false;
                }
                $destinationCoordinates = json_decode($driver->driver->getDriverOngoingTrip()?->coordinate, true);


                if ($destinationCoordinates && isset($destinationCoordinates['destination_coordinates']['coordinates'])) {
                    $driverLastLongitude = (float)$driver->longitude;
                    $driverLastLatitude = (float)$driver->latitude;
                    $destinationLongitude = (float)$destinationCoordinates['destination_coordinates']['coordinates'][0];
                    $destinationLatitude = (float)$destinationCoordinates['destination_coordinates']['coordinates'][1];
                    $latDifference = deg2rad($destinationLatitude - $driverLastLatitude);
                    $lonDifference = deg2rad($destinationLongitude - $driverLastLongitude);
                    $earthRadius = 6371;

                    $a = sin($latDifference / 2) * sin($latDifference / 2) +
                        cos(deg2rad($driverLastLatitude)) * cos(deg2rad($destinationLatitude)) *
                        sin($lonDifference / 2) * sin($lonDifference / 2);

                    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
                    $distance = $earthRadius * $c;
                    if ($requestType === RIDE_REQUEST && $distance > 1) {
                        return false;
                    }
                }

                return true;
            })->values();
        }

        return $this->lastLocation->getNearestDrivers($attributes);

    }

    /**
     * @return Model|mixed|null
     */
    private function getIncompleteRide(): mixed
    {
        $trip = $this->trip->getBy(column: 'customer_id', value: auth()->id(), attributes: [
            'withAvgRelation' => 'driverReceivedReviews',
            'withAvgColumn' => 'rating',
            'relations' => ['customer', 'driver', 'vehicleCategory', 'vehicleCategory.tripFares', 'vehicle', 'coupon', 'time',
                'coordinate', 'fee', 'tripStatus', 'zone', 'vehicle.model', 'fare_biddings', 'customerReceivedReviews', 'driverReceivedReviews']
        ]);

        if (!$trip || $trip->type != 'ride_request' ||
            $trip->fee->cancelled_by == 'driver' ||
            (!$trip->driver_id && $trip->current_status == 'cancelled') ||
            ($trip->driver_id && $trip->payment_status == PAID)) {

            return null;
        }
        return $trip;
    }

    private function getResumeRide(): mixed
    {
        $attributes = [
            'type' => 'ride_request',
            'column' => 'customer_id',
            'value' => auth()->id(),
        ];
        $tripRequest = $this->trip->getIncompleteRide($attributes);
        if (!$tripRequest) {
            return null;
        }
        $trip = $this->trip->getBy(column: 'id', value: $tripRequest->id, attributes: [
            'withAvgRelation' => 'driverReceivedReviews',
            'withAvgColumn' => 'rating',
            'relations' => ['customer', 'driver', 'vehicleCategory', 'vehicleCategory.tripFares', 'vehicle', 'coupon', 'time',
                'coordinate', 'fee', 'tripStatus', 'zone', 'vehicle.model', 'fare_biddings', 'customerReceivedReviews', 'driverReceivedReviews']
        ]);
        return $trip;
    }

    private function removeCouponData($trip)
    {
        $coupon = $this->couponSetupService->findOne(id: $trip->coupon_id);
        $couponData = [
            'total_used' => max(0, $coupon->total_used - 1),
            'total_amount' => max(0, $coupon?->total_amount - $trip->coupon_amount),
        ];
        $this->couponSetupService->update(id: $coupon->id, data: $couponData);
        $trip = $this->trip->getBy(column: 'id', value: $trip->id);
        $vat_percent = (double)get_cache('ride_vat') ?? 1;
        $final_fare_without_tax = ($trip->paid_fare - $trip->fee->vat_tax - $trip->fee->tips) + $trip->coupon_amount;
        $vat = ($vat_percent * $final_fare_without_tax) / 100;
        $trip->coupon_id = null;
        $trip->coupon_amount = 0;
        $trip->paid_fare = $final_fare_without_tax + $vat + $trip->fee->tips;
        $trip->fee()->update([
            'vat_tax' => $vat
        ]);
        $trip->save();
    }

    private function finalFareDiscountAutoApply($user, $tripId)
    {
        $trip = $this->trip->getBy(column: 'id', value: $tripId);

        $updateTripDiscount = $this->trip->getBy(column: 'id', value: $trip->id);
        $updateTripDiscount->discount_id = null;
        $updateTripDiscount->discount_amount = null;
        $updateTripDiscount->save();

        $finalData = $this->trip->getBy(column: 'id', value: $updateTripDiscount->id);
        $response = $this->getFinalDiscount(user: $user, trip: $finalData);
        if ($response['discount_amount'] != 0) {
            $finalData = $this->trip->getBy(column: 'id', value: $updateTripDiscount->id);
            $admin_trip_commission = (double)get_cache('ride_commission') ?? 0;
            $vat_percent = (double)get_cache('ride_vat') ?? 1;
            $final_fare_without_tax = ($finalData->paid_fare - $finalData->fee->vat_tax - $finalData->fee->tips) - $response['discount_amount'];
            $vat = ($vat_percent * $final_fare_without_tax) / 100;
            $admin_commission = (($final_fare_without_tax * $admin_trip_commission) / 100) + $vat;
            $updateTrip = $this->trip->getBy(column: 'id', value: $finalData->id);
            $updateTrip->discount_id = $response['discount_id'];
            $updateTrip->discount_amount = $response['discount_amount'];
            $updateTrip->paid_fare = $final_fare_without_tax + $vat + $updateTrip->fee->tips;
            $updateTrip->fee()->update([
                'vat_tax' => $vat,
                'admin_commission' => $admin_commission
            ]);
            $updateTrip->save();
            if ($response['discount_id'] != null) {
                $this->updateDiscountCount($response['discount_id'], $response['discount_amount']);
            }
        }
    }

    private function finalFareCouponAutoApply($user, $tripId)
    {
        $trip = $this->trip->getBy(column: 'id', value: $tripId);
        $response = $this->getFinalCouponDiscount(user: $user, trip: $trip);
        if ($response['discount'] != 0) {
            $trip = $this->trip->getBy(column: 'id', value: $tripId);
            $admin_trip_commission = (double)get_cache('ride_commission') ?? 0;
            $vat_percent = (double)get_cache('ride_vat') ?? 1;
            $final_fare_without_tax = ($trip->paid_fare - $trip->fee->vat_tax - $trip->fee->tips) - $response['discount'];
            $vat = ($vat_percent * $final_fare_without_tax) / 100;
            $admin_commission = (($final_fare_without_tax * $admin_trip_commission) / 100) + $vat;
            $updateTrip = $this->trip->getBy(column: 'id', value: $trip->id);
            $updateTrip->coupon_id = $response['coupon_id'];
            $updateTrip->coupon_amount = $response['discount'];
            $updateTrip->paid_fare = $final_fare_without_tax + $vat + $trip->fee->tips;
            $updateTrip->fee()->update([
                'vat_tax' => $vat,
                'admin_commission' => $admin_commission
            ]);
            $updateTrip->save();
            $this->updateCouponCount($response['coupon'], $response['discount']);

        }
    }

    public function trackLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' => 'required',
            'zoneId' => 'required',
        ]);
        if ($validator->fails()) {

            return response()->json(responseFormatter(constant: DEFAULT_400, errors: errorProcessor($validator)), 403);
        }
        $data = [
            'type' => 'customer',
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'zone_id' => $request->zoneId,
            'user_id' => auth('api')->id()
        ];

        $lastLocation = $this->userLastLocationService->findOneBy(criteria: ['user_id' => auth('api')->id(), 'type' => 'customer']);
        if (!$lastLocation) {
            $this->userLastLocationService->create(data: $data);
        } else {
            $this->userLastLocationService->update(id: $lastLocation->id, data: $data);
        }
        // $this->lastLocation->updatedBy(criteria: ['user_id' => auth('delivery_men')->id(), 'type' => 'rider'], data: $data);

        return response()->json(responseFormatter(DEFAULT_STORE_200));
    }

}
