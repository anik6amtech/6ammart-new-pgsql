<?php

namespace Modules\RideShare\Http\Controllers\Api\ReviewModule;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\RideShare\Entities\ReviewModule\RideReview;
use Modules\RideShare\Http\Requests\ReviewModule\ReviewRequest;
use Modules\RideShare\Http\Resources\ReviewModule\ReviewResource;
use Modules\RideShare\Interface\ReviewModule\Service\ReviewServiceInterface;
use Modules\RideShare\Service\TripManagement\TripRequestService;
use Modules\RideShare\Traits\UserManagement\LevelUpdateCheckerTrait;

class ReviewController extends Controller
{
//    use LevelHistoryManagerTrait;
    use LevelUpdateCheckerTrait;
    protected $reviewService;
    protected $tripService;
    public function __construct(ReviewServiceInterface $reviewService, TripRequestService $tripService)
    {
        $this->reviewService = $reviewService;
        $this->tripService = $tripService;
    }


    public function index(Request $request): JsonResponse
    {
        $criteria = [
            'received_by' => auth('api')->id()??auth('delivery_men')->id(),
        ];
        if (!is_null($request->is_saved)) {
            $criteria= array_merge($criteria,[
                'is_saved' => $request->is_saved
            ]);
        }
        $whereHasRelation = [
            'trip'=>[]
        ];
        $review = $this->reviewService->getBy(criteria: $criteria,whereHasRelations: $whereHasRelation, relations: ['givenByUser','givenByDeliveryMan', 'trip'], orderBy: ['created_at'=>'desc'], limit: $request->limit, offset: $request->offset);

        $review = ReviewResource::collection($review);
        return response()->json(responseFormatter(constant: DEFAULT_200, content: $review, limit: $request->limit, offset: $request->offset));
    }


    public function store(ReviewRequest $request): JsonResponse
    {

        $route = str_contains($request->route()?->getPrefix(), 'customer');
        $key = $route ? 'customer_review' : 'driver_review';
        
        //TODO: temp -> no key found in settings like driver_can_review_customer
        /* if ($key == 'driver_review'){
            if (!businessConfig('driver_can_review_customer')->value ?? 0) {
    
                return response()->json(responseFormatter(REVIEW_SUBMIT_403), 403);
            }
        } */

        $tripRequest = $this->tripService->findOne($request['ride_request_id']);
        $user = auth('api')->user();
        $driver = auth('delivery_men')->user();
        if ($tripRequest && ($tripRequest->customer_id == $user?->id || $tripRequest->driver_id == $driver?->id)) {
            if ($key == 'driver_review'){
                $review = $this->reviewService->findOneBy(criteria: [['ride_request_id', $tripRequest->id], ['given_by', $driver->id]]);
            }else{
                $review = $this->reviewService->findOneBy(criteria: [['ride_request_id', $tripRequest->id], ['given_by', $user->id]]);
            }

            if (!$review) {
                DB::beginTransaction();
                if ($key == 'driver_review'){
                    $this->reviewService->apiReviewStore('driver', $tripRequest, $request->all());
                    $this->driverLevelUpdateChecker($driver);
                    $push = getNotification('other_review_from_driver');
                    sendDeviceNotification(fcm_token: $tripRequest->customer->cm_firebase_token,
                        title: translate($push['title']),
                        description: translate(textVariableDataFormat(value: $push['description'])),
                        status: $push['status'],
                        ride_request_id: $tripRequest->id,
                        type: $tripRequest->type,
                        action: $push['action'],
                        user_id: $tripRequest->customer->id
                    );
                }else{
                    $this->reviewService->apiReviewStore('user', $tripRequest, $request->all());
                    $push = getNotification('other_review_from_customer');
                    sendDeviceNotification(fcm_token: $tripRequest->driver->fcm_token,
                        title: translate($push['title']),
                        description: translate(textVariableDataFormat(value: $push['description'])),
                        status: $push['status'],
                        ride_request_id: $tripRequest->id,
                        type: $tripRequest->type,
                        action: $push['action'],
                        user_id: $tripRequest->driver->id
                    );
                }
                DB::commit();
                return response()->json(responseFormatter(DEFAULT_STORE_200));
            }
            return response()->json(responseFormatter(REVIEW_403));
        }
        return response()->json(responseFormatter(DEFAULT_404), 403);
    }


    public function save($id): JsonResponse
    {
        $review = $this->reviewService->findOne(id: $id);
        if ($review && $review->received_by == auth('delivery_men')->id()) {
            $isSaved = $review->is_saved == 0 ? 1 : 0;
            $this->reviewService->update(id: $review->id, data: ['is_saved' => $isSaved]);

            return response()->json(responseFormatter(DEFAULT_UPDATE_200));
        }

        return response()->json(responseFormatter(DEFAULT_404), 403);
    }


    public function checkSubmission(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ride_request_id' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json(responseFormatter(constant: DEFAULT_400, errors: errorProcessor($validator)), 400);
        }

        $review = $this->reviewService->getBy(criteria: [
            'given_by' => auth('api')->id()??auth('delivery_men')->id(),
            'ride_request_id' => $request->ride_request_id
        ]);

        if (!$review) {

            return response()->json(responseFormatter(DEFAULT_200));
        }

        return response()->json(responseFormatter(constant: DEFAULT_200, content: ReviewResource::collection($review)));
    }
}
