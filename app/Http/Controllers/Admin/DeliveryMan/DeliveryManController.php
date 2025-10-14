<?php

namespace App\Http\Controllers\Admin\DeliveryMan;

use Exception;
use App\Models\Order;
use Illuminate\View\View;
use App\Mail\DmSuspendMail;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Mail\DmSelfRegistration;
use App\Traits\NotificationTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use App\Models\DisbursementDetails;
use App\Services\DeliveryManService;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;
use App\Exports\DeliveryManListExport;
use Illuminate\Foundation\Application;
use App\Exports\DeliveryManReviewExport;
use App\Http\Controllers\BaseController;
use App\Exports\DeliveryManEarningExport;
use App\Exports\DisbursementHistoryExport;
use Illuminate\Database\Eloquent\Collection;
use App\Exports\SingleDeliveryManReviewExport;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Enums\ExportFileNames\Admin\DeliveryMan;
use App\Http\Requests\Admin\DeliveryManAddRequest;
use App\Http\Requests\Admin\DeliveryManUpdateRequest;
use App\Contracts\Repositories\ZoneRepositoryInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Contracts\Repositories\MessageRepositoryInterface;
use App\Contracts\Repositories\DmReviewRepositoryInterface;
use App\Contracts\Repositories\UserInfoRepositoryInterface;
use App\Contracts\Repositories\DeliveryManRepositoryInterface;
use App\Contracts\Repositories\TranslationRepositoryInterface;
use App\Contracts\Repositories\ConversationRepositoryInterface;
use App\Enums\ViewPaths\Admin\DeliveryMan as DeliveryManViewPath;
use App\Contracts\Repositories\OrderTransactionRepositoryInterface;
use App\Contracts\Repositories\UserNotificationRepositoryInterface;
use App\Exports\DeliveryManWithdrawTransactionExport;
use App\Models\DeliveryManWallet;
use App\Models\WithdrawRequest;
use Modules\RideShare\Entities\ReviewModule\RideReview;
use Modules\RideShare\Entities\TripManagement\RideRequest;
use Modules\RideShare\Interface\TransactionManagement\Repository\TransactionRepositoryInterface;
use Modules\RideShare\Interface\UserManagement\Service\DriverLevelServiceInterface;
use Modules\RideShare\Interface\UserManagement\Service\DriverServiceInterface;
use Modules\RideShare\Traits\TransactionManagement\TransactionTrait;

class DeliveryManController extends BaseController
{
    use NotificationTrait, TransactionTrait;

    public function __construct(
        protected DeliveryManRepositoryInterface $deliveryManRepo,
        protected ZoneRepositoryInterface $zoneRepo,
        protected TranslationRepositoryInterface $translationRepo,
        protected DmReviewRepositoryInterface $dmReviewRepo,
        protected UserInfoRepositoryInterface $userInfoRepo,
        protected ConversationRepositoryInterface $conversationRepo,
        protected MessageRepositoryInterface $messageRepo,
        protected DeliveryManService $deliveryManService,
        protected DriverLevelServiceInterface $driverLevelService,
        protected TransactionRepositoryInterface $transactionRepository,
        protected DriverServiceInterface $driverService,
    )
    {
    }

    public function index(?Request $request): View|Collection|LengthAwarePaginator|null
    {
        return $this->getListView($request);
    }
    private function getListView(Request $request): View
    {
        $zoneId = $request->query('zone_id', 'all');
        $deliveryMen = $this->deliveryManRepo->getFilterWiseListWhere(
            zoneId: $zoneId,
            searchValue: $request['search'],
            filters: ['type' => 'zone_wise','application_status' => 'approved'],
            additionalFilter: $request['filter'],
            jobType: $request['job_type'],
            relations: ['zone','wallet'],
            dataLimit: config('default_pagination')
        );
        $zone = is_numeric($zoneId) ? $this->zoneRepo->getFirstWhere(params: ['id'=>$zoneId]) : null;
        return view(DeliveryManViewPath::LIST[VIEW], compact('deliveryMen','zone'));
    }

    public function getAddView(): View
    {
        $language = getWebConfig('language');
        $defaultLang = str_replace('_', '-', app()->getLocale());
        return view(DeliveryManViewPath::ADD[VIEW], compact('language','defaultLang'));
    }

    public function getNewDeliveryManView(Request $request): View
    {
        $searchBy = $request->query('search_by');
        $zoneId = $request->query('zone_id', 'all');
        $deliveryMen = $this->deliveryManRepo->getZoneWiseListWhere(
            zoneId: $zoneId,
            searchValue: $searchBy,
            filters: ['type' => 'zone_wise','application_status' => 'pending'],
            relations: ['zone'],
            dataLimit: config('default_pagination')
        );
        $zone = is_numeric($zoneId) ? $this->zoneRepo->getFirstWhere(params: ['id'=>$zoneId]) : null;
        return view(DeliveryManViewPath::NEW[VIEW], compact('deliveryMen','zone','searchBy'));
    }

    public function getDeniedDeliveryManView(Request $request): View
    {
        $searchBy = $request->query('search_by');
        $zoneId = $request->query('zone_id', 'all');
        $deliveryMen = $this->deliveryManRepo->getZoneWiseListWhere(
            zoneId: $zoneId,
            searchValue: $searchBy,
            filters: ['type' => 'zone_wise','application_status' => 'denied'],
            relations: ['zone'],
            dataLimit: config('default_pagination')
        );
        $zone = is_numeric($zoneId) ? $this->zoneRepo->getFirstWhere(params: ['id'=>$zoneId]) : null;
        return view(DeliveryManViewPath::DENY[VIEW], compact('deliveryMen','zone','searchBy'));
    }

    public function getSearchList(Request $request): JsonResponse
    {
        $deliveryMen = $this->deliveryManRepo->getListWhere(
            searchValue: $request['search'],
            filters: ['type' => 'zone_wise','application_status' => 'approved'],
        );
        return response()->json([
            'view'=>view(DeliveryManViewPath::SEARCH[VIEW],compact('deliveryMen'))->render(),
            'count'=>$deliveryMen->count()
        ]);
    }

    public function getActiveSearchList(Request $request): JsonResponse
    {
        $deliveryMen = $this->deliveryManRepo->getFilterWiseListWhere(
            searchValue: $request['search'],
            filters: ['type' => 'zone_wise','status' => 1],
        );
        return response()->json([
            'dm'=>$deliveryMen
        ]);
    }

    public function add(DeliveryManAddRequest $request): Application|Redirector|RedirectResponse
    {
        $firstLevel = $this->driverLevelService->findOneBy(criteria: ['user_type' => DRIVER, 'sequence' => 1]);
        if (!$firstLevel) {
            Toastr::error(LEVEL_403['message']);
            return back();
        }
        $request->merge([
            'user_level_id' => $firstLevel->id,
            'active' => 1,
        ]);
        $this->deliveryManRepo->add(data: $this->deliveryManService->getAddData(request: $request));
        Toastr::success(translate('messages.deliveryman_added_successfully'));
        return back();
    }

    public function getUpdateView(string|int $id): View
    {
        $deliveryMan = $this->deliveryManRepo->getFirstWithoutGlobalScopeWhere(params: ['id' => $id]);
        $language = getWebConfig('language');
        $defaultLang = str_replace('_', '-', app()->getLocale());
        return view(DeliveryManViewPath::UPDATE[VIEW], compact('deliveryMan','language','defaultLang'));
    }

    public function update(DeliveryManUpdateRequest $request, $id): Application|Redirector|RedirectResponse
    {
        $deliveryMan = $this->deliveryManRepo->getFirstWhere(params: ['id' => $id]);

        if(!$deliveryMan->user_level_id){
            $firstLevel = $this->driverLevelService->findOneBy(criteria: ['user_type' => DRIVER, 'sequence' => 1]);
            if (!$firstLevel) {
                Toastr::error(LEVEL_403['message']);
                return back();
            }
            $request->merge([
                'user_level_id' => $firstLevel->id
            ]);
        }

        $deliveryMan = $this->deliveryManRepo->update(id: $id ,data: $this->deliveryManService->getUpdateData(request: $request, deliveryMan: $deliveryMan));
        if($deliveryMan->userinfo) {
            $this->userInfoRepo->update(id: $deliveryMan->userinfo->id,data: [
                'f_name' => $deliveryMan->f_name,
                'l_name' => $deliveryMan->l_name,
                'email' => $deliveryMan->email,
                'image' => $deliveryMan->image,
            ]);
        }

        Toastr::success(translate('messages.deliveryman_updated_successfully'));
        return back();
    }

    public function delete(Request $request): RedirectResponse
    {
        $this->deliveryManRepo->delete(id: $request['id']);
        Toastr::success(translate('messages.deliveryman_deleted_successfully'));
        return back();
    }

    public function updateStatus(Request $request,UserNotificationRepositoryInterface $notificationRepo): RedirectResponse
    {
        $deliveryMan = $this->deliveryManRepo->update(id: $request['id'] ,data: ['status'=>$request['status']]);


            if($request['status'] == 0)
            {   $deliveryMan->auth_token = null;

                if(isset($deliveryMan->fcm_token) &&  Helpers::getNotificationStatusData('deliveryman','deliveryman_account_block','push_notification_status'))
                {
                    $data = [
                        'title' => translate('messages.suspended'),
                        'description' => translate('messages.your_account_has_been_suspended'),
                        'order_id' => '',
                        'image' => '',
                        'type'=> 'block'
                    ];
                    $this->sendPushNotificationToDevice($deliveryMan->fcm_token, $data);

                    $notificationRepo->add([
                        'data'=> json_encode($data),
                        'delivery_man_id'=>$deliveryMan->id,
                        'created_at'=>now(),
                        'updated_at'=>now()
                    ]);
                }
                else{
                    Toastr::warning(translate('messages.push_notification_failed'));
                }
            } else{
                if( Helpers::getNotificationStatusData('deliveryman','deliveryman_account_unblock','push_notification_status') && isset($deliveryMan->fcm_token))
                {
                    $data = [
                        'title' => translate('messages.Account_activation'),
                        'description' => translate('messages.your_account_has_been_activated'),
                        'order_id' => '',
                        'image' => '',
                        'type'=> 'unblock'
                    ];
                    Helpers::send_push_notif_to_device($deliveryMan->fcm_token, $data);

                    DB::table('user_notifications')->insert([
                        'data'=> json_encode($data),
                        'delivery_man_id'=>$deliveryMan->id,
                        'created_at'=>now(),
                        'updated_at'=>now()
                    ]);
                }
            }
            try {
                if (config('mail.status') && getWebConfigStatus('suspend_mail_status_dm') == '1' &&  $request['status'] == 0 && Helpers::getNotificationStatusData('deliveryman','deliveryman_account_block','mail_status') ) {
                    Mail::to($deliveryMan['email'])->send(new DmSuspendMail('suspend',$deliveryMan['f_name']));
                }
                elseif(config('mail.status') && getWebConfigStatus('unsuspend_mail_status_dm') == '1' &&  $request['status'] != 0 && Helpers::getNotificationStatusData('deliveryman','deliveryman_account_unblock','mail_status')){
                    Mail::to($deliveryMan['email'])->send(new DmSuspendMail('unsuspend',$deliveryMan['f_name']));
                }
            }  catch (Exception) {
                Toastr::warning(translate('messages.failed_to_send_mail'));
            }

        Toastr::success(translate('messages.deliveryman_status_updated'));
        return back();
    }
    public function updateEarning(Request $request): RedirectResponse
    {
        $this->deliveryManRepo->update(id: $request['id'] ,data: ['earning'=>$request['status']]);
        Toastr::success(translate('messages.deliveryman_type_updated'));
        return back();
    }

    public function exportList(Request $request): BinaryFileResponse
    {
        $zoneId = $request->query('zone_id', 'all');
        $deliveryMen = $this->deliveryManRepo->getZoneWiseListWhere(
            zoneId: $zoneId,
            searchValue: $request['search'],
            filters: ['type' => 'zone_wise','application_status' => 'approved'],
            relations: ['zone']
        );
        $zone = is_numeric($zoneId) ? $this->zoneRepo->getFirstWhere(params: ['id'=>$zoneId]) : null;

        $data = [
            'delivery_men'=>$deliveryMen,
            'search'=>$request->search??null,
            'zone'=>is_numeric($zoneId)?$zone['name']:null,
        ];

        if ($request['type'] == 'excel') {
            return Excel::download(new DeliveryManListExport($data), DeliveryMan::EXPORT_XLSX);
        }
        return Excel::download(new DeliveryManListExport($data), DeliveryMan::EXPORT_CSV);
    }

    public function getReviewListView(Request $request): View
    {
        $filter=$request['deliveryman_id'] && is_numeric($request['deliveryman_id'])  ?  ['delivery_man_id' => $request['deliveryman_id'] ] : [];
        $orderBy=$request['order_by'] && isset($request['order_by']) && in_array($request['order_by'],['asc','desc']) ?  ['col' => 'rating' ,'type' => $request['order_by'] ] : [];


        if($request->tab == 'rides'){

            $reviews = RideReview::where('review_for', 'driver')
                ->when($request['search'], function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        $q->where('feedback', 'like', "%{$request['search']}%")
                            ->orWhereHas('givenByUser', function ($q) use ($request) {
                                $q->where('f_name', 'like', "%{$request['search']}%")
                                  ->orWhere('l_name', 'like', "%{$request['search']}%");
                            });
                    });
                })
                ->when(($request['deliveryman_id'] && is_numeric($request['deliveryman_id'])), function ($query) use ($request) {
                    $query->where('received_by', $request['deliveryman_id']);
                })
                ->when(count($orderBy) > 0, function ($query) use ($orderBy) {
                    $query->orderBy($orderBy['col'], $orderBy['type']);
                }, function ($query) {
                    $query->latest();
                })
                ->with(['givenByUser', 'trip', 'receivedByDeliveryMan'])
                ->paginate(config('default_pagination'));

            return view('admin-views.delivery-man.ride-reviews-list', compact('reviews'));
        } else {
            $reviews = $this->dmReviewRepo->getListWhereOrder(searchValue: $request['search'],
            filters:$filter ,relations: ['delivery_man','customer','order'],dataLimit: config('default_pagination') ,orderBy: $orderBy);
            return view(DeliveryManViewPath::REVIEW_LIST[VIEW],compact('reviews'));
        }

    }

    public function getReviewSearchList(Request $request): JsonResponse
    {
        $reviews = $this->dmReviewRepo->getListWhere(searchValue: $request['search'],relations: ['delivery_man','customer']);

        return response()->json([
            'view' => view(DeliveryManViewPath::REVIEW_SEARCH_LIST[VIEW], compact('reviews'))->render(),
            'count' => $reviews->count()
        ]);
    }

    public function getAllReviewExportList(Request $request): BinaryFileResponse
    {
        $reviews = $this->dmReviewRepo->getListWhere(searchValue: $request['search'],relations: ['delivery_man','customer']);
        $data = [
            'reviews'=>$reviews,
            'search'=>$request->search??null,
        ];

        if ($request['type'] == 'excel') {
            return Excel::download(new DeliveryManReviewExport($data), DeliveryMan::REVIEW_EXPORT_XLSX);
        }
        return Excel::download(new DeliveryManReviewExport($data), DeliveryMan::EXPORT_CSV);

    }

    public function updateReviewStatus(Request $request): RedirectResponse
    {
        $this->dmReviewRepo->update(id: $request['id'] ,data: ['status'=>$request['status']]);
        Toastr::success(translate('messages.review_visibility_updated'));
        return back();
    }

    public function getReviewExportList(Request $request): BinaryFileResponse
    {
        $deliveryMan = $this->deliveryManRepo->getFirstWhere(params: ['type' => 'zone_wise','id' => $request['id']], relations: ['reviews']);
        $reviews = $this->dmReviewRepo->getListWhere(searchValue: $request['search'],filters: ['delivery_man_id' => $request['id']]);

        $data = [
            'dm'=>$deliveryMan,
            'reviews'=>$reviews,
            'search'=>$request->search??null,
        ];

        if ($request['type'] == 'excel') {
            return Excel::download(new SingleDeliveryManReviewExport($data), DeliveryMan::REVIEW_EXPORT_XLSX);
        }
        return Excel::download(new SingleDeliveryManReviewExport($data), DeliveryMan::EXPORT_CSV);

    }

    public function getPreview(Request $request, int|string $id, string $tab='info'): View
    {
        $deliveryMan = $this->deliveryManRepo->getFirstWhere(params: ['type' => 'zone_wise','id' => $id], relations: ['reviews']);
        if($tab == 'info')
        {
            if($request->tab == 'rides'){
                $reviews = RideReview::where('review_for', 'driver')->where('received_by', $id)
                    ->with(['givenByUser', 'trip', 'receivedByDeliveryMan'])
                    ->paginate(config('default_pagination'));
                return view(DeliveryManViewPath::RIDEINFO[VIEW], compact('deliveryMan', 'reviews'));
            } else {

                $data = $this->driverService->show(id: $id, data: $request->all());
                $commonData = $data['commonData'];
                // $otherData = $data['otherData'];

                $reviews = $this->dmReviewRepo->getListWhere(filters: ['delivery_man_id'=>$id], dataLimit: config('default_pagination'));
                return view(DeliveryManViewPath::INFO[VIEW], compact('deliveryMan', 'reviews', 'commonData'));
            }
        }
        else if($tab == 'transaction')
        {
            $date = $request->query('date');
            if(request()->type == 'ride') {
                $transactionCriteria['user_id'] = $id;
                $transactionCriteria['user_type'] = DRIVER;
                $searchTransactionCriteria = [];
                if ($request['search']) {
                    $searchTransactionCriteria = [
                        'fields' => ['id'],
                        'value' => $request['search'],
                    ];
                }
                $transactions = $this->transactionRepository
                    ->getBy(criteria: $transactionCriteria, searchCriteria: $searchTransactionCriteria, relations: ['driver'], orderBy: ['updated_at' => 'desc'], limit: paginationLimit(), offset: $request->page ?? 1);
            } else {
                $transactions = [];
            }
            return view(DeliveryManViewPath::TRANSACTION[VIEW], compact('deliveryMan', 'date', 'transactions'));
        }
        else if ($tab == 'order_list') {
            $order_lists = Order::where('delivery_man_id', $deliveryMan->id)->paginate(config('default_pagination'));
            return view(DeliveryManViewPath::ORDER_LIST[VIEW], compact('deliveryMan', 'order_lists'));
        }
        else if ($tab == 'ride_list') {
            $ride_lists = RideRequest::where('driver_id', $deliveryMan->id)->paginate(config('default_pagination'));
            return view(DeliveryManViewPath::RIDE_LIST[VIEW], compact('deliveryMan', 'ride_lists'));
        }
        else if ($tab == 'vehicle') {
            $vehicle = $deliveryMan->rider_vehicle;
            return view(DeliveryManViewPath::RIDER_VEHICLE[VIEW], compact('deliveryMan', 'vehicle'));
        }

        else if ($tab == 'disbursement') {
            $key = explode(' ', $request['search']);
            $disbursements=DisbursementDetails::where('delivery_man_id', $deliveryMan->id)
                ->when(isset($key), function ($q) use ($key){
                    $q->where(function ($q) use ($key) {
                        foreach ($key as $value) {
                            $q->orWhere('disbursement_id', 'like', "%{$value}%")
                                ->orWhere('status', 'like', "%{$value}%");
                        }
                    });
                })
                ->latest()->paginate(config('default_pagination'));
            return view('admin-views.delivery-man.view.disbursement', compact('deliveryMan','disbursements'));
        }

        $user = $this->userInfoRepo->getFirstWhere(params: ['deliveryman_id' => $id]);
        if($user){
            $conversations = $this->conversationRepo->getListWithScope(relations: ['sender', 'receiver', 'last_message'],dataLimit: 8, scopes: ['WhereUser' => [$user['id']]] , conversation_with:$request?->conversation_with ?? 'customer' );
        }else{
            $conversations = [];
        }

        return view(DeliveryManViewPath::CONVERSATION[VIEW], compact('conversations','deliveryMan'));

    }

    public function getEarningListExport(Request $request, OrderTransactionRepositoryInterface $orderTransactionRepo): BinaryFileResponse
    {
        $deliveryMan = $this->deliveryManRepo->getFirstWhere(params: ['type' => 'zone_wise','id' => $request['id']], relations: ['reviews']);
        $earnings=$orderTransactionRepo->getDmEarningList(request: $request);

        $data = [
            'dm'=>$deliveryMan,
            'earnings'=>$earnings,
            'date'=>$request->date??null,
        ];

        if ($request['type'] == 'excel') {
            return Excel::download(new DeliveryManEarningExport($data), 'DeliveryManEarnings.xlsx');
        }
        return Excel::download(new DeliveryManEarningExport($data), 'DeliveryManEarnings.csv');

    }

    public function getDropdownList(Request $request): JsonResponse
    {
        $data = $this->deliveryManRepo->getDropdownList(request: $request);
        return response()->json($data);
    }

    public function getAccountData(Request $request): JsonResponse
    {
        $deliveryMan = $this->deliveryManRepo->getFirstWhere(params: ['id' => $request['id']]);
        $wallet = $deliveryMan['wallet'];
        $cashInHand = 0;
        $balance = 0;

        if($wallet)
        {
            $cashInHand = $wallet->collected_cash;
            $balance = round($wallet->total_earning - $wallet->total_withdrawn - $wallet->pending_withdraw, config('round_up_to_digit'));
        }
        return response()->json(['cash_in_hand'=>$cashInHand, 'earning_balance'=>$balance]);

    }

    public function getConversationList(Request $request): JsonResponse
    {
        // dd($request->all());
        $user = $this->userInfoRepo->getFirstWhere(params: ['deliveryman_id' => $request['user_id']]);
        $deliveryMan = $this->deliveryManRepo->getFirstWhere(params: ['id' => $request['user_id']]);
        if($user){
            $conversations = $this->conversationRepo->getDmConversationList(request: $request,dataLimit: 8 ,user: $user->id);
        }else{
            $conversations = [];
        }
        $view = view(DeliveryManViewPath::CONVERSATION_LIST[VIEW],compact('conversations','deliveryMan'))->render();

        return response()->json(['html'=>$view]);

    }

    public function getConversationView($conversation_id,$user_id): JsonResponse
    {
        $conversations = $this->messageRepo->getListWhere(filters: ['conversation_id' => $conversation_id]);
        $conversation = $this->conversationRepo->getFirstWhere(params: ['id'=>$conversation_id],relations: ['receiver','sender']);
        $receiver = $conversation['receiver'];
        $user = $this->userInfoRepo->getFirstWhere(params: ['id'=>$user_id]);
        return response()->json([
            'view' => view(DeliveryManViewPath::CONVERSATIONS[VIEW], compact('conversations', 'user', 'receiver'))->render()
        ]);
    }

    public function updateApplication(Request $request): RedirectResponse
    {
        $deliveryMan = $this->deliveryManRepo->update(id: $request['id'] ,data: ['application_status'=>$request['status']]);
        if($request['status'] == 'approved') $this->deliveryManRepo->update(id: $request['id'] ,data: ['status'=>1]);
        try{
            if($request['status']=='approved'){

                $mail_status = getWebConfigStatus('approve_mail_status_dm');
                if(config('mail.status') && $mail_status == '1'  && Helpers::getNotificationStatusData('deliveryman','deliveryman_registration_approval','mail_status')){
                    Mail::to($deliveryMan->email)->send(new DmSelfRegistration('approved',$deliveryMan->f_name.' '.$deliveryMan->l_name));
                }
            }else{

                $mail_status = getWebConfigStatus('deny_mail_status_dm');
                if(config('mail.status') && $mail_status == '1' && Helpers::getNotificationStatusData('deliveryman','deliveryman_registration_deny','mail_status')){
                    Mail::to($deliveryMan->email)->send(new DmSelfRegistration('denied', $deliveryMan->f_name.' '.$deliveryMan->l_name));
                }
            }
        }catch(Exception $ex){
            info($ex->getMessage());
        }
        Toastr::success(translate('messages.application_status_updated_successfully'));
        return back();
    }

    public function disbursement_export(Request $request,$id,$type)
    {
        $key = explode(' ', $request['search']);

        $dm= \App\Models\DeliveryMan::find($id);
        $disbursements=DisbursementDetails::where('delivery_man_id', $dm->id)
            ->when(isset($key), function ($q) use ($key){
                $q->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->orWhere('disbursement_id', 'like', "%{$value}%")
                            ->orWhere('status', 'like', "%{$value}%");
                    }
                });
            })
            ->latest()->get();
        $data = [
            'disbursements'=>$disbursements,
            'search'=>$request->search??null,
            'delivery_man'=>$dm->f_name.' '.$dm->l_name,
            'type'=>'dm',
        ];

        if ($request->type == 'excel') {
            return Excel::download(new DisbursementHistoryExport($data), 'Disbursementlist.xlsx');
        } else if ($request->type == 'csv') {
            return Excel::download(new DisbursementHistoryExport($data), 'Disbursementlist.csv');
        }
    }

    public function status_filter(Request $request){
        session()->put('withdraw_status_filter',$request['withdraw_status_filter']);
        return response()->json(session('withdraw_status_filter'));
    }


    public function withdraw_list(Request $request)
    {
        $key = isset($request['search']) ? explode(' ', $request['search']) : [];
        $all = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'all' ? 1 : 0;
        $active = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'approved' ? 1 : 0;
        $denied = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'denied' ? 1 : 0;
        $pending = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'pending' ? 1 : 0;

        $withdraw_req =WithdrawRequest::with(['deliveryman'])
            ->when($all, function ($query) {
                return $query;
            })
            ->when($active, function ($query) {
                return $query->where('approved', 1);
            })
            ->when($denied, function ($query) {
                return $query->where('approved', 2);
            })
            ->when($pending, function ($query) {
                return $query->where('approved', 0);
            })
            ->when(isset($key), function ($query) use ($key) {
                return $query->whereHas('deliveryman', function ($query) use ($key) {
                        foreach ($key as $value) {
                            $query->where('f_name', 'like', "%{$value}%");
                        }
                    });
            })
            ->where('delivery_man_id', '!=', null)
            ->latest()
            ->paginate(config('default_pagination'));

        return view('admin-views.wallet.dm-withdraw', compact('withdraw_req'));
    }
    public function withdraw_export(Request $request)
    {
        $key = isset($request['search']) ? explode(' ', $request['search']) : [];
        $all = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'all' ? 1 : 0;
        $active = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'approved' ? 1 : 0;
        $denied = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'denied' ? 1 : 0;
        $pending = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'pending' ? 1 : 0;

        $withdraw_req =WithdrawRequest::with(['deliveryman'])
            ->when($all, function ($query) {
                return $query;
            })
            ->when($active, function ($query) {
                return $query->where('approved', 1);
            })
            ->when($denied, function ($query) {
                return $query->where('approved', 2);
            })
            ->when($pending, function ($query) {
                return $query->where('approved', 0);
            })
            ->when(isset($key), function ($query) use ($key) {
                return $query->whereHas('deliveryman', function ($query) use ($key) {
                        foreach ($key as $value) {
                            $query->where('f_name', 'like', "%{$value}%")
                                ->orWhere('l_name', 'like', "%{$value}%");
                        }
                    });
            })
            ->where('delivery_man_id', '!=', null)
            ->latest()->get();

        $data = [
            'withdraw_requests'=>$withdraw_req,
            'search'=>$request->search??null,
            'request_status'=>session()->has('withdraw_status_filter')?session('withdraw_status_filter'):null,

        ];

        if ($request->type == 'excel') {
            return Excel::download(new DeliveryManWithdrawTransactionExport($data), 'WithdrawRequests.xlsx');
        } else if ($request->type == 'csv') {
            return Excel::download(new DeliveryManWithdrawTransactionExport($data), 'WithdrawRequests.csv');
        }
    }

    public function getWithdrawDetails(Request $request)
    {
        $withdraw = WithdrawRequest::with(['deliveryman'])->where(['id' => $request->withdraw_id])->first();
        return response()->json([
            'view' => view('admin-views.wallet.dm-partials._side_view', compact('withdraw'))->render(),
        ]);
    }

    public function withdraw_search(Request $request){
        $key = explode(' ', $request['search']);
        $withdraw_req = WithdrawRequest::
        whereHas('deliveryman', function ($query) use ($key) {
            foreach ($key as $value) {
                $query->where('f_name', 'like', "%{$value}%")
                    ->orWhere('l_name', 'like', "%{$value}%");
            }
        })->get();
        $total=$withdraw_req->count();
        return response()->json([
            'view'=>view('admin-views.wallet.dm-partials._table',compact('withdraw_req'))->render(), 'total'=>$total
        ]);
    }

    public function withdraw_view($withdraw_id, $seller_id)
    {
        $wr = WithdrawRequest::with(['vendor'])->where(['id' => $withdraw_id])->first();
        return view('admin-views.wallet.withdraw-view', compact('wr'));
    }

    public function withdrawStatus(Request $request, $id)
    {
        $request->validate([
            'note' => 'max:200',
        ]);
        $withdraw = WithdrawRequest::findOrFail($id);
        $withdraw->approved = $request->approved;
        $withdraw->transaction_note = $request['note'];



        $wallet = DeliveryManWallet::where('delivery_man_id', $withdraw->delivery_man_id)->first();
        if ((string) $wallet->total_earning <  (string) ($wallet->total_withdrawn + $wallet->pending_withdraw) ) {
            Toastr::error(translate('messages.Blalnce_mismatched_total_earning_is_too_low'));
            return redirect()->route('admin.transactions.delivery-man.withdraw_list');
        }


        $delivery_man= $withdraw->deliveryman;


        if ($request->approved == 1) {
            // $wallet->increment('total_withdrawn', $withdraw->amount);
            // $wallet->decrement('pending_withdraw', $withdraw->amount);
            $withdraw->save();
            $this->withdrawRequestAcceptTransaction($withdraw->deliveryman, $withdraw->amount, $withdraw);

            $push = getNotification('other_withdraw_request_approved');
            sendDeviceNotification(fcm_token: $delivery_man->fcm_token,
                title: translate($push['title']),
                description: translate(textVariableDataFormat(value: $push['description'])),
                status: $push['status'],
                action: $push['action'],
                user_id: $delivery_man->id
            );
            Toastr::success(translate('messages.rider_withdraw_request_approved'));
            return redirect()->route('admin.transactions.delivery-man.withdraw_list');
        } else if ($request->approved == 2) {
            // $wallet->decrement('pending_withdraw', $withdraw->amount);
            $withdraw->save();
            $this->withdrawRequestCancelTransaction($withdraw->deliveryman, $withdraw->amount, $withdraw);

            $push = getNotification('other_withdraw_request_rejected');
            sendDeviceNotification(fcm_token: $delivery_man->fcm_token,
                title: translate($push['title']),
                description: translate(textVariableDataFormat(value: $push['description'])),
                status: $push['status'],
                action: $push['action'],
                user_id: $delivery_man->id
            );

            Toastr::info(translate('messages.rider_withdraw_request_denied'));
            return redirect()->route('admin.transactions.delivery-man.withdraw_list');
        } else {
            Toastr::error(translate('messages.not_found'));
            return back();
        }
    }
}
