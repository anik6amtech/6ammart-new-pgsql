<?php

namespace Modules\RideShare\Http\Controllers\Api\TripManagement\Rider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\RideShare\Http\Resources\TripManagement\SafetyAlertResource;
use Modules\RideShare\Interface\TripManagement\Service\SafetyAlertServiceInterface;
use Modules\RideShare\Interface\TripManagement\Service\TripRequestServiceInterface;

class SafetyAlertController extends Controller
{
    protected $tripRequestService;
    protected $safetyAlertService;


    public function __construct(TripRequestServiceInterface $tripRequestService, SafetyAlertServiceInterface $safetyAlertService)
    {
        $this->tripRequestService = $tripRequestService;
        $this->safetyAlertService = $safetyAlertService;
    }


    public function storeSafetyAlert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ride_request_id' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 403);
        }
        
        $trip = $this->tripRequestService->findOneBy(criteria: ['id' => $request->ride_request_id]);
        if (!$trip) {
            return response()->json(responseFormatter(TRIP_REQUEST_404), 403);
        }


        $safetyAlert = $this->safetyAlertService->findOneBy(criteria: [
            'ride_request_id' => $request->ride_request_id,
            'sent_by_type' => DRIVER
        ]);
        if (!$safetyAlert) {
            $createData = $request->all();
            $createData['sent_by_type'] = DRIVER;
            
            $this->safetyAlertService->create(data: $createData);
            $data = $this->safetyAlertService->findOneBy(criteria: [
                'ride_request_id' => $request->ride_request_id,
                'sent_by_type' => DRIVER
            ], relations: ['trip']);
            $safetyAlertData = new SafetyAlertResource($data);
            
            sendTopicNotification(
                topic: 'admin_safety_alert_notification',
                title: translate('new_safety_alert'),
                description: translate('you_have_new_safety_alert'),
                type: 'safety_alert',
                sentBy: auth('api')->user()?->id,
                tripReferenceId: $data?->trip?->ref_id,
                route: $this->safetyAlertService->safetyAlertLatestUserRoute()
            );
            return response()->json(responseFormatter(SAFETY_ALERT_STORE_200, $safetyAlertData));
        }
        return response()->json(responseFormatter(SAFETY_ALERT_ALREADY_EXIST_400), 403);
    }

    public function resendSafetyAlert($tripRequestId)
    {
        $safetyAlert = $this->safetyAlertService->findOneBy(criteria: [
            'ride_request_id' => $tripRequestId, 'status' => PENDING,
            'sent_by_type' => DRIVER
        ], relations: ['trip']);
        if (!$safetyAlert) {
            return response()->json(responseFormatter(SAFETY_ALERT_NOT_FOUND_404), 403);
        }
        $safetyAlert->increment('number_of_alert');
        $safetyAlertData = new SafetyAlertResource($safetyAlert);

        sendTopicNotification(
            topic: 'admin_safety_alert_notification',
            title: translate('new_safety_alert'),
            description: translate('you_have_new_safety_alert'),
            type: 'safety_alert',
            sentBy: auth('api')->user()?->id,
            tripReferenceId: $safetyAlert?->trip?->ref_id,
            route: $this->safetyAlertService->safetyAlertLatestUserRoute()
        ); 
        return response()->json(responseFormatter(SAFETY_ALERT_RESEND_200, $safetyAlertData));
    }

    public function markAsSolvedSafetyAlert($tripRequestId)
    {
        
        $safetyAlert = $this->safetyAlertService->findOneBy(criteria: [
            'ride_request_id' => $tripRequestId, 'status' => PENDING,
            'sent_by_type' => DRIVER
        ]);
        if (!$safetyAlert) {
            return response()->json(responseFormatter(SAFETY_ALERT_NOT_FOUND_404), 403);
        }
        $attributes = [
            'resolved_by' => auth('delivery_men')->user()?->id,
            'resolved_by_type' => DRIVER
        ];
        $this->safetyAlertService->updatedBy(criteria: [
            'ride_request_id' => $tripRequestId, 'sent_by' => $safetyAlert->sent_by, 'sent_by_type' => DRIVER
        ], data: $attributes);
        $data = $this->safetyAlertService->findOneBy(criteria: [
            'ride_request_id' => $tripRequestId, 'sent_by' => $safetyAlert->sent_by,
            'sent_by_type' => DRIVER
        ]);
        $safetyAlertData = new SafetyAlertResource($data);

        return response()->json(responseFormatter(SAFETY_ALERT_MARK_AS_SOLVED, $safetyAlertData));
    }

    public function showSafetyAlert($tripRequestId)
    {
        $safetyAlert = $this->safetyAlertService->findOneBy(criteria: [
            'ride_request_id' => $tripRequestId, 'sent_by_type' => DRIVER]);

        if (!$safetyAlert) {
            return response()->json(responseFormatter(SAFETY_ALERT_NOT_FOUND_404), 403);
        }

        $safetyAlertData = new SafetyAlertResource($safetyAlert);

        return response()->json(responseFormatter(DEFAULT_200, $safetyAlertData));
    }

    public function deleteSafetyAlert($tripRequestId)
    {
        $safetyAlert = $this->safetyAlertService->findOneBy(criteria: ['ride_request_id' => $tripRequestId, 'sent_by_type' => DRIVER]);
        if (!$safetyAlert) {
            return response()->json(responseFormatter(SAFETY_ALERT_NOT_FOUND_404), 403);
        }
        $safetyAlert->delete();
        return response()->json(responseFormatter(SAFETY_ALERT_UNDO_200));
    }
}
