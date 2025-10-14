<?php

namespace Modules\RideShare\Http\Controllers\Web\Admin\TripManagement;

use Modules\RideShare\Http\Controllers\BaseController;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\RideShare\Interface\TripManagement\Service\SafetyAlertServiceInterface;
use Modules\RideShare\Interface\TripManagement\Service\TripRequestServiceInterface;
use Modules\RideShare\Interface\UserManagement\Service\UserLastLocationServiceInterface;

class SafetyAlertController extends BaseController
{
    protected $tripRequestService;
    protected $safetyAlertService;
    protected $userLastLocationService;


    public function __construct(
        TripRequestServiceInterface $tripRequestService, 
        SafetyAlertServiceInterface $safetyAlertService, 
        UserLastLocationServiceInterface $userLastLocationService
    )
    {
        $this->tripRequestService = $tripRequestService;
        $this->safetyAlertService = $safetyAlertService;
        $this->userLastLocationService = $userLastLocationService;
    }

    public function index($type, Request $request)
    {
        /* $whereHasRelation = [
            'sentBy' => [
                'user_type' => $type
            ]
        ]; */
        $relations = [
            'trip.customer', 'trip.driver'
        ];
        $criteria = $request->all();
        $criteria['sent_by_type'] = $type;
        $safetyAlerts = $this->safetyAlertService->index(criteria: $criteria, relations: $relations, orderBy: ['created_at' => 'desc'], limit: paginationLimit(), offset: $request['page'] ?? 1);
        return view('ride-share::admin.safety-alert.index', compact('safetyAlerts', 'type'));
    }

    public function export($type, Request $request)
    {
        /* $whereHasRelations = [
            'sentBy' => [
                'user_type' => $type
            ]
        ]; */
        $relations = [
            'sentBy', 'solvedBy', 'trip.customer', 'trip.driver'
        ];
        $criteria = $request->all();
        $criteria['sent_by_type'] = $type;
        $data = $this->safetyAlertService->export(criteria: $criteria, relations: $relations);
        return exportData($data, $request['file'], '');
    }

    public function markAsSolved($id)
    {
        $attributes = [
            'resolved_by' => auth('admin')->id(),
            'resolved_by_type' => 'admin',
        ];
        $safetyAlert = $this->safetyAlertService->findOneBy(criteria: ['id' => $id]);
        if (!$safetyAlert) {
            Toastr::error('Safety Alert not found');
            return redirect()->back();
        }

        if ($safetyAlert->status == 'solved') {
            Toastr::error('This safety alert is already marked as solved');
            return redirect()->back();
        }

        $this->safetyAlertService->updatedBy(criteria: ['ride_request_id' => $safetyAlert?->ride_request_id, 'sent_by' => $safetyAlert->sent_by], data: $attributes);
        
        $push = getNotification('other_safety_problem_resolved');
        $fcmToken = ($safetyAlert->sent_by_type == DRIVER)
            ? $safetyAlert->sentBy?->fcm_token
            : $safetyAlert->sentBy?->cm_firebase_token;
        sendDeviceNotification(fcm_token: $fcmToken,
            title: translate($push['title']),
            description: translate($push['description']),
            status: 1,
            ride_request_id: $safetyAlert?->ride_request_id,
            type: 'safety_alert',
            action: $push['action'],
            user_id: $safetyAlert?->sent_by
        );
        Toastr::success('Safety Alert marked as solved successfully');
        return redirect()->back()->with('success', 'Safety Alert marked as solved successfully');
    }

    public function ajaxMarkAsSolved($id)
    {
        $attributes = [
            'resolved_by' => auth('admin')->id(),
            'resolved_by_type' => 'admin',
        ];
        $safetyAlert = $this->safetyAlertService->findOneBy(criteria: ['id' => $id]);
        if (!$safetyAlert) {
            return response()->json(['error' => 'Safety Alert not found'], 403);
        }
        if ($safetyAlert->status == 'solved') {
            return response()->json([
                'status' => 403,
                'code' => 'already_solved',
                'message' => translate('This safety alert is already marked as solved')
            ], 403);
        }
        $this->safetyAlertService->updatedBy(criteria: ['ride_request_id' => $safetyAlert?->ride_request_id, 'sent_by' => $safetyAlert?->sent_by], data: $attributes);

        $push = getNotification('other_safety_problem_resolved');
        $fcmToken = ($safetyAlert->sent_by_type == DRIVER)
            ? $safetyAlert->sentBy?->fcm_token
            : $safetyAlert->sentBy?->cm_firebase_token;
        sendDeviceNotification(fcm_token: $fcmToken,
            title: translate($push['title']),
            description: translate($push['description']),
            status: 1,
            ride_request_id: $safetyAlert?->ride_request_id,
            type: 'safety_alert',
            action: $push['action'],
            user_id: $safetyAlert?->sent_by
        );

        return response()->json(['success' => translate('Safety Alert marked as solved successfully')], 200);
    }
}
