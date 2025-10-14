<?php

namespace Modules\RideShare\Service\TripManagement;

use App\Models\BusinessSetting;
use App\Models\Module;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Modules\RideShare\Interface\TripManagement\Repository\SafetyAlertRepositoryInterface;
use Modules\RideShare\Interface\TripManagement\Service\SafetyAlertServiceInterface;
use Modules\RideShare\Interface\TripManagement\Service\TripRequestServiceInterface;
use Modules\RideShare\Service\BaseService;

class SafetyAlertService extends BaseService implements SafetyAlertServiceInterface
{
    protected $tripRequestService;
    private $map_api_key;

    public function __construct(SafetyAlertRepositoryInterface $safetyAlertRepository, TripRequestServiceInterface $tripRequestService)
    {
        parent::__construct($safetyAlertRepository);
        $this->tripRequestService = $tripRequestService;
        $map_api_key_server = BusinessSetting::where(['key' => 'map_api_key_server'])->first();
        $map_api_key_server = $map_api_key_server ? $map_api_key_server->value : null;
        $this->map_api_key = $map_api_key_server;
    }

    public function index(array $criteria = [], array $relations = [], array $whereHasRelations = [], array $orderBy = [], int $limit = null, int $offset = null, array $withCountQuery = [], array $appends = [], array $groupBy = [], bool $allModule=false): Collection|LengthAwarePaginator
    {
        $searchData = [];
        if (array_key_exists('search', $criteria) && $criteria['search'] != '') {
            $searchData['fields'] = ['alert_location', 'resolved_location'];
            $searchData['relations'] = [
                'solvedBy' => ['f_name', 'l_name', 'email', 'user_type'],
                'trip.customer' => ['f_name', 'l_name', 'email'],
                'trip.driver' => ['f_name', 'l_name', 'email'],
                'trip' => ['ref_id']
            ];
            $searchData['value'] = $criteria['search'];
        }
        $newCriteria = [];
        if(isset($criteria['sent_by_type']) && ($criteria['sent_by_type'] != '')) {
            $newCriteria['sent_by_type'] = ($criteria['sent_by_type'] == CUSTOMER) ? CUSTOMER : DRIVER;
        }
        $newCriteria['status'] = 'solved';
        $whereInCriteria = [];
        $whereBetweenCriteria = [];
        return $this->baseRepository->getBy(criteria: $newCriteria, searchCriteria: $searchData, whereInCriteria: $whereInCriteria, whereBetweenCriteria: $whereBetweenCriteria, whereHasRelations: $whereHasRelations, relations: $relations, orderBy: $orderBy, limit: $limit, offset: $offset, withCountQuery: $withCountQuery, appends: $appends, groupBy: $groupBy);
    }

    public function create(array | Request $data): ?Model
    {
        $tripRequestCurrentStatus = $this->tripRequestService->findOneBy(criteria: ['id' => $data['ride_request_id']])->current_status;
        $mapKey = $this->map_api_key;
        $response = Http::get(MAP_API_BASE_URI . '/geocode/json?latlng=' . $data['lat'] . ',' . $data['lng'] . '&key=' . $mapKey);
        $attributes = [];
        $attributes['ride_request_id'] = $data['ride_request_id'];
        if($data['sent_by_type'] == DRIVER) {
            $attributes['sent_by'] = auth('delivery_men')->id();
        } else {
            $attributes['sent_by'] = auth('api')->user()?->id;
        }
        $attributes['sent_by_type'] = $data['sent_by_type'];
        $attributes['alert_location'] = json_decode($response->body())->results[0]->formatted_address ?? 'N/A';
        $attributes['ride_status_when_make_alert'] = $tripRequestCurrentStatus;
        if (array_key_exists('reason', $data)) {
            if(!is_array($data['reason'])) {
                $attributes['reason'] = json_decode($data['reason']);
            }else{
                $attributes['reason'] = $data['reason'];

            }
        }
        if (array_key_exists('comment', $data)) {
            $attributes['comment'] = $data['comment'];
        }

        return $this->baseRepository->create(data: $attributes);
    }

    public function updatedBy(array $criteria = [], array $whereInCriteria = [], array $data = [], bool $withTrashed = false): ?Model
    {
        $trip = $this->tripRequestService->findOneBy(criteria: ['id' => $criteria['ride_request_id']], relations: ['driver.lastLocations']);
        $mapKey = $this->map_api_key;
        $response = Http::get(MAP_API_BASE_URI . '/geocode/json?latlng=' . $trip?->driver?->lastLocations?->latitude . ',' . $trip?->driver?->lastLocations?->longitude . '&key=' . $mapKey);
        $attributes = [];
        $attributes['resolved_location'] = json_decode($response->body())->results[0]->formatted_address ?? 'N/A';
        $attributes['status'] = 'solved';
        $attributes['resolved_by'] = $data['resolved_by'];
        $attributes['resolved_by_type'] = $data['resolved_by_type'];

        return $this->baseRepository->updatedBy(criteria: $criteria, whereInCriteria: $whereInCriteria, data: $attributes, withTrashed: $withTrashed);
    }


    public function export(array $criteria = [], array $relations = [], array $whereHasRelations = [], array $orderBy = [], int $limit = null, int $offset = null, array $withCountQuery = []): \Illuminate\Support\Collection
    {

        $exportData = $this->index(criteria: $criteria, relations: $relations, whereHasRelations: $whereHasRelations, orderBy: ['created_at' => 'desc'], limit: $limit, offset: $offset);
        return $exportData->map(function ($item) {
            return [
                'Trip Reference Id' => $item->trip->ref_id,
                'Date' => date('d F Y', strtotime($item->created_at)) . ', ' . date('h:i A', strtotime($item->created_at)),
                'Sent By' => $item->sentBy?->full_name ? $item->sentBy->f_name . ' ' . $item->sentBy->l_name : 'N/A',
                'Customer' => $item->trip->customer->full_name ? $item->trip->customer->f_name . ' ' . $item->trip->customer->l_name : 'N/A',
                'Driver' => $item->trip->driver?->full_name ? $item->trip->driver->f_name . ' ' . $item->trip->driver->l_name : 'N/A',
                'Alert Location' => $item->alert_location,
                'Resolved Location' => $item->resolved_location,
                'Number of Alert' => $item->number_of_alert,
                'Resolved By' => $item?->solvedBy?->user_type == 'admin-employee'
                    ? 'Employee - ' . ($item?->solvedBy?->id
                        ? $item?->solvedBy?->f_name . ' ' . $item?->solvedBy?->l_name
                        : '')
                    : $item?->solvedBy?->user_type,
                'Trip Status When Alert Sent' => $item->ride_status_when_make_alert,

            ];
        });
    }

    public function safetyAlertLatestUserRoute(): string
    {
        $firstSafetyAlertRelation = [
            'sentBy', 'trip'
        ];

        $module = Module::where('module_type', 'ride-share')->first();
        $moduleId = $module ? $module->id : null;

        $safetyAlert = $this->baseRepository->findOneBy(criteria: ['status' => PENDING], relations: $firstSafetyAlertRelation, orderBy: ['created_at' => 'desc']);

        $userType = match (true) {
            $safetyAlert?->sentBy?->user_type == 'driver' && ($safetyAlert?->trip?->current_status == 'ongoing' || $safetyAlert?->trip?->current_status == 'accepted') => 'driver-on-trip',
            $safetyAlert?->sentBy?->user_type == 'driver' => 'driver-idle',
            default => 'all-customer',
        };

        return route('admin.ride-share.fleet-map.fleet-map', ['type' => $userType]) . '?zone_id=' . $safetyAlert?->trip?->zone_id . '&module_id=' . $moduleId;
    }

}
