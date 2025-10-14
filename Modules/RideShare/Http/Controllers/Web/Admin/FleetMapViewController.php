<?php

namespace Modules\RideShare\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use Modules\RideShare\Http\Controllers\BaseController;
use Modules\RideShare\Interface\TripManagement\Service\SafetyAlertServiceInterface;
use Modules\RideShare\Interface\UserManagement\Service\CustomerServiceInterface;
use Modules\RideShare\Interface\UserManagement\Service\DriverServiceInterface;
use Modules\RideShare\Interface\ZoneManagement\Service\ZoneServiceInterface;

class FleetMapViewController extends BaseController
{
    protected $zoneService;
    protected $safetyAlertService;
    protected $driverService;
    protected $customerService;

    public function __construct(
        ZoneServiceInterface $zoneService, 
        SafetyAlertServiceInterface $safetyAlertService, 
        DriverServiceInterface $driverService, 
        CustomerServiceInterface $customerService
    )
    {
        parent::__construct($zoneService);
        $this->zoneService = $zoneService;
        $this->safetyAlertService = $safetyAlertService;
        $this->driverService = $driverService;
        $this->customerService = $customerService;
    }

    public function safetyAlertRoute()
    {
        $safetyAlertCount = $this->safetyAlertService->getBy(criteria: ['status' => PENDING])->count();
        return redirect($safetyAlertCount > 0 ? $this->safetyAlertService->safetyAlertLatestUserRoute() : 'javascript:void(0)');
    }

    public function fleetMap(?Request $request, $type = null)
    {
        $zones = $this->zoneService->getBy(relations: ['tripRequest.safetyAlerts']);
        $safetyAlertZones = $zones->filter(function ($zone) {
            return $zone->tripRequest->contains(function ($tripRequest) {
                return $tripRequest->safetyAlerts->where('status', PENDING)->isNotEmpty();
            });
        })->pluck('id')->toArray();
        $safetyAlertCount = $this->safetyAlertService->getBy(criteria: ['status' => PENDING])->count();

        if (array_key_exists('zone_id', $request->all()) && $request['zone_id']) {
            $zone = $this->zoneService->findOne(id: $request['zone_id']);
        } else {
            $zone = count($zones) ? $this->zoneService->findOne(id: $zones[0]->id) : null;
        }
        $safetyAlertLatestUserRoute = $safetyAlertCount > 0 ? $this->safetyAlertService->safetyAlertLatestUserRoute() : 'javascript:void(0)';
        $safetyAlert = $this->safetyAlertService->findOneBy(criteria: ['status' => PENDING], relations: [], orderBy: ['created_at' => 'desc']);
        
        $safetyAlertUserId = $safetyAlert?->sentBy?->id ?? null;

        // Calculate center lat/lng
        $latSum = 0;
        $lngSum = 0;
        $totalPoints = 0;
        $polygons = $zone ? json_encode([formatCoordinates(json_decode($zone?->coordinates[0]->toJson(), true)['coordinates'])]) : json_encode([[]]);
        if ($zone) {
            foreach (formatCoordinates(json_decode($zone?->coordinates[0]->toJson(), true)['coordinates']) as $point) {
                $latSum += $point->lat;
                $lngSum += $point->lng;
                $totalPoints++;
            }
        }
        $centerLat = $latSum / ($totalPoints == 0 ? 1 : $totalPoints);
        $centerLng = $lngSum / ($totalPoints == 0 ? 1 : $totalPoints);
        if ($zone) {
            $data = $this->fleetCommon($type, $zone, $request->all());
            $drivers = $data['drivers'] ?? [];
            $customers = $data['customers'] ?? [];
            $markers = $data['markers'];
            return view('ride-share::admin.maps.fleet-map', compact('drivers', 'customers', 'zones', 'safetyAlertZones', 'safetyAlertCount', 'safetyAlertLatestUserRoute', 'safetyAlertUserId', 'type', 'markers', 'polygons', 'centerLat', 'centerLng'));
        }
        $drivers = [];
        $customers = [];
        $markers = json_encode([[]]);


        return view('ride-share::admin.maps.fleet-map', compact('drivers', 'customers', 'zones', 'safetyAlertZones', 'safetyAlertCount', 'safetyAlertLatestUserRoute', 'safetyAlertUserId', 'type', 'markers', 'polygons', 'centerLat', 'centerLng'));
    }

    public function fleetMapDriverList(?Request $request, $type = null)
    {
        $zones = $this->zoneService->getBy(relations: ['tripRequest.safetyAlerts']);
        if (array_key_exists('zone_id', $request->all()) && $request['zone_id']) {
            $zone = $this->zoneService->findOne(id: $request['zone_id']);
        } else {
            $zone = count($zones) ? $this->zoneService->findOne(id: $zones[0]->id) : null;
        }
        if ($zone) {
            $data = $this->fleetCommon($type, $zone, $request->all());
            $drivers = $data['drivers'];
            return response()
                ->json(view('ride-share::admin.maps.partials.fleet-map._fleet-map-driver-list', compact('drivers'))
                    ->render());
        }
        $drivers = [];
        return response()
            ->json(view('ride-share::admin.maps.partials.fleet-map._fleet-map-driver-list', compact('drivers'))
                ->render());

    }

    public function fleetMapDriverDetails($id, Request $request)
    {
        $driverRelations = [
            'rider_vehicle.model', 'lastLocations', 'receivedReviews', 'driverTrips', 'driverDetails'
        ];
        $driver = $this->driverService->findOneBy(criteria: ['id' => $id], relations: $driverRelations);
        $trip = $driver?->driverTrips()?->whereIn('current_status', [ACCEPTED, ONGOING])->where('type', RIDE_REQUEST)->first();
        $otherTrips = $driver?->driverTrips()->where('id', '!=', $trip?->id)->get();
        $otherTrips = $otherTrips->filter(function ($trip) {
            return $trip?->driverSafetyAlertPending;
        });
        return response()
            ->json(view('ride-share::admin.maps.partials.fleet-map._fleet-map-driver-details', compact('driver', 'trip', 'otherTrips'))
                ->render());
    }

    public function fleetMapCustomerList(?Request $request, $type = null)
    {
        $zones = $this->zoneService->getBy(relations: ['tripRequest.safetyAlerts']);
        if (array_key_exists('zone_id', $request->all()) && $request['zone_id']) {
            $zone = $this->zoneService->findOne(id: $request['zone_id']);
        } else {
            $zone = count($zones) ? $this->zoneService->findOne(id: $zones[0]->id) : null;
        }
        if ($zone) {
            $data = $this->fleetCommon($type, $zone, $request->all());
            $customers = $data['customers'];
            return response()
                ->json(view('ride-share::admin.maps.partials.fleet-map._fleet-map-customer-list', compact('customers'))
                    ->render());
        }
        $customers = [];
        return response()
            ->json(view('ride-share::admin.maps.partials.fleet-map._fleet-map-customer-list', compact('customers'))
                ->render());

    }

    public function fleetMapCustomerDetails($id, Request $request)
    {
        $customerRelations = [
         'customerRides.driver.rider_vehicle.category', 'customerRides.driver.rider_vehicle.brand', 'customerRides.driver.rider_vehicle.model'
        ];

        $customer = $this->customerService->findOneBy(criteria: ['id' => $id], relations: $customerRelations);
        $trip = $customer?->customerRides()?->whereIn('current_status', [ACCEPTED, ONGOING])->where('type', RIDE_REQUEST)->first();
        $otherTrips = $customer?->customerRides()->where('type', RIDE_REQUEST)->where('id', '!=', $trip?->id)->get();
        $otherTrips = $otherTrips->filter(function ($trip) {
            return $trip?->customerSafetyAlertPending;
        });
        return response()
            ->json(view('ride-share::admin.maps.partials.fleet-map._fleet-map-customer-details', compact('customer', 'trip', 'otherTrips'))
                ->render());
    }

    public function fleetMapViewUsingAjax(Request $request)
    {
        $type = $request->type;
        $zones = $this->zoneService->getAll();
        if (array_key_exists('zone_id', $request->all()) && $request['zone_id']) {
            $zone = $this->zoneService->findOne(id: $request['zone_id']);
        } else {
            $zone = count($zones) ? $this->zoneService->findOne(id: $zones[0]->id) : null;
        }
        // Calculate center lat/lng
        $latSum = 0;
        $lngSum = 0;
        $totalPoints = 0;
        $polygons = $zone ? json_encode([formatCoordinates(json_decode($zone?->coordinates[0]->toJson(), true)['coordinates'])]) : json_encode([[]]);
        if ($zone) {
            foreach (formatCoordinates(json_decode($zone?->coordinates[0]->toJson(), true)['coordinates']) as $point) {
                $latSum += $point->lat;
                $lngSum += $point->lng;
                $totalPoints++;
            }
        }
        $centerLat = $latSum / ($totalPoints == 0 ? 1 : $totalPoints);
        $centerLng = $lngSum / ($totalPoints == 0 ? 1 : $totalPoints);
        if ($zone) {
            $data = $this->fleetCommon($type, $zone, $request->all());
            $drivers = $data['drivers'] ?? [];
            $markers = $data['markers'];
            return response()
                ->json(['markers' => $markers, 'polygons' => $polygons, 'centerLat' => $centerLat, 'centerLng' => $centerLng]);

        }
        $markers = json_encode([[]]);
        return response()
            ->json(['markers' => $markers, 'polygons' => $polygons, 'centerLat' => $centerLat, 'centerLng' => $centerLng]);
    }

    public function fleetMapViewSingleDriver($id, Request $request)
    {
        $driverRelations = [
            'rider_vehicle.model', 'lastLocations', 'receivedReviews', 'driverTrips', 'driverDetails'
        ];
        $driver = $this->driverService->findOneBy(criteria: ['id' => $id], relations: $driverRelations);

        $zones = $this->zoneService->getAll();
        if (array_key_exists('zone_id', $request->all()) && $request['zone_id']) {
            $zone = $this->zoneService->findOne(id: $request['zone_id']);
        } else {
            $zone = count($zones) ? $this->zoneService->findOne(id: $zones[0]->id) : null;
        }
        // Calculate center lat/lng
        $latSum = 0;
        $lngSum = 0;
        $totalPoints = 0;
        $polygons = $zone ? json_encode([formatCoordinates(json_decode($zone?->coordinates[0]->toJson(), true)['coordinates'])]) : json_encode([[]]);
        if ($zone) {
            foreach (formatCoordinates(json_decode($zone?->coordinates[0]->toJson(), true)['coordinates']) as $point) {
                $latSum += $point->lat;
                $lngSum += $point->lng;
                $totalPoints++;
            }
        }
        $centerLat = $latSum / ($totalPoints == 0 ? 1 : $totalPoints);
        $centerLng = $lngSum / ($totalPoints == 0 ? 1 : $totalPoints);
        if ($zone) {
            $markers = $this->generateMarker($driver, 'driver');
            $markers = json_encode([$markers]);
            return response()
                ->json(['markers' => $markers, 'polygons' => $polygons, 'centerLat' => $centerLat, 'centerLng' => $centerLng]);
        }
        $markers = json_encode([[]]);
        return response()
            ->json(['markers' => $markers, 'polygons' => $polygons, 'centerLat' => $centerLat, 'centerLng' => $centerLng]);
    }

    public function fleetMapViewSingleCustomer($id, Request $request)
    {
        $customerRelations = [
         'customerRides', 'lastLocations'
        ];

        $customer = $this->customerService->findOneBy(criteria: ['id' => $id], relations: $customerRelations);

        $zones = $this->zoneService->getAll();
        if (array_key_exists('zone_id', $request->all()) && $request['zone_id']) {
            $zone = $this->zoneService->findOne(id: $request['zone_id']);
        } else {
            $zone = count($zones) ? $this->zoneService->findOne(id: $zones[0]->id) : null;
        }
        // Calculate center lat/lng
        $latSum = 0;
        $lngSum = 0;
        $totalPoints = 0;
        $polygons = $zone ? json_encode([formatCoordinates(json_decode($zone?->coordinates[0]->toJson(), true)['coordinates'])]) : json_encode([[]]);
        if ($zone) {
            foreach (formatCoordinates(json_decode($zone?->coordinates[0]->toJson(), true)['coordinates']) as $point) {
                $latSum += $point->lat;
                $lngSum += $point->lng;
                $totalPoints++;
            }
        }
        $centerLat = $latSum / ($totalPoints == 0 ? 1 : $totalPoints);
        $centerLng = $lngSum / ($totalPoints == 0 ? 1 : $totalPoints);
        if ($zone) {
            $markers = $this->generateMarker($customer);
            $markers = json_encode([$markers]);
            return response()
                ->json(['markers' => $markers, 'polygons' => $polygons, 'centerLat' => $centerLat, 'centerLng' => $centerLng]);
        }
        $markers = json_encode([[]]);
        return response()
            ->json(['markers' => $markers, 'polygons' => $polygons, 'centerLat' => $centerLat, 'centerLng' => $centerLng]);
    }

    public function fleetMapZoneMessage()
    {
        $safetyAlertCount = $this->safetyAlertService->getBy(criteria: ['status' => PENDING])->count();

        return response()->json(view('ride-share::admin.maps.partials.fleet-map._safety-alert-get-zone-message', compact('safetyAlertCount'))->render());
    }

    public function fleetMapSafetyAlertIconInMap()
    {
        $safetyAlertCount = $this->safetyAlertService->getBy(criteria: ['status' => PENDING])->count();
        $safetyAlertLatestUserRoute = $safetyAlertCount > 0 ? $this->safetyAlertService->safetyAlertLatestUserRoute() : 'javascript:void(0)';
        $safetyAlert = $this->safetyAlertService->findOneBy(criteria: ['status' => PENDING], relations: ['sentBy',], orderBy: ['created_at' => 'desc']);
        $safetyAlertUserId = $safetyAlert?->sentBy?->id ?? null;

        return response()->json(view('ride-share::admin.maps.partials.fleet-map._safety-alert-icon-in-map', compact('safetyAlertCount', 'safetyAlertLatestUserRoute', 'safetyAlertUserId'))->render());
    }

    private function fleetCommon($type, $zone, $request)
    {
        $searchCriteria = [];
        if (array_key_exists('search', $request)) {
            $searchCriteria = [
                'fields' => ['f_name', 'l_name', 'phone'],
                'value' => $request['search']
            ];
        }
        if ($type == ALL_DRIVER) {
            $driverCriteria = [
                'status' => 1,
            ];
            $driverRelations = [
                'rider_vehicle.model', 'lastLocations', 'receivedReviews', 'driverTrips', 'driverDetails'
            ];
            $driverWhereHasRelations = [
                'driverDetails' => ['is_online' => true],
                'lastLocations' => ['zone_id' => $zone->id],
            ];

            $drivers = $this->driverService->getBy(criteria: $driverCriteria, searchCriteria: $searchCriteria, whereHasRelations: $driverWhereHasRelations, relations: $driverRelations);
        } elseif ($type == DRIVER_ON_TRIP) {
            $driverCriteria = [
                'status' => 1,
            ];
            $driverRelations = [
                'rider_vehicle.model', 'lastLocations', 'receivedReviews', 'driverTrips', 'driverDetails'
            ];
            $driverWhereHasRelations = [
                'driverDetails' => ['is_online' => true],
                'lastLocations' => ['zone_id' => $zone->id],
                'driverTrips' => [
                    'type' => RIDE_REQUEST,
                    'current_status' => [ACCEPTED, ONGOING],
                ],
            ];
            $drivers = $this->driverService->getBy(criteria: $driverCriteria, searchCriteria: $searchCriteria, whereHasRelations: $driverWhereHasRelations, relations: $driverRelations);
        } elseif ($type == DRIVER_IDLE) {
            $driverCriteria = [
                'status' => 1,
            ];
            $driverRelations = [
                'rider_vehicle.model', 'lastLocations', 'receivedReviews', 'driverTrips', 'driverDetails'
            ];
            $driverWhereHasRelations = [
                'driverDetails' => ['is_online' => true],
                'lastLocations' => ['zone_id' => $zone->id],
            ];
            $drivers = $this->driverService->getBy(criteria: $driverCriteria, searchCriteria: $searchCriteria, whereHasRelations: $driverWhereHasRelations, relations: $driverRelations);
            $drivers = $drivers->filter(function ($driver) {
                return $driver->driverTrips
                        ->whereIn('current_status', [ACCEPTED, ONGOING])
                        ->where('type', RIDE_REQUEST)
                        ->count() < 1;
            })->values();
        } elseif ($type == ALL_CUSTOMER) {
            $customerCriteria = [
                'status' => 1,
            ];

            $customerRelations = [
                'lastLocations', 'customerRides'
            ];

            $customerWhereHasRelations = [
                'lastLocations' => ['zone_id' => $zone->id],
            ];

            $customers = $this->customerService->getBy(criteria: $customerCriteria, searchCriteria: $searchCriteria, whereHasRelations: $customerWhereHasRelations, relations: $customerRelations);

            $markers = $this->generateMarkers($customers);
            $markers = json_encode($markers);

            return [
                'markers' => $markers,
                'customers' => $customers];
        } else {
            abort(404);
        }
        $markers = $this->generateMarkers($drivers, 'driver');
        $markers = json_encode($markers);
        return [
            'drivers' => $drivers,
            'markers' => $markers,
        ];
    }

    private function generateMarker($entity, $type = 'customer')
    {
        $trip = ($type === 'customer')
            ? $entity?->customerRides()?->whereIn('current_status', [ACCEPTED, ONGOING])->where('type', RIDE_REQUEST)->first()
            : $entity?->driverTrips()?->whereIn('current_status', [ACCEPTED, ONGOING])->where('type', RIDE_REQUEST)->first();
        $customerWhereHasRelations = [
            'sentBy' => [
                'sent_by_type' => CUSTOMER,
                'id' => $entity?->id,
            ],
        ];
        $driverWhereHasRelations = [
            'sentBy' => [
                'sent_by_type' => DRIVER,
                'id' => $entity?->id,
            ],
        ];
        $safetyAlert = ($type === CUSTOMER)
            ? $this->safetyAlertService->getBy(criteria: ['status' => PENDING], whereHasRelations: $customerWhereHasRelations)->count()
            : $this->safetyAlertService->getBy(criteria: ['status' => PENDING], whereHasRelations: $driverWhereHasRelations)->count();

        if($type === CUSTOMER) {
            $link = $entity?->id ? route('admin.users.customer.ride-share.view', ['user_id' => $entity->id]) : '#';
        } else {
            $link = $entity?->id ? route("admin.users.delivery-man.preview", ['id' => $entity?->id, 'tab' => 'ride_list']) : '#';
        }
        $icon = match (true) {
            $trip && ($safetyAlert > 0) => asset('Modules/RideShare/public/assets/img/ride-share/safety-alert-icon-on-active-trip.png'),
            !$trip && ($safetyAlert > 0) => asset('Modules/RideShare/public/assets/img/ride-share/safety-alert-icon-on-idle-trip.png'),
            $trip && ($safetyAlert == 0) => asset('Modules/RideShare/public/assets/img/ride-share/trip-active.png'),
            default => asset('Modules/RideShare/public/assets/img/ride-share/trip-idle.png'),
        };

        return [
            'id' => $entity?->id,
            'position' => [
                'lat' => $entity?->lastLocations?->latitude ? (double)$entity?->lastLocations?->latitude : 0,
                'lng' => $entity?->lastLocations?->longitude ? (double)$entity?->lastLocations?->longitude : 0,
            ],
            'title' =>  $entity?->f_name . ' ' . $entity?->l_name,
            'subtitle' => $trip ? $trip->ref_id : null,
            "{$type}" => $link,
            'trip' => $trip ? route('admin.ride-share.ride.show', ['type' => ALL, 'id' => $trip->id, 'page' => 'summary']) : '#',
            'icon' => $icon,
            'safetyAlertIcon' => $safetyAlert ? asset('Modules/RideShare/public/assets/img/ride-share/shield-red.svg') : null,
        ];
    }

    private function generateMarkers($entities, $type = 'customer')
    {
        return $entities->map(fn($entity) => $this->generateMarker($entity, $type));
    }
}
