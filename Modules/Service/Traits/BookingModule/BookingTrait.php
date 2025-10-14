<?php

namespace Modules\Service\Traits\BookingModule;

use App\CentralLogics\CustomerLogic;
use App\CentralLogics\Helpers;
use App\Enums\ExportFileNames\Admin\Module;
use App\Models\BusinessSetting;
use App\Models\CustomerAddress;
use App\Models\Module as ModelsModule;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;
use Modules\Service\Entities\BookingModule\Booking;
use Modules\Service\Entities\BookingModule\BookingDetail;
use Modules\Service\Entities\BookingModule\BookingDetailsAmount;
use Modules\Service\Entities\BookingModule\BookingPartialPayment;
use Modules\Service\Entities\BookingModule\BookingRepeat;
use Modules\Service\Entities\BookingModule\BookingRepeatDetails;
use Modules\Service\Entities\BookingModule\BookingScheduleHistory;
use Modules\Service\Entities\BookingModule\BookingStatusHistory;
use Modules\Service\Entities\CartModule\Cart;
use Modules\Service\Entities\PromotionManagement\Coupon;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ProviderManagement\SubscribedService;
use Modules\Service\Entities\ServiceManagement\Service;
use Modules\Service\Events\BookingRequested;
use PhpParser\Node\Expr\AssignOp\Mod;

trait BookingTrait
{
    //=============== PLACE BOOKING ===============

    /**
     * @param $userId
     * @param $request
     * @param $transactionId
     * @param int $isGuest
     * @return array|string[]
     */
    public function placeBookingRequest($userId, $request, $transactionId, $newUserInfo = null, int $isGuest = 0, $moduleId = null): array
    {
        $oldUserId = $userId;
        $moduleId = ModelsModule::where('module_type', 'service')->first()->id;
        $cartData = Cart::where(['customer_id' => $userId, 'module_id' => $moduleId])->get();

        if ($cartData->count() == 0) {
            return ['flag' => 'failed', 'message' => 'no data found'];
        }


        $isPartials = $request['is_partial'] ? 1 : 0;
        $customerWalletBalance = User::find($userId)?->wallet_balance;
        if ($isPartials && $isGuest && ($customerWalletBalance <= 0 || $customerWalletBalance >= $cartData->sum('total_cost'))) {
            return ['flag' => 'failed', 'message' => 'Invalid data'];
        }

        $loginToken = null;
        $bookingIds = [];

        foreach ($cartData->pluck('sub_category_id')->unique() as $subCategory) {

            $booking = new Booking();

            DB::transaction(function () use ($moduleId,$subCategory, $booking, $transactionId, $request, $cartData, $isGuest, $isPartials, $customerWalletBalance,
                &$userId, // Pass by reference
                &$loginToken, // Pass by reference,
                $newUserInfo) {

                if ($newUserInfo != null){
                    $response = $this->registerUserFromCheckoutPage($newUserInfo);

                    $user = $response['user'];
                    $userId = $user->id;
                    $loginToken = $response['loginToken'];
                    $isGuest = 0;
                }

                $cartData = $cartData->where('sub_category_id', $subCategory);

                if ($request->has('payment_method') && $request['payment_method'] == 'cash_after_service') {
                    $transactionId = 'cash-payment';

                } else if ($request->has('payment_method') && $request['payment_method'] == 'wallet_payment') {
                    $transactionId = 'wallet-payment';
                }

                $providerId = $request->has('provider_id') ? $request['provider_id'] : null;

                if ($providerId) {
                    $provider = Provider::where('id', $providerId)->first();

                    if ($provider->business_model == 'subscription') {
                        $booking->booking_type = 'subscription';
                    }
                }

                $totalBookingAmount = $cartData->sum('total_cost');

                $referralDiscount = 0;
                $zoneId = config('zone_id') == null ? $request['zone_id'] : config('zone_id');
                $referralDiscount += $this->referralEarningCalculationForFirstBooking($userId, $totalBookingAmount - $cartData->sum('tax_amount'), $zoneId);
                $totalBookingAmount -= $referralDiscount;

                $bookingAdditionalChargeStatus = BusinessSetting::where('key', 'additional_charge_status')->first()->value ?? 0;
                $extraFee = 0;
                if ($bookingAdditionalChargeStatus) {
                    $extraFee = BusinessSetting::where('key', 'additional_charge')->first()->value ?? 0;
                }
                $totalBookingAmount += $extraFee;


                $location = CustomerAddress::find($request['service_address_id']);
                $latitude = $location ? $location->latitude : null;
                $longitude = $location ? $location->longitude : null;

                $nearestProvider = Provider::select(
                    'id',
                    \DB::raw("
                            (6371 * acos(
                                cos(radians($latitude))
                                * cos(radians(JSON_UNQUOTE(JSON_EXTRACT(coordinates, '$.latitude'))))
                                * cos(radians(JSON_UNQUOTE(JSON_EXTRACT(coordinates, '$.longitude'))) - radians($longitude))
                                + sin(radians($latitude))
                                * sin(radians(JSON_UNQUOTE(JSON_EXTRACT(coordinates, '$.latitude'))))
                            )) AS distance
                        ")
                    )
                    ->where('zone_id', $zoneId)
                    ->where('is_suspended', 0)
                    ->where('is_active', 1)
                    ->whereHas('subscribed_services', function($query) use ($subCategory) {
                        $query->where('sub_category_id', $subCategory)
                            ->where('is_subscribed', 1);
                    })
                    ->orderBy('distance', 'asc')
                    ->first();

                $booking->module_id = $moduleId;
                $booking->customer_id = $userId;
                $booking->provider_id = $cartData->first()->provider_id ?: $nearestProvider->id ?? null;
                $booking->category_id = $cartData->first()->category_id;
                $booking->sub_category_id = $subCategory;
                $booking->zone_id = $zoneId;
                $booking->booking_status = 'pending';
                $booking->is_paid = $request['payment_method'] == 'cash_after_service' || $request['payment_method'] == 'offline_payment' ? 0 : 1;
                $booking->payment_method = $request['payment_method'];
                $booking->transaction_id = $transactionId;
                $booking->total_booking_amount = $totalBookingAmount;
                $booking->total_tax_amount = $cartData->sum('tax_amount');
                $booking->total_discount_amount = $cartData->sum('discount_amount');
                $booking->total_campaign_discount_amount = $cartData->sum('campaign_discount');
                $booking->total_coupon_discount_amount = $cartData->sum('coupon_discount');
                $booking->coupon_code = $cartData->first()->coupon_code;
                $booking->service_schedule = date('Y-m-d H:i:s', strtotime($request['service_schedule'])) ?? now()->addHours(5);
                $booking->service_address_id = $request['service_address_id'] ?? '';
                $booking->booking_otp = rand(100000, 999999);
                $booking->is_guest = $isGuest;
                $booking->extra_fee = $extraFee;
                $booking->total_referral_discount_amount = $referralDiscount;
                $booking->service_address_location = json_encode(CustomerAddress::find($request['service_address_id'])) ?? null;
                $booking->service_location = $request['service_location'];
                $booking->save();

                if ($isPartials) {
                    $paidAmount = $customerWalletBalance;
                    $due_amount = $totalBookingAmount - $paidAmount;

                    $bookingPartialPayment = new BookingPartialPayment;
                    $bookingPartialPayment->booking_id = $booking->id;
                    $bookingPartialPayment->paid_with = 'wallet';
                    $bookingPartialPayment->paid_amount = $paidAmount;
                    $bookingPartialPayment->due_amount = $due_amount;
                    $bookingPartialPayment->save();

                    if ($request['payment_method'] != 'cash_after_service') {
                        $bookingPartialPayment = new BookingPartialPayment;
                        $bookingPartialPayment->booking_id = $booking->id;
                        $bookingPartialPayment->paid_with = $request['payment_method'];
                        $bookingPartialPayment->paid_amount = $due_amount;
                        $bookingPartialPayment->due_amount = 0;
                        $bookingPartialPayment->save();
                    }
                }

                foreach ($cartData->all() as $datum) {
                    $detail = new BookingDetail();
                    $detail->booking_id = $booking->id;
                    $detail->service_id = $datum['service_id'];
                    $detail->service_name = Service::find($datum['service_id'])->name ?? 'service-not-found';
                    $detail->variant_key = $datum['variant_key'];
                    $detail->quantity = $datum['quantity'];
                    $detail->service_cost = $datum['service_cost'];
                    $detail->discount_amount = $datum['discount_amount'];
                    $detail->campaign_discount_amount = $datum['campaign_discount'];
                    $detail->overall_coupon_discount_amount = $datum['coupon_discount'];
                    $detail->tax_amount = $datum['tax_amount'];
                    $detail->total_cost = $datum['total_cost'];
                    $detail->save();

                    $bookingDetailsAmount = new BookingDetailsAmount();
                    $bookingDetailsAmount->booking_details_id = $detail->id;
                    $bookingDetailsAmount->booking_id = $booking->id;
                    $bookingDetailsAmount->service_unit_cost = $datum['service_cost'];
                    $bookingDetailsAmount->service_quantity = $datum['quantity'];
                    $bookingDetailsAmount->service_tax = $datum['tax_amount'];
                    $bookingDetailsAmount->discount_by_admin = $this->calculate_discount_cost($datum['discount_amount'])['admin'];
                    $bookingDetailsAmount->discount_by_provider = $this->calculate_discount_cost($datum['discount_amount'])['provider'];
                    $bookingDetailsAmount->campaign_discount_by_admin = $this->calculate_campaign_cost($datum['campaign_discount'])['admin'];
                    $bookingDetailsAmount->campaign_discount_by_provider = $this->calculate_campaign_cost($datum['campaign_discount'])['provider'];
                    $bookingDetailsAmount->coupon_discount_by_admin = $this->calculate_coupon_cost($datum['coupon_discount'])['admin'];
                    $bookingDetailsAmount->coupon_discount_by_provider = $this->calculate_coupon_cost($datum['coupon_discount'])['provider'];
                    $bookingDetailsAmount->save();
                }

                $schedule = new BookingScheduleHistory();
                $schedule->booking_id = $booking->id;
                $schedule->changed_by = $userId;
                $schedule->is_guest = $isGuest;
                $schedule->user_type = 'customer';
                $schedule->schedule = date('Y-m-d H:i:s', strtotime($request['service_schedule'])) ?? now()->addHours(5);
                $schedule->save();

                /* $statusHistory = new BookingStatusHistory();
                $statusHistory->changed_by = $userId;
                $statusHistory->booking_id = $booking->id;
                $statusHistory->is_guest = $isGuest;
                $statusHistory->user_type = 'customer';
                $statusHistory->booking_status = isset($booking->provider_id) ? 'accepted' : 'pending';
                $statusHistory->save(); */

               if ($booking->booking_partial_payments->isNotEmpty()) {
                   if ($booking['payment_method'] == 'cash_after_service') {
                       placeBookingTransactionForPartialCas($booking);  // waller + CAS payment
                   } elseif ($booking['payment_method'] != 'wallet_payment') {
                       placeBookingTransactionForPartialDigital($booking);  //wallet + digital payment
                   }
               } elseif ($booking['payment_method'] != 'cash_after_service' && $booking['payment_method'] != 'wallet_payment') {
                   placeBookingTransactionForDigitalPayment($booking);  //digital payment
               } elseif ($booking['payment_method'] != 'cash_after_service') {
                   placeBookingTransactionForWalletPayment($booking);   //wallet payment
               }

                //firebaseTopic
                $bookingNotification = (int) (business_config('booking_notification'))?->value;
                $bookingNotificationType = (business_config('booking_notification_type'))?->value;

                if ($bookingNotification && $bookingNotificationType == 'firebase') {
                    try {
                        $serviceAtProviderPlace = (int)(business_config('service_at_provider_place')->value ?? 0);
                        $serviceLocation = $booking->service_location;
                        $zoneId = $booking->zone_id;

                        if (isset($booking->provider_id)){
                            $topic = "demandium_provider_{$zoneId}_{$booking->provider_id}_booking_message";
                            $data = [
                                'title' => translate('Booking Notification'),
                                'description' => translate('messages.new_order_push_description'),
                                'order_id' => $booking->id,
                                'module_id' => $booking->module_id,
                                'order_type' => 'booking_order',
                                'image' => '',
                                'type' => 'new_booking',
                            ];
                            \App\CentralLogics\Helpers::send_push_notif_to_topic($data, "provider_panel_{$booking->provider_id}_message", 'new_order');
                        }else {
                            if ($serviceAtProviderPlace) {
                                if ($serviceLocation === 'provider') {
                                    $topic = "demandium_provider_{$zoneId}_provider_booking_message";
                                }
                                if ($serviceLocation === 'customer') {
                                    $topic = "demandium_provider_{$zoneId}_customer_booking_message";
                                }
                            } else {
                                $topic = "demandium_provider_{$zoneId}_booking_message";
                            }
                        }
                        topic_notification($topic, 'new booking', '', 'def.png', null);
                    } catch (Exception $e) {
                        info("Firebase topic notification failed: " . $e->getMessage());
                    }
                }

                $maximumBookingAmount = (business_config('provider_maximum_booking_amount'))?->value;

                if ($booking->payment_method == 'cash_after_service') {
                    if ($maximumBookingAmount > 0 && $booking->total_booking_amount < $maximumBookingAmount) {
                        if (isset($booking->provider_id) && $booking->booking_status != 'pending') {
                            $provider = Provider::whereId($booking->provider_id)->first();
                            $fcmToken = $provider?->fcm_token ?? null;
                            $languageKey = $provider?->current_language_key;
                           if (!is_null($fcmToken)) {
                                $notification = isNotificationActive($provider?->id, 'booking', 'notification', 'provider');
                                $title = get_push_notification_message('provider_booking_accepted', $languageKey);
                                if ($title && sendDeviceNotificationPermission($booking?->provider_id) && $notification) {
                                    device_notification($fcmToken, $title, null, null, $booking->id, 'booking');
                                }
                           }
                        }elseif (isset($booking->provider_id) && $booking->booking_status == 'pending') {
                            $provider = Provider::whereId($booking->provider_id)->first();
                            $fcmToken = $provider?->fcm_token ?? null;
                            $languageKey = $provider?->current_language_key;
                            if (!is_null($fcmToken)) {
                                $notification = isNotificationActive($provider?->id, 'booking', 'notification', 'provider');
                                $title = get_push_notification_message('provider_new_service_request_arrived', $languageKey);
                                if ($title && sendDeviceNotificationPermission($booking?->provider_id) && $notification) {
                                    device_notification($fcmToken, $title, null, null, $booking->id, 'booking');
                                }
                            }
                        } else {
                            $providerIds = SubscribedService::where('sub_category_id', $subCategory)->ofSubscription(1)->pluck('provider_id')->toArray();
                            if (business_config('provider_suspend_on_exceed_cash_limit')->value) {
                                $providers = Provider::whereIn('id', $providerIds)->where('zone_id', $booking?->zone_id)->where('is_suspended', 0)->get();
                            } else {
                                $providers = Provider::whereIn('id', $providerIds)->where('zone_id', $booking?->zone_id)->get();
                            }

                            foreach ($providers as $provider) {
                                $fcmToken = $provider->fcm_token ?? null;
                                $notification = isNotificationActive($provider?->id, 'booking', 'notification', 'provider');
                                $title = get_push_notification_message('provider_new_service_request_arrived', optional($provider)->current_language_key);

                                if (!is_null($fcmToken) && $provider->service_availability && $title && $notification && sendDeviceNotificationPermission($provider->id)) {
                                    $serviceAtProviderPlace = (int)((business_config('service_at_provider_place'))->value ?? 0);
                                    // $serviceLocations = getProviderSettings(providerId: $provider->id, key: 'service_location', type: 'provider_config') ?? ['customer'];
                                    $serviceLocations = getProviderServiceLocation($provider->id);

                                    if ($serviceAtProviderPlace == 1){
                                        if (in_array($booking->service_location, $serviceLocations)){
                                            device_notification($fcmToken, $title, null, null, $booking->id, 'booking');
                                        }
                                    }else{
                                        device_notification($fcmToken, $title, null, null, $booking->id, 'booking');
                                    }

                                }
                            }
                        }
                    }
                } else {
                    if (isset($booking->provider_id)) {
                        $provider = Provider::whereId($booking->provider_id)->first();
                        $fcmToken = $provider?->fcm_token ?? null;
                        $languageKey = $provider?->current_language_key;
                        if (!is_null($fcmToken)) {
                            $title = get_push_notification_message('provider_booking_accepted', $languageKey);
                            if ($title && $fcmToken && sendDeviceNotificationPermission($booking?->provider_id)) {
                                device_notification($fcmToken, $title, null, null, $booking->id, 'booking');
                            }
                        }
                    } else {
                        $providerIds = SubscribedService::where('sub_category_id', $subCategory)->ofSubscription(1)->pluck('provider_id')->toArray();
                        if (business_config('provider_suspend_on_exceed_cash_limit')->value) {
                            $providers = Provider::whereIn('id', $providerIds)->where('zone_id', $booking->zone_id)->where('is_suspended', 0)->get();
                        } else {
                            $providers = Provider::whereIn('id', $providerIds)->where('zone_id', $booking->zone_id)->get();
                        }

                        foreach ($providers as $provider) {
                            $fcmToken = $provider->fcm_token ?? null;
                            $title = get_push_notification_message('provider_new_service_request_arrived', $provider?->current_language_key);

                            if (!is_null($fcmToken) && $provider?->service_availability && $title  && sendDeviceNotificationPermission($booking?->provider_id)) {
                                $serviceAtProviderPlace = (int)((business_config('service_at_provider_place'))->value ?? 0);
                                // $serviceLocations = getProviderSettings(providerId: $provider->id, key: 'service_location', type: 'provider_config') ?? ['customer'];
                                $serviceLocations = getProviderServiceLocation($provider->id);

                                if ($serviceAtProviderPlace == 1){
                                    if (in_array($booking->service_location, $serviceLocations)){
                                        device_notification($fcmToken, $title, null, null, $booking->id, 'booking');
                                    }
                                }else{
                                    device_notification($fcmToken, $title, null, null, $booking->id, 'booking');
                                }
                            }
                        }
                    }
                }
            });
            $bookingIds[] = $booking->id;
        }

        cart_clean($oldUserId);
       $this->placeBookingNotification($booking);
       event(new BookingRequested($booking));

        if( $booking?->provider?->is_valid_subscription == 1 && $booking?->provider?->store_sub?->max_order != "unlimited" && $booking?->provider?->store_sub?->max_order > 0){
            $booking?->provider?->store_sub?->decrement('max_order' , 1);
        }

        return [
            'flag' => 'success',
            'booking_id' => $bookingIds,
            'readable_id' => $booking->id,
            'token' => $loginToken,
        ];
    }

    public function placeBookingNotification ($booking) {
        try {
            $notification= isNotificationActive(null, 'booking', 'notification', 'user');
            $repeatOrRegular = $booking?->is_repeated ? 'repeat' : 'regular';
            $title = get_push_notification_message('user_booking_place', $booking?->customer?->current_language_key);
            if (isset($booking->customer->cm_firebase_token) && $title && $notification) {
                device_notification($booking->customer->cm_firebase_token, $title, null, null, $booking->id, 'booking', '', '', '', '', $repeatOrRegular);
            }
        } catch (Exception $e) {
            info($e);
        }
    }
    public function placeRepeatBookingRequest($userId, $request, $transactionId, $newUserInfo = null, int $isGuest = 0, $moduleId = null): array
    {

        $moduleId = ModelsModule::where('module_type', 'service')->first()->id;
        $oldUserId = $userId;
        $cartData = Cart::where(['customer_id' => $userId])->get();

        if ($cartData->count() == 0) {
            return ['flag' => 'failed', 'message' => 'no data found'];
        }

        $loginToken = null;
        $bookingIds = [];

        foreach ($cartData->pluck('sub_category_id')->unique() as $subCategory) {

            $booking = new Booking();

            DB::transaction(function () use (
                $moduleId, $subCategory, $booking, $transactionId, $request, $cartData, $isGuest,
                &$userId, // Pass by reference
                &$loginToken, // Pass by reference,
                $newUserInfo)  {

                if ($newUserInfo != null){
                    $response = $this->registerUserFromCheckoutPage($newUserInfo);

                    $user = $response['user'];
                    $userId = $user->id;
                    $loginToken = $response['loginToken'];
                    $isGuest = 0;
                }

                $cartData = $cartData->where('sub_category_id', $subCategory);

                if ($request->has('payment_method') && $request['payment_method'] == 'cash_after_service') {
                    $transactionId = 'cash-payment';

                }

                $totalBookingAmount = $cartData->sum('total_cost');

                $referralDiscount = 0;
                $zoneId = config('zone_id') == null ? $request['zone_id'] : config('zone_id');
                $referralDiscount += $this->referralEarningCalculationForFirstBooking($userId, $totalBookingAmount - $cartData->sum('tax_amount'), $zoneId);
                $totalBookingAmount -= $referralDiscount;

                $bookingAdditionalChargeStatus = BusinessSetting::where('key', 'additional_charge_status')->first()->value ?? 0;
                $extraFee = 0;
                if ($bookingAdditionalChargeStatus) {
                    $extraFee = BusinessSetting::where('key', 'additional_charge')->first()->value ?? 0;
                }

                $repeatBookingSchedule = json_decode($request['dates'], true);
                $totalDate = count($repeatBookingSchedule);
                $suffixes = range('A', 'Z');

                $coupon = Coupon::where('coupon_code', $cartData->first()->coupon_code)->first();
                $repeatCount = $this->booking->where('customer_id', $userId)
                    ->where('coupon_code', $cartData->first()->coupon_code)
                    ->get()
                    ->sum(function ($booking) use ($cartData) {
                        $repeatCount = $booking->repeat()
                            ->where('coupon_code', $cartData->first()->coupon_code)
                            ->count();

                        return $repeatCount > 0 ? $repeatCount : 1;
                    });

                $totalUsedCount = $repeatCount;

                $maxCouponUsagePerUser = max(0, $coupon?->discount?->limit_per_user - $totalUsedCount);
                $totalDiscount = 0;
                if ($maxCouponUsagePerUser >= $totalDate){
                    $totalDiscount = $cartData->sum('coupon_discount') * $totalDate;
                }else{
                    $totalDiscount = $cartData->sum('coupon_discount') * $maxCouponUsagePerUser;
                }

                $serviceAddress = json_encode(CustomerAddress::find($request['service_address_id'])) ?? null;
                $location = CustomerAddress::find($request['service_address_id']);
                $latitude = $location ? $location->latitude : null;
                $longitude = $location ? $location->longitude : null;

                $nearestProvider = Provider::select(
                    'id',
                    \DB::raw("
                            (6371 * acos(
                                cos(radians($latitude))
                                * cos(radians(JSON_UNQUOTE(JSON_EXTRACT(coordinates, '$.latitude'))))
                                * cos(radians(JSON_UNQUOTE(JSON_EXTRACT(coordinates, '$.longitude'))) - radians($longitude))
                                + sin(radians($latitude))
                                * sin(radians(JSON_UNQUOTE(JSON_EXTRACT(coordinates, '$.latitude'))))
                            )) AS distance
                        ")
                )
                ->where('zone_id', $zoneId)
                ->where('is_suspended', 0)
                ->where('is_active', 1)
                ->whereHas('subscribed_services', function($query) use ($subCategory) {
                    $query->where('sub_category_id', $subCategory)
                        ->where('is_subscribed', 1);
                })
                ->orderBy('distance', 'asc')
                ->first();


                $booking->module_id = $moduleId;
                $booking->customer_id = $userId;
                $booking->provider_id = $cartData->first()->provider_id ?: $nearestProvider->id ?? null;
                $booking->category_id = $cartData->first()->category_id;
                $booking->sub_category_id = $subCategory;
                $booking->zone_id = $zoneId;
                $booking->booking_status = 'pending';
                $booking->payment_method = $request['payment_method'];
                $booking->total_booking_amount = ($totalBookingAmount * $totalDate) + $extraFee;
                $booking->total_tax_amount = $cartData->sum('tax_amount') * $totalDate;
                $booking->total_discount_amount = $cartData->sum('discount_amount') * $totalDate;
                $booking->total_campaign_discount_amount = $cartData->sum('campaign_discount') * $totalDate;
                $booking->total_coupon_discount_amount = $totalDiscount;
                $booking->extra_fee = $extraFee;
                $booking->total_referral_discount_amount = $referralDiscount;
                $booking->coupon_code = $cartData->first()->coupon_code;
                $booking->service_address_id = $request['service_address_id'] ?? '';
                $booking->is_guest = $isGuest;
                $booking->assigned_by = $cartData->first()->provider_id ? 'customer' : null;
                $booking->is_repeated = 1;
                $booking->service_location = $request->service_location;
                $booking->service_address_location = $serviceAddress;
                $booking->save();

                foreach ($cartData as $data) {
                    $detail = new BookingDetail();
                    $detail->booking_id = $booking->id;
                    $detail->service_id = $data['service_id'];
                    $detail->service_name = Service::find($data['service_id'])->name ?? 'service-not-found';
                    $detail->variant_key = $data['variant_key'];
                    $detail->quantity = $data['quantity'];
                    $detail->service_cost = $data['service_cost'];
                    $detail->discount_amount = $data['discount_amount'];
                    $detail->campaign_discount_amount = $data['campaign_discount'];
                    $detail->overall_coupon_discount_amount = $data['coupon_discount'];
                    $detail->tax_amount = $data['tax_amount'];
                    $detail->total_cost = $data['total_cost'];
                    $detail->save();
                }

                foreach ($repeatBookingSchedule as $index => $repeat) {
                    $suffix = $this->getSuffix($index);

                    $repeatBooking = new BookingRepeat();
                    $repeatBooking->readable_id = $booking->id . '-' . $suffix;
                    $repeatBooking->booking_id = $booking->id;
                    $repeatBooking->provider_id = $cartData->first()->provider_id ?: $nearestProvider->id ?? null;
                    $repeatBooking->booking_type = $request['booking_type'];
                    $repeatBooking->transaction_id = $transactionId;
                    $repeatBooking->booking_status = 'pending';
                    $repeatBooking->payment_method = $request['payment_method'];
                    $repeatBooking->service_schedule = date('Y-m-d H:i:s', strtotime($repeat['date'])) ?? now()->addHours(5);
                    $repeatBooking->total_booking_amount = $index < 1 ? $totalBookingAmount + $extraFee : $totalBookingAmount;
                    $repeatBooking->total_tax_amount = $cartData->sum('tax_amount');
                    $repeatBooking->total_discount_amount = $cartData->sum('discount_amount');
                    $repeatBooking->total_campaign_discount_amount = $cartData->sum('campaign_discount');
                    if ($index < $maxCouponUsagePerUser && $coupon) {
                        $repeatBooking->total_coupon_discount_amount = $cartData->sum('coupon_discount');
                        $repeatBooking->coupon_code = $cartData->first()['coupon_code'];
                    } else {
                        $repeatBooking->total_coupon_discount_amount = 0;
                        $repeatBooking->coupon_code = null;
                    }
                    $repeatBooking->extra_fee = $index < 1 ? $extraFee : 0;
                    $repeatBooking->total_referral_discount_amount = $index < 1 ? $referralDiscount : 0;
                    $repeatBooking->booking_otp = rand(100000, 999999);
        //                    $repeatBooking->readable_id = $booking->readable_id . '-' . $suffix;
                    $repeatBooking->service_address_location = $serviceAddress;
                    $repeatBooking->service_location = $request->service_location;
                    $repeatBooking->save();

                    $schedule = new BookingScheduleHistory();
                    $schedule->booking_id = $booking->id;
                    $schedule->booking_repeat_id = $repeatBooking->id;
                    $schedule->changed_by = $userId;
                    $schedule->user_type = 'customer';
                    $schedule->is_guest = $isGuest;
                    $schedule->schedule = date('Y-m-d H:i:s', strtotime($repeat['date'])) ?? now()->addHours(5);
                    $schedule->save();

                    foreach ($cartData as $datum) {
                        $repeatBookingDetails = new BookingRepeatDetails();
                        $repeatBookingDetails->booking_repeat_id = $repeatBooking->id;
                        $repeatBookingDetails->booking_id = $booking->id;
                        $repeatBookingDetails->service_id = $datum['service_id'];
                        $repeatBookingDetails->service_name = Service::find($datum['service_id'])->name ?? 'service-not-found';
                        $repeatBookingDetails->variant_key = $datum['variant_key'];
                        $repeatBookingDetails->quantity = $datum['quantity'];
                        $repeatBookingDetails->service_cost = $datum['service_cost'];
                        $repeatBookingDetails->discount_amount = $datum['discount_amount'];
                        $repeatBookingDetails->campaign_discount_amount = $datum['campaign_discount'];
                        if ($index <= $maxCouponUsagePerUser && $coupon) {
                            $repeatBookingDetails->overall_coupon_discount_amount = $datum['coupon_discount'];
                        } else {
                            $repeatBookingDetails->overall_coupon_discount_amount = 0;
                        }
                        $repeatBookingDetails->tax_amount = $datum['tax_amount'];
                        $repeatBookingDetails->total_cost = $datum['total_cost'];
                        $repeatBookingDetails->save();

                        $bookingDetailsAmount = new BookingDetailsAmount();
                        $bookingDetailsAmount->booking_details_id = 0;
                        $bookingDetailsAmount->booking_repeat_details_id = $repeatBookingDetails->id;
                        $bookingDetailsAmount->booking_id = $booking->id;
                        $bookingDetailsAmount->booking_repeat_id = $repeatBooking->id;
                        $bookingDetailsAmount->service_unit_cost = $datum['service_cost'];
                        $bookingDetailsAmount->service_quantity = $datum['quantity'];
                        $bookingDetailsAmount->service_tax = $datum['tax_amount'];
                        $bookingDetailsAmount->discount_by_admin = $this->calculate_discount_cost($datum['discount_amount'])['admin'];
                        $bookingDetailsAmount->discount_by_provider = $this->calculate_discount_cost($datum['discount_amount'])['provider'];
                        $bookingDetailsAmount->campaign_discount_by_admin = $this->calculate_campaign_cost($datum['campaign_discount'])['admin'];
                        $bookingDetailsAmount->campaign_discount_by_provider = $this->calculate_campaign_cost($datum['campaign_discount'])['provider'];
                        if ($index <= $maxCouponUsagePerUser && $coupon) {
                            $bookingDetailsAmount->coupon_discount_by_admin = $this->calculate_coupon_cost($datum['coupon_discount'])['admin'];
                            $bookingDetailsAmount->coupon_discount_by_provider = $this->calculate_coupon_cost($datum['coupon_discount'])['provider'];
                        }else{
                            $bookingDetailsAmount->coupon_discount_by_admin = 0;
                            $bookingDetailsAmount->coupon_discount_by_provider = 0;
                        }
                        $bookingDetailsAmount->save();
                    }
                }

            //     firebaseTopic
               $bookingNotification = (int) (business_config('booking_notification'))?->value;
               $bookingNotificationType = (int) (business_config('booking_notification_type'))?->value;
               if ($bookingNotification && $bookingNotificationType == 'firebase') {
                   try {
                       $serviceAtProviderPlace = (int)(business_config('service_at_provider_place')->value ?? 0);
                       $serviceLocation = $booking->service_location;
                       $zoneId = $booking->zone_id;

                       if (isset($booking->provider_id)){
                           $topic = "demandium_provider_{$zoneId}_{$booking->provider_id}_booking_message";
                       }else {
                           if ($serviceAtProviderPlace) {
                               if ($serviceLocation === 'provider') {
                                   $topic = "demandium_provider_{$zoneId}_provider_booking_message";
                               }
                               if ($serviceLocation === 'customer') {
                                   $topic = "demandium_provider_{$zoneId}_customer_booking_message";
                               }
                           } else {
                               $topic = "demandium_provider_{$zoneId}_booking_message";
                           }
                       }

                       topic_notification($topic, 'new booking', '', 'def.png', null);
                   } catch (Exception $e) {
                   }
               }


               $maximumBookingAmount = (business_config('provider_maximum_booking_amount'))?->value;

               if ($booking->payment_method == 'cash_after_service') {
                   if ($maximumBookingAmount > 0 && $booking->total_booking_amount < $maximumBookingAmount) {
                       if (isset($booking->provider_id) && $booking->booking_status != 'pending') {
                           $provider = Provider::whereId($booking->provider_id)->first();
                           $fcmToken = $provider?->fcm_token ?? null;
                           $repeatOrRegular = $booking?->is_repeated ? 'repeat' : 'regular';
                           $languageKey = $provider?->current_language_key;
                           if (!is_null($fcmToken)) {
                               $notification = isNotificationActive($provider?->id, 'booking', 'notification', 'provider');
                               $title = get_push_notification_message('provider_booking_accepted', $languageKey);
                               if ($title && sendDeviceNotificationPermission($booking?->provider_id) && $notification) {
                                       device_notification($fcmToken, $title, null, null, $booking->id, 'booking', null, null, null, null, $repeatOrRegular);
                               }
                           }
                       } else {
                           $providerIds = SubscribedService::where('sub_category_id', $subCategory)->ofSubscription(1)->pluck('provider_id')->toArray();
                           if (business_config('provider_suspend_on_exceed_cash_limit')->value) {
                               $providers = Provider::whereIn('id', $providerIds)->where('zone_id', $booking?->zone_id)->where('is_suspended', 0)->get();
                           } else {
                               $providers = Provider::whereIn('id', $providerIds)->where('zone_id', $booking?->zone_id)->get();
                           }

                           foreach ($providers as $provider) {
                               $fcmToken = $provider->fcm_token ?? null;
                               $repeatOrRegular = $booking?->is_repeated ? 'repeat' : 'regular';
                               $notification = isNotificationActive($provider?->id, 'booking', 'notification', 'provider');
                               $title = get_push_notification_message('provider_new_service_request_arrived', optional($provider)->current_language_key);

                               if (!is_null($fcmToken) && $provider->service_availability && $title && $notification  && sendDeviceNotificationPermission($provider->id)) {
                                   device_notification($fcmToken, $title, null, null, $booking->id, 'booking', null, null, null, null, $repeatOrRegular);
                               }
                           }

                       }
                   }
               }
            });
            $bookingIds[] = $booking->id;
        }

        cart_clean($oldUserId);
       $this->placeBookingNotification($booking);
       event(new BookingRequested($booking));

        return [
            'flag' => 'success',
            'booking_id' => $bookingIds,
            'readable_id' => $booking->readable_id,
            'token' => $loginToken,
        ];
    }

    function getSuffix($index): string
    {
        $suffixes = range('A', 'Z');
        $base = count($suffixes);
        $result = '';
        do {
            $result = $suffixes[$index % $base] . $result;
            $index = floor($index / $base) - 1;
        } while ($index >= 0);
        return $result;
    }

    /**
     * @param $customerUserId
     * @param $request
     * @param $transactionId
     * @param $data
     * @return array
     */

    protected function placeBookingRequestForBidding($customerUserId, $request, $transactionId, $data, $moduleId = null): array
    {
        $booking = new Booking();

        DB::transaction(function () use ($booking, $transactionId, $request, $customerUserId, $data, $moduleId) {

            if ($request->has('payment_method') && $request['payment_method'] == 'cash_after_service') {
                $transactionId = 'cash-payment';

            } else if ($request->has('payment_method') && $request['payment_method'] == 'wallet_payment') {
                $transactionId = 'wallet-payment';
            }

            $totalBookingAmount = $data['price'];

            $referralDiscount = 0;
            $zoneId = $data['zone_id'];
            $referralDiscount += $this->referralEarningCalculationForFirstBooking($customerUserId, $totalBookingAmount, $zoneId);
            $totalBookingAmount -= $referralDiscount;

            $tax = !is_null($data['service_tax']) ? round((($data['price'] * $data['service_tax']) / 100) * 1, 2) : 0; //

            $totalBookingAmount += $tax;
            $isPartials = $data['is_partial'] ? 1 : 0;
            $customerWalletBalance = User::find($customerUserId)?->wallet_balance;
            if ($isPartials && ($customerWalletBalance <= 0 || $customerWalletBalance >= $totalBookingAmount)) {
                return ['flag' => 'failed', 'message' => 'Invalid data'];
            }

            $bookingAdditionalChargeStatus = BusinessSetting::where('key', 'additional_charge_status')->first()->value ?? 0;
            $extraFee = 0;
            if ($bookingAdditionalChargeStatus) {
                $extraFee = BusinessSetting::where('key', 'additional_charge')->first()->value ?? 0;
            }

            $totalBookingAmount += $extraFee;

            $booking->module_id = $moduleId;
            $booking->customer_id = $customerUserId;
            $booking->provider_id = $data['provider_id'];
            $booking->category_id = $data['category_id'];
            $booking->sub_category_id = $data['sub_category_id'];
            $booking->zone_id = $data['zone_id'];
            $booking->post_id = $data['post_id'] ?? null;
            $booking->booking_status = 'accepted';
            $booking->is_paid = $data['payment_method'] == 'cash_after_service' || $request['payment_method'] == 'offline_payment' ? 0 : 1;;
            $booking->payment_method = $data['payment_method'];
            $booking->transaction_id = $transactionId;
            $booking->total_booking_amount = $totalBookingAmount;
            $booking->total_tax_amount = $tax;
            $booking->total_discount_amount = 0;
            $booking->total_campaign_discount_amount = 0;
            $booking->total_coupon_discount_amount = 0;
            $booking->service_schedule = date('Y-m-d H:i:s', strtotime($data['service_schedule'])) ?? now()->addHours(5);
            $booking->service_address_id = $data['service_address_id'] ?? '';
            $booking->booking_otp = rand(100000, 999999);
            $booking->is_guest = 0;
            $booking->extra_fee = $extraFee;
            $booking->total_referral_discount_amount = $referralDiscount;
            $booking->save();

            if ($isPartials) {
                $paidAmount = $customerWalletBalance;
                $due_amount = $totalBookingAmount - $paidAmount;

                $bookingPartialPayment = new BookingPartialPayment;
                $bookingPartialPayment->booking_id = $booking->id;
                $bookingPartialPayment->paid_with = 'wallet';
                $bookingPartialPayment->paid_amount = $paidAmount;
                $bookingPartialPayment->due_amount = $due_amount;
                $bookingPartialPayment->save();

                if ($request['payment_method'] != 'cash_after_service') {
                    $bookingPartialPayment = new BookingPartialPayment;
                    $bookingPartialPayment->booking_id = $booking->id;
                    $bookingPartialPayment->paid_with = 'digital';
                    $bookingPartialPayment->paid_amount = $due_amount;
                    $bookingPartialPayment->due_amount = 0;
                    $bookingPartialPayment->save();
                }
            }

            $detail = new BookingDetail();
            $detail->booking_id = $booking->id;
            $detail->service_id = $data['service_id'];
            $detail->service_name = Service::find($data['service_id'])->name ?? 'service-not-found';
            $detail->variant_key = null;
            $detail->quantity = 1;
            $detail->service_cost = $data['price'];
            $detail->discount_amount = 0;
            $detail->campaign_discount_amount = 0;
            $detail->overall_coupon_discount_amount = 0;
            $detail->tax_amount = $tax;
            $detail->total_cost = $totalBookingAmount;
            $detail->save();

            $bookingDetailsAmount = new BookingDetailsAmount();
            $bookingDetailsAmount->booking_details_id = $detail->id;
            $bookingDetailsAmount->booking_id = $booking->id;
            $bookingDetailsAmount->service_unit_cost = $data['price'];
            $bookingDetailsAmount->service_quantity = 1;
            $bookingDetailsAmount->service_tax = $tax;
            $bookingDetailsAmount->discount_by_admin = 0;
            $bookingDetailsAmount->discount_by_provider = 0;
            $bookingDetailsAmount->campaign_discount_by_admin = 0;
            $bookingDetailsAmount->campaign_discount_by_provider = 0;
            $bookingDetailsAmount->coupon_discount_by_admin = 0;
            $bookingDetailsAmount->coupon_discount_by_provider = 0;
            $bookingDetailsAmount->admin_commission = 0;
            $bookingDetailsAmount->save();

            $schedule = new BookingScheduleHistory();
            $schedule->booking_id = $booking->id;
            $schedule->changed_by = $customerUserId;
            $schedule->schedule = date('Y-m-d H:i:s', strtotime($data['service_schedule'])) ?? now()->addHours(5);
            $schedule->user_type = 'customer';
            $schedule->save();

            $statusHistory = new BookingStatusHistory();
            $statusHistory->changed_by = $customerUserId;
            $statusHistory->user_type = 'customer';
            $statusHistory->booking_id = $booking->id;
            $statusHistory->booking_status = isset($booking->provider_id) ? 'accepted' : 'pending';
            $statusHistory->save();

            if ($booking->booking_partial_payments->isNotEmpty()) {
                if ($booking['payment_method'] == 'cash_after_service') {
                    placeBookingTransactionForPartialCas($booking);  // waller + CAS payment
                } elseif ($booking['payment_method'] != 'wallet_payment') {
                    placeBookingTransactionForPartialDigital($booking);  //wallet + digital payment
                }
            } elseif ($booking['payment_method'] != 'cash_after_service' && $booking['payment_method'] != 'wallet_payment') {
                placeBookingTransactionForDigitalPayment($booking);  //digital payment
            } elseif ($booking['payment_method'] != 'cash_after_service') {
                placeBookingTransactionForWalletPayment($booking);   //wallet payment
            }

            $provider = Provider::whereId($booking->provider_id)->first();
            $languageKey = $provider?->current_language_key;
            $maxBookingAmount = (business_config('provider_maximum_booking_amount'))->value;
            if ($booking->payment_method != 'cash_after_service' || ($booking->payment_method == 'cash_after_service' && $booking->total_booking_amount < $maxBookingAmount)){
                if (!is_null($provider?->fcm_token) && $provider?->is_suspended == 0) {
                    $title = get_push_notification_message('provider_booking_accepted', $languageKey);

                    if ($title ) {
                        device_notification($provider->fcm_token, $title, null, null, $booking->id, 'booking');
                    }
                }
            }
        });

        return [
            'flag' => 'success',
            'booking_id' => $booking->id,
            'readable_id' => $booking->id,
        ];
    }


    //=============== EDIT BOOKING ===============

    /**
     * @param $request
     * @return void
     */
    protected function addNewBookingService($request): void
    {
        DB::transaction(function () use ($request) {
            $service = Service::with('variations')->find($request['service_id']);
            $variation = $service->variations->where('variant_key', $request['variant_key'])->where('zone_id', $request['zone_id'])->first();
            $quantity = $request['quantity'];
            $booking = Booking::with(['detail', 'details_amounts'])->find($request['booking_id']);

            if ($booking->total_coupon_discount_amount > 0) {
                self::remove_coupon_from_booking($booking, $service);
            }


            $basicDiscount = basic_discount_calculation($service, $variation->price * $quantity);
            $campaignDiscount = campaign_discount_calculation($service, $variation->price * $quantity);
            $subtotal = round($variation->price * $quantity, 2);

            $applicableDiscount = ($campaignDiscount >= $basicDiscount) ? $campaignDiscount : $basicDiscount;
            $tax = round(((($variation->price * $quantity - $applicableDiscount) * $service['tax']) / 100), 2);

            $basicDiscount = $basicDiscount > $campaignDiscount ? $basicDiscount : 0;
            $campaignDiscount = $campaignDiscount >= $basicDiscount ? $campaignDiscount : 0;

            $newTotal = round($subtotal - $basicDiscount - $campaignDiscount + $tax, 2);

            $booking = Booking::find($request['booking_id']);
            $booking->total_booking_amount += $newTotal;
            $booking->total_tax_amount += $tax;
            $booking->total_discount_amount += $basicDiscount;
            $booking->total_campaign_discount_amount += $campaignDiscount;

            $booking->additional_charge += $newTotal;
            $booking->additional_tax_amount += $tax;
            $booking->additional_discount_amount += $basicDiscount;
            $booking->additional_campaign_discount_amount += $campaignDiscount;
            $booking->save();

            $detail = BookingDetail::where('booking_id', $booking->id)->where('variant_key', $request['variant_key'])->first();
            if (!$detail) $detail = new BookingDetail();
            $detail->booking_id = $booking->id;
            $detail->service_id = $request['service_id'];
            $detail->service_name = $service->name ?? 'service-not-found';
            $detail->variant_key = $request['variant_key'];
            $detail->quantity += $quantity;
            $detail->service_cost += $variation->price;
            $detail->discount_amount += $basicDiscount;
            $detail->campaign_discount_amount += $campaignDiscount;
            $detail->overall_coupon_discount_amount = 0;
            $detail->tax_amount += round($tax, 2);
            $detail->total_cost += $newTotal;
            $detail->save();

            $bookingDetailsAmount = BookingDetailsAmount::where('booking_id', $booking->id)->where('booking_details_id', $detail->id)->first();
            if (!$bookingDetailsAmount) $bookingDetailsAmount = new BookingDetailsAmount();
            $bookingDetailsAmount->booking_details_id = $detail->id;
            $bookingDetailsAmount->booking_id = $booking->id;
            $bookingDetailsAmount->service_unit_cost += $detail['service_cost'];
            $bookingDetailsAmount->service_quantity += $quantity;
            $bookingDetailsAmount->service_tax += $detail['tax_amount'];
            $bookingDetailsAmount->discount_by_admin += $this->calculate_discount_cost($detail['discount_amount'])['admin'];
            $bookingDetailsAmount->discount_by_provider += $this->calculate_discount_cost($detail['discount_amount'])['provider'];
            $bookingDetailsAmount->campaign_discount_by_admin += $this->calculate_campaign_cost($detail['campaign_discount_amount'])['admin'];
            $bookingDetailsAmount->campaign_discount_by_provider += $this->calculate_campaign_cost($detail['campaign_discount_amount'])['provider'];
            $bookingDetailsAmount->coupon_discount_by_admin += $this->calculate_coupon_cost($detail['overall_coupon_discount_amount'])['admin'];
            $bookingDetailsAmount->coupon_discount_by_provider += $this->calculate_coupon_cost($detail['overall_coupon_discount_amount'])['provider'];
            $bookingDetailsAmount->save();

           $serviceAdd = isNotificationActive(null, 'booking', 'notification', 'user');
           $providerNotification = isNotificationActive(null, 'booking', 'notification', 'provider');
           $servicemanNotification = isNotificationActive(null, 'booking', 'notification', 'serviceman');
           if ($serviceAdd) {
               $notifications[] = [
                   'key' => 'user_booking_edit_service_add',
                   'settings_type' => 'customer_notification'
               ];
           }
           if ($providerNotification) {
               $notifications[] = [
                   'key' => 'provider_booking_edit_service_add',
                   'settings_type' => 'provider_notification'
               ];
           }
           if ($servicemanNotification) {
               $notifications[] = [
                   'key' => 'serviceman_booking_edit_service_add',
                   'settings_type' => 'serviceman_notification'
               ];
           }

            foreach ($notifications ?? [] as $notification) {
                $key = $notification['key'];
                $settingsType = $notification['settings_type'];

                if ($settingsType == 'customer_notification') {
                    $user = $booking?->customer;
                    $title = get_push_notification_message($key, $user?->current_language_key);
                    if ($user?->cm_firebase_token && $title) {
                        device_notification($user?->cm_firebase_token, $title, null, null, $booking->id, 'booking');
                    }
                }

                if ($settingsType == 'provider_notification') {
                    $provider = $booking?->provider;
                    $title = get_push_notification_message($key, $provider?->current_language_key);
                    if ($provider?->fcm_token && $title) {
                        device_notification($provider?->fcm_token, $title, null, null, $booking->id, 'booking');
                    }
                }

                if ($settingsType == 'serviceman_notification') {
                    $serviceman = $booking?->serviceman;
                    $title = get_push_notification_message($key, $serviceman?->current_language_key);
                    if ($serviceman?->fcm_token && $title) {
                        device_notification($serviceman?->fcm_token, $title, null, null, $booking->id, 'booking');
                    }
                }
            }

        });
    }

    protected function increase_service_quantity_from_booking($request): void
    {
        if (!$request->has('booking_id', 'service_id', 'variant_key', 'zone_id')) return;

        DB::transaction(function () use ($request) {
            $bookingDetails = BookingDetail::whereHas('booking', fn($query) => $query->where('id', $request['booking_id']))->where('variant_key', $request['variant_key'])->first();
            $service = Service::with('variations')->find($request['service_id']);
            $variation = $service->variations->where('variant_key', $request['variant_key'])->where('zone_id', $request['zone_id'])->first();
            $booking = Booking::with(['detail', 'details_amounts'])->find($request['booking_id']);
            $oldQuantity = $request['old_quantity'];
            $newQuantity = $request['new_quantity'];
            $toAddQuantity = abs($request['old_quantity'] - $request['new_quantity']);

            if ($booking->total_coupon_discount_amount > 0) {
                self::remove_coupon_from_booking($booking, $service);
            }

            $basicDiscount = basic_discount_calculation($service, $variation->price * $newQuantity) - basic_discount_calculation($service, $variation->price * $oldQuantity);
            $campaignDiscount = campaign_discount_calculation($service, $variation->price * $newQuantity) - campaign_discount_calculation($service, $variation->price * $oldQuantity);
            $subtotal = round($variation->price * $toAddQuantity, 2);

            $applicableDiscount = max($campaignDiscount, $basicDiscount);
            $tax = round(((($variation->price * $toAddQuantity - $applicableDiscount) * $service['tax']) / 100), 2);

            $basicDiscount = $basicDiscount > $campaignDiscount ? $basicDiscount : 0;
            $campaignDiscount = $campaignDiscount >= $basicDiscount ? $campaignDiscount : 0;

            $subTotal = round($subtotal - $basicDiscount - $campaignDiscount + $tax, 2);

            $additional_total = $booking->total_booking_amount - $subTotal;

            $booking = Booking::find($request['booking_id']);
            $booking->additional_charge += $subTotal;
            $booking->additional_tax_amount += $tax;
            $booking->additional_discount_amount += $basicDiscount;
            $booking->additional_campaign_discount_amount += $campaignDiscount;
            $booking->total_booking_amount += $subTotal;
            $booking->total_tax_amount += $tax;
            $booking->total_discount_amount += $basicDiscount;
            $booking->total_campaign_discount_amount += $campaignDiscount;
            $booking->save();


            $basicDiscount = basic_discount_calculation($service, $variation->price * $newQuantity);
            $campaignDiscount = campaign_discount_calculation($service, $variation->price * $newQuantity);
            $subtotal = round($variation->price * $newQuantity, 2);

            $applicableDiscount = ($campaignDiscount >= $basicDiscount) ? $campaignDiscount : $basicDiscount;
            $tax = round(((($variation->price * $newQuantity - $applicableDiscount) * $service['tax']) / 100), 2);

            $basicDiscount = $basicDiscount > $campaignDiscount ? $basicDiscount : 0;
            $campaignDiscount = $campaignDiscount >= $basicDiscount ? $campaignDiscount : 0;


            $subTotal = round($subtotal - $basicDiscount - $campaignDiscount + $tax, 2);

            $bookingDetails->quantity = $newQuantity;
            $bookingDetails->tax_amount = $tax;
            $bookingDetails->total_cost = $subTotal;
            $bookingDetails->discount_amount = $basicDiscount;
            $bookingDetails->campaign_discount_amount = $campaignDiscount;
            $bookingDetails->discount_amount = 0;
            $bookingDetails->save();

            $bookingDetailsAmount = BookingDetailsAmount::where('booking_id', $request['booking_id'])->where('booking_details_id', $bookingDetails->id)->first();
            $bookingDetailsAmount->service_quantity = $newQuantity;
            $bookingDetailsAmount->service_tax = $tax;
            $bookingDetailsAmount->coupon_discount_by_admin = 0;
            $bookingDetailsAmount->coupon_discount_by_provider = 0;
            $bookingDetailsAmount->discount_by_admin = $this->calculate_discount_cost($bookingDetails->discount_amount)['admin'];
            $bookingDetailsAmount->discount_by_provider = $this->calculate_discount_cost($bookingDetails->discount_amount)['provider'];
            $bookingDetailsAmount->campaign_discount_by_admin = $this->calculate_campaign_cost($bookingDetails->campaign_discount_amount)['admin'];
            $bookingDetailsAmount->campaign_discount_by_provider = $this->calculate_campaign_cost($bookingDetails->campaign_discount_amount)['provider'];
            $bookingDetailsAmount->save();

            $serviceQty = isNotificationActive(null, 'booking', 'notification', 'user');
            $providerQtyNotification = isNotificationActive(null, 'booking', 'notification', 'provider');
            $servicemanQtyNotification = isNotificationActive(null, 'booking', 'notification', 'serviceman');
            if ($serviceQty) {
                $notifications[] =
                    [
                        'key' => 'user_booking_edit_service_quantity_increase',
                        'settings_type' => 'customer_notification'
                    ];
            }
            if ($providerQtyNotification) {
                $notifications[] = [
                    'key' => 'provider_booking_edit_service_quantity_increase',
                    'settings_type' => 'provider_notification'
                ];
            }
            if ($servicemanQtyNotification) {
                $notifications[] = [
                    'key' => 'serviceman_booking_edit_service_quantity_increase',
                    'settings_type' => 'serviceman_notification'
                ];
            }

            foreach ($notifications ?? [] as $notification) {
                $key = $notification['key'];
                $settingsType = $notification['settings_type'];

                if ($settingsType == 'customer_notification') {
                    $user = $booking?->customer;
                    $title = get_push_notification_message($key, $user?->current_language_key);
                    if ($user?->cm_firebase_token && $title) {
                        device_notification($user?->cm_firebase_token, $title, null, null, $booking->id, 'booking');
                    }
                }

                if ($settingsType == 'provider_notification') {
                    $provider = $booking?->provider;
                    $title = get_push_notification_message($key, $provider?->current_language_key);
                    if ($provider?->fcm_token && $title) {
                        device_notification($provider?->fcm_token, $title, null, null, $booking->id, 'booking');
                    }
                }

                if ($settingsType == 'serviceman_notification') {
                    $serviceman = $booking?->serviceman;
                    $title = get_push_notification_message($key, $serviceman?->current_language_key);
                    if ($serviceman?->fcm_token && $title) {
                        device_notification($serviceman?->fcm_token, $title, null, null, $booking->id, 'booking');
                    }
                }
            }
        });
    }

    protected function increase_service_quantity_from_booking_repeat($request): void
    {
        if (!$request->has('booking_repeat_id', 'service_id', 'variant_key', 'zone_id')) return;
        DB::transaction(function () use ($request) {
            $bookingDetails = BookingRepeatDetails::whereHas('repeat', fn($query) => $query->where('id', $request['booking_repeat_id']))->where('variant_key', $request['variant_key'])->first();
            $service = Service::with('variations')->find($request['service_id']);
            $variation = $service->variations->where('variant_key', $request['variant_key'])->where('zone_id', $request['zone_id'])->first();
            $booking = BookingRepeat::with(['detail', 'details_amounts'])->find($request['booking_repeat_id']);

            $oldQuantity = $request['old_quantity'];
            $newQuantity = $request['new_quantity'];
            $toAddQuantity = abs($request['old_quantity'] - $request['new_quantity']);

            if ($booking->total_coupon_discount_amount > 0) {
                self::remove_coupon_from_booking($booking, $service);
            }

            $basicDiscount = basic_discount_calculation($service, $variation->price * $newQuantity) - basic_discount_calculation($service, $variation->price * $oldQuantity);
            $campaignDiscount = campaign_discount_calculation($service, $variation->price * $newQuantity) - campaign_discount_calculation($service, $variation->price * $oldQuantity);
            $subtotal = round($variation->price * $toAddQuantity, 2);

            $applicableDiscount = max($campaignDiscount, $basicDiscount);
            $tax = round(((($variation->price * $toAddQuantity - $applicableDiscount) * $service['tax']) / 100), 2);

            $basicDiscount = $basicDiscount > $campaignDiscount ? $basicDiscount : 0;
            $campaignDiscount = $campaignDiscount >= $basicDiscount ? $campaignDiscount : 0;

            $subTotal = round($subtotal - $basicDiscount - $campaignDiscount + $tax, 2);

            $additional_total = $booking->total_booking_amount - $subTotal;

            $booking = BookingRepeat::find($request['booking_repeat_id']);
            $booking->additional_charge += $subTotal;
            $booking->additional_tax_amount += $tax;
            $booking->additional_discount_amount += $basicDiscount;
            $booking->additional_campaign_discount_amount += $campaignDiscount;
            $booking->total_booking_amount += $subTotal;
            $booking->total_tax_amount += $tax;
            $booking->total_discount_amount += $basicDiscount;
            $booking->total_campaign_discount_amount += $campaignDiscount;
            $booking->save();


            $basicDiscount = basic_discount_calculation($service, $variation->price * $newQuantity);
            $campaignDiscount = campaign_discount_calculation($service, $variation->price * $newQuantity);
            $subtotal = round($variation->price * $newQuantity, 2);

            $applicableDiscount = ($campaignDiscount >= $basicDiscount) ? $campaignDiscount : $basicDiscount;
            $tax = round(((($variation->price * $newQuantity - $applicableDiscount) * $service['tax']) / 100), 2);

            $basicDiscount = $basicDiscount > $campaignDiscount ? $basicDiscount : 0;
            $campaignDiscount = $campaignDiscount >= $basicDiscount ? $campaignDiscount : 0;


            $subTotal = round($subtotal - $basicDiscount - $campaignDiscount + $tax, 2);

            $bookingDetails->quantity = $newQuantity;
            $bookingDetails->tax_amount = $tax;
            $bookingDetails->total_cost = $subTotal;
            $bookingDetails->discount_amount = $basicDiscount;
            $bookingDetails->campaign_discount_amount = $campaignDiscount;
            $bookingDetails->overall_coupon_discount_amount = 0;
            $bookingDetails->save();

            $bookingDetailsAmount = BookingDetailsAmount::where('booking_repeat_id', $booking->id)->where('booking_repeat_details_id', $bookingDetails->id)->first();
            $bookingDetailsAmount->service_quantity = $newQuantity;
            $bookingDetailsAmount->service_tax = $tax;
            $bookingDetailsAmount->coupon_discount_by_admin = 0;
            $bookingDetailsAmount->coupon_discount_by_provider = 0;
            $bookingDetailsAmount->discount_by_admin = $this->calculate_discount_cost($bookingDetails->discount_amount)['admin'];
            $bookingDetailsAmount->discount_by_provider = $this->calculate_discount_cost($bookingDetails->discount_amount)['provider'];
            $bookingDetailsAmount->campaign_discount_by_admin = $this->calculate_campaign_cost($bookingDetails->campaign_discount_amount)['admin'];
            $bookingDetailsAmount->campaign_discount_by_provider = $this->calculate_campaign_cost($bookingDetails->campaign_discount_amount)['provider'];
            $bookingDetailsAmount->save();

            $serviceQty = isNotificationActive(null, 'booking', 'notification', 'user');
            $providerQtyNotification = isNotificationActive(null, 'booking', 'notification', 'provider');
            $servicemanQtyNotification = isNotificationActive(null, 'booking', 'notification', 'serviceman');
            if ($serviceQty) {
                $notifications[] =
                    [
                        'key' => 'user_booking_edit_service_quantity_increase',
                        'settings_type' => 'customer_notification'
                    ];
            }
            if ($providerQtyNotification) {
                $notifications[] = [
                    'key' => 'provider_booking_edit_service_quantity_increase',
                    'settings_type' => 'provider_notification'
                ];
            }
            if ($servicemanQtyNotification) {
                $notifications[] = [
                    'key' => 'serviceman_booking_edit_service_quantity_increase',
                    'settings_type' => 'serviceman_notification'
                ];
            }


            foreach ($notifications ?? [] as $notification) {
                $key = $notification['key'];
                $settingsType = $notification['settings_type'];

                if ($settingsType == 'customer_notification') {
                    $user = $booking?->booking?->customer;
                    $title = get_push_notification_message($key, $user?->current_language_key);
                    if ($user?->cm_firebase_token && $title) {
                        device_notification($user?->cm_firebase_token, $title, null, null, $booking->booking_id, 'booking', null, null, null, null, 'repeat');
                    }
                }

                if ($settingsType == 'provider_notification') {
                    $provider = $booking?->provider;
                    $title = get_push_notification_message($key, $provider?->current_language_key);
                    if ($provider?->fcm_token && $title) {
                        device_notification($provider?->fcm_token, $title, null, null, $booking->booking_id, 'booking', null, null, null, null, 'repeat');
                    }
                }

                if ($settingsType == 'serviceman_notification') {
                    $serviceman = $booking?->serviceman;
                    $title = get_push_notification_message($key, $serviceman?->current_language_key);
                    if ($serviceman?->fcm_token && $title) {
                        device_notification($serviceman?->fcm_token, $title, null, null, $booking->id, 'booking', null, null, null, null, 'repeat', 'single');
                    }
                }
            }
        });
    }

    protected function remove_service_from_booking($request): void
    {
        if (!$request->has('booking_id', 'service_id', 'variant_key', 'zone_id')) return;

        DB::transaction(function () use ($request) {
            $bookingDetails = BookingDetail::whereHas('booking', fn($query) => $query->where('id', $request['booking_id']))->where('variant_key', $request['variant_key'])->first();
            $service = Service::with('variations')->find($request['service_id']);
            $variation = $service->variations->where('variant_key', $request['variant_key'])->where('zone_id', $request['zone_id'])->first();
            $quantity = $bookingDetails['quantity'];
            $booking = Booking::with(['detail', 'details_amounts'])->find($request['booking_id']);

            if ($booking->total_coupon_discount_amount > 0) {
                self::remove_coupon_from_booking($booking, $service);
            }

            $basicDiscount = basic_discount_calculation($service, $variation->price * $quantity);
            $campaignDiscount = campaign_discount_calculation($service, $variation->price * $quantity);
            $subtotal = round($variation->price * $quantity, 2);

            $applicableDiscount = ($campaignDiscount >= $basicDiscount) ? $campaignDiscount : $basicDiscount;
            $tax = round(((($variation->price * $quantity - $applicableDiscount) * $service['tax']) / 100), 2);

            $basicDiscount = $basicDiscount > $campaignDiscount ? $basicDiscount : 0;
            $campaignDiscount = $campaignDiscount >= $basicDiscount ? $campaignDiscount : 0;

            $removedTotal = round($subtotal - $basicDiscount - $campaignDiscount + $tax, 2);

            $refundAmount = 0;
            if ((($booking->payment_method != 'cash_after_service' && $booking->payment_method != 'offline_payment') || ($booking->payment_method == 'offline_payment' && $booking->is_paid)) && $booking->additional_charge == 0) {
                $refundAmount = $removedTotal;
            }

            $booking = Booking::find($request['booking_id']);
            $booking->total_booking_amount -= $removedTotal;
            $booking->total_tax_amount -= $tax;
            $booking->total_discount_amount -= $basicDiscount;
            $booking->total_campaign_discount_amount -= $campaignDiscount;

            $booking->additional_charge -= $removedTotal;
            $booking->additional_tax_amount -= $tax;
            $booking->additional_discount_amount -= $basicDiscount;
            $booking->additional_campaign_discount_amount -= $campaignDiscount;
            $booking->save();

            BookingDetailsAmount::where('booking_id', $request['booking_id'])->where('booking_details_id', $bookingDetails->id)->delete();

            $bookingDetails->delete();

            if ($refundAmount > 0) {
                removeBookingServiceTransactionForDigitalPayment($booking, $refundAmount);
            }
            $serviceDelete = isNotificationActive(null, 'booking', 'notification', 'user');
            $providerNotificationDelete = isNotificationActive(null, 'booking', 'notification', 'provider');
            $servicemanNotificationDelete = isNotificationActive(null, 'booking', 'notification', 'serviceman');
            if ($serviceDelete) {
                $notifications[] = [
                    'key' => 'user_booking_edit_service_remove',
                    'settings_type' => 'customer_notification'
                ];
            }
            if ($providerNotificationDelete) {
                $notifications[] = [
                    'key' => 'provider_booking_edit_service_remove',
                    'settings_type' => 'provider_notification'
                ];
            }
            if ($servicemanNotificationDelete) {
                $notifications[] = [
                    'key' => 'serviceman_booking_edit_service_remove',
                    'settings_type' => 'serviceman_notification'
                ];
            }

            foreach ($notifications ?? [] as $notification) {
                $key = $notification['key'];
                $settingsType = $notification['settings_type'];

                if ($settingsType == 'customer_notification') {
                    $user = $booking?->customer;
                    $title = get_push_notification_message($key, $user?->current_language_key);
                    if ($user?->cm_firebase_token && $title) {
                        device_notification($user?->cm_firebase_token, $title, null, null, $booking->id, 'booking');
                    }
                }

                if ($settingsType == 'provider_notification') {
                    $provider = $booking?->provider;
                    $title = get_push_notification_message($key, $provider?->current_language_key);
                    if ($provider?->fcm_token && $title) {
                        device_notification($provider?->fcm_token, $title, null, null, $booking->id, 'booking');
                    }
                }

                if ($settingsType == 'serviceman_notification') {
                    $serviceman = $booking?->serviceman;
                    $title = get_push_notification_message($key, $serviceman?->current_language_key);
                    if ($serviceman?->fcm_token && $title) {
                        device_notification($serviceman?->fcm_token, $title, null, null, $booking->id, 'booking');
                    }
                }
            }

        });
    }

    protected function decrease_service_quantity_from_booking($request): void
    {
        if (!$request->has('booking_id', 'service_id', 'variant_key', 'zone_id')) return;

        DB::transaction(function () use ($request) {
            $bookingDetails = BookingDetail::whereHas('booking', fn($query) => $query->where('id', $request['booking_id']))->where('variant_key', $request['variant_key'])->first();
            $service = Service::with('variations')->find($request['service_id']);
            $variation = $service->variations->where('variant_key', $request['variant_key'])->where('zone_id', $request['zone_id'])->first();
            $booking = Booking::with(['detail', 'details_amounts'])->find($request['booking_id']);

            $oldQuantity = $request['old_quantity'];
            $newQuantity = $request['new_quantity'];
            $quantity_to_remove = $request['old_quantity'] - $request['new_quantity'];

            if ($booking->total_coupon_discount_amount > 0) {
                self::remove_coupon_from_booking($booking, $service);
            }

            $basicDiscount = basic_discount_calculation($service, $variation->price * $oldQuantity) - basic_discount_calculation($service, $variation->price * $newQuantity);
            $campaignDiscount = campaign_discount_calculation($service, $variation->price * $oldQuantity) - campaign_discount_calculation($service, $variation->price * $newQuantity);
            $subtotal = round($variation->price * $quantity_to_remove, 2);

            $applicableDiscount = max($campaignDiscount, $basicDiscount);
            $tax = round(((($variation->price * $quantity_to_remove - $applicableDiscount) * $service['tax']) / 100), 2);

            $basicDiscount = $basicDiscount > $campaignDiscount ? $basicDiscount : 0;
            $campaignDiscount = $campaignDiscount >= $basicDiscount ? $campaignDiscount : 0;

            $subTotal = round($subtotal - $basicDiscount - $campaignDiscount + $tax, 2);

            $removedTotal = $booking->total_booking_amount - $subTotal;

            $refundAmount = 0;
            if ((($booking->payment_method != 'cash_after_service' && $booking->payment_method != 'offline_payment') || ($booking->payment_method == 'offline_payment' && $booking->is_paid)) && $booking->additional_charge == 0) {
                $refundAmount = $removedTotal;
            }

            $booking = Booking::find($request['booking_id']);
            $booking->additional_charge -= $subTotal;
            $booking->additional_tax_amount -= $tax;
            $booking->additional_discount_amount -= $basicDiscount;
            $booking->additional_campaign_discount_amount -= $campaignDiscount;

            $booking->total_booking_amount -= $subTotal;
            $booking->total_tax_amount -= $tax;
            $booking->total_discount_amount -= $basicDiscount;
            $booking->total_campaign_discount_amount -= $campaignDiscount;
            $booking->save();

            $basicDiscount = basic_discount_calculation($service, $variation->price * $newQuantity);
            $campaignDiscount = campaign_discount_calculation($service, $variation->price * $newQuantity);
            $subtotal = round($variation->price * $newQuantity, 2);

            $applicableDiscount = ($campaignDiscount >= $basicDiscount) ? $campaignDiscount : $basicDiscount;
            $tax = round(((($variation->price * $newQuantity - $applicableDiscount) * $service['tax']) / 100), 2);


            $basicDiscount = $basicDiscount > $campaignDiscount ? $basicDiscount : 0;
            $campaignDiscount = $campaignDiscount >= $basicDiscount ? $campaignDiscount : 0;

            $subTotal = round($subtotal - $basicDiscount - $campaignDiscount + $tax, 2);

            $bookingDetails->quantity = $newQuantity;
            $bookingDetails->tax_amount = $tax;
            $bookingDetails->total_cost = $subTotal;
            $bookingDetails->discount_amount = $basicDiscount;
            $bookingDetails->campaign_discount_amount = $campaignDiscount;
            $bookingDetails->overall_coupon_discount_amount = 0;
            $bookingDetails->save();

            $bookingDetailsAmount = BookingDetailsAmount::where('booking_id', $request['booking_id'])->where('booking_details_id', $bookingDetails->id)->first();
            $bookingDetailsAmount->service_quantity = $newQuantity;
            $bookingDetailsAmount->service_tax = $tax;
            $bookingDetailsAmount->coupon_discount_by_admin = 0;
            $bookingDetailsAmount->coupon_discount_by_provider = 0;
            $bookingDetailsAmount->discount_by_admin = $this->calculate_discount_cost($bookingDetails->discount_amount)['admin'];
            $bookingDetailsAmount->discount_by_provider = $this->calculate_discount_cost($bookingDetails->discount_amount)['provider'];
            $bookingDetailsAmount->campaign_discount_by_admin = $this->calculate_campaign_cost($bookingDetails->campaign_discount_amount)['admin'];
            $bookingDetailsAmount->campaign_discount_by_provider = $this->calculate_campaign_cost($bookingDetails->campaign_discount_amount)['provider'];
            $bookingDetailsAmount->save();

            if ($refundAmount > 0) {
                removeBookingServiceTransactionForDigitalPayment($booking, $removedTotal);
            }

           $otyDecrease = isNotificationActive(null, 'booking', 'notification', 'user');
           $providerQtyDecrease = isNotificationActive(null, 'booking', 'notification', 'provider');
           $servicemanQtyDecrease = isNotificationActive(null, 'booking', 'notification', 'serviceman');
           if ($otyDecrease) {
               $notifications[] = [
                   'key' => 'user_booking_edit_service_quantity_decrease',
                   'settings_type' => 'customer_notification'
               ];
           }
           if ($providerQtyDecrease) {
               $notifications[] = [
                   'key' => 'provider_booking_edit_service_quantity_decrease',
                   'settings_type' => 'provider_notification'
               ];
           }
           if ($servicemanQtyDecrease) {
               $notifications[] = [
                   'key' => 'serviceman_booking_edit_service_quantity_decrease',
                   'settings_type' => 'serviceman_notification'
               ];
           }


           foreach ($notifications ?? [] as $notification) {
               $key = $notification['key'];
               $settingsType = $notification['settings_type'];

               if ($settingsType == 'customer_notification') {
                   $user = $booking?->customer;
                   $title = get_push_notification_message($key, $user?->current_language_key);
                   if ($user?->cm_firebase_token && $title) {
                       device_notification($user?->cm_firebase_token, $title, null, null, $booking->id, 'booking');
                   }
               }

               if ($settingsType == 'provider_notification') {
                   $provider = $booking?->provider;
                   $title = get_push_notification_message($key, $provider?->current_language_key);
                   if ($provider?->fcm_token && $title) {
                       device_notification($provider?->fcm_token, $title, null, null, $booking->id, 'booking');
                   }
               }

               if ($settingsType == 'serviceman_notification') {
                   $serviceman = $booking?->serviceman;
                   $title = get_push_notification_message($key, $serviceman?->current_language_key);
                   if ($serviceman?->fcm_token && $title) {
                       device_notification($serviceman?->fcm_token, $title, null, null, $booking->id, 'booking');
                   }
               }
           }
        });
    }
    protected function decrease_service_quantity_from_booking_repeat($request): void
    {
        if (!$request->has('booking_repeat_id', 'service_id', 'variant_key', 'zone_id')) return;

        DB::transaction(function () use ($request) {
            $bookingDetails = BookingRepeatDetails::whereHas('repeat', fn($query) => $query->where('id', $request['booking_repeat_id']))->where('variant_key', $request['variant_key'])->first();
            $service = Service::with('variations')->find($request['service_id']);
            $variation = $service->variations->where('variant_key', $request['variant_key'])->where('zone_id', $request['zone_id'])->first();
            $booking = BookingRepeat::with(['detail', 'details_amounts'])->find($request['booking_repeat_id']);

            $oldQuantity = $request['old_quantity'];
            $newQuantity = $request['new_quantity'];
            $quantity_to_remove = $request['old_quantity'] - $request['new_quantity'];

            if ($booking->total_coupon_discount_amount > 0) {
                self::remove_coupon_from_booking($booking, $service);
            }

            $basicDiscount = basic_discount_calculation($service, $variation->price * $oldQuantity) - basic_discount_calculation($service, $variation->price * $newQuantity);
            $campaignDiscount = campaign_discount_calculation($service, $variation->price * $oldQuantity) - campaign_discount_calculation($service, $variation->price * $newQuantity);
            $subtotal = round($variation->price * $quantity_to_remove, 2);

            $applicableDiscount = max($campaignDiscount, $basicDiscount);
            $tax = round(((($variation->price * $quantity_to_remove - $applicableDiscount) * $service['tax']) / 100), 2);

            $basicDiscount = $basicDiscount > $campaignDiscount ? $basicDiscount : 0;
            $campaignDiscount = $campaignDiscount >= $basicDiscount ? $campaignDiscount : 0;

            $subTotal = round($subtotal - $basicDiscount - $campaignDiscount + $tax, 2);

            $removedTotal = $booking->total_booking_amount - $subTotal;

            $refundAmount = 0;
            if ((($booking->payment_method != 'cash_after_service' && $booking->payment_method != 'offline_payment') || ($booking->payment_method == 'offline_payment' && $booking->is_paid)) && $booking->additional_charge == 0) {
                $refundAmount = $removedTotal;
            }

            $booking = BookingRepeat::find($request['booking_repeat_id']);
            $booking->additional_charge -= $subTotal;
            $booking->additional_tax_amount -= $tax;
            $booking->additional_discount_amount -= $basicDiscount;
            $booking->additional_campaign_discount_amount -= $campaignDiscount;

            $booking->total_booking_amount -= $subTotal;
            $booking->total_tax_amount -= $tax;
            $booking->total_discount_amount -= $basicDiscount;
            $booking->total_campaign_discount_amount -= $campaignDiscount;
            $booking->save();

            $basicDiscount = basic_discount_calculation($service, $variation->price * $newQuantity);
            $campaignDiscount = campaign_discount_calculation($service, $variation->price * $newQuantity);
            $subtotal = round($variation->price * $newQuantity, 2);

            $applicableDiscount = ($campaignDiscount >= $basicDiscount) ? $campaignDiscount : $basicDiscount;
            $tax = round(((($variation->price * $newQuantity - $applicableDiscount) * $service['tax']) / 100), 2);


            $basicDiscount = $basicDiscount > $campaignDiscount ? $basicDiscount : 0;
            $campaignDiscount = $campaignDiscount >= $basicDiscount ? $campaignDiscount : 0;

            $subTotal = round($subtotal - $basicDiscount - $campaignDiscount + $tax, 2);

            $bookingDetails->quantity = $newQuantity;
            $bookingDetails->tax_amount = $tax;
            $bookingDetails->total_cost = $subTotal;
            $bookingDetails->discount_amount = $basicDiscount;
            $bookingDetails->campaign_discount_amount = $campaignDiscount;
            $bookingDetails->overall_coupon_discount_amount = 0;
            $bookingDetails->save();

            $bookingDetailsAmount = BookingDetailsAmount::where('booking_repeat_id', $booking->id)->where('booking_repeat_details_id', $bookingDetails->id)->first();
            $bookingDetailsAmount->service_quantity = $newQuantity;
            $bookingDetailsAmount->service_tax = $tax;
            $bookingDetailsAmount->coupon_discount_by_admin = 0;
            $bookingDetailsAmount->coupon_discount_by_provider = 0;
            $bookingDetailsAmount->discount_by_admin = $this->calculate_discount_cost($bookingDetails->discount_amount)['admin'];
            $bookingDetailsAmount->discount_by_provider = $this->calculate_discount_cost($bookingDetails->discount_amount)['provider'];
            $bookingDetailsAmount->campaign_discount_by_admin = $this->calculate_campaign_cost($bookingDetails->campaign_discount_amount)['admin'];
            $bookingDetailsAmount->campaign_discount_by_provider = $this->calculate_campaign_cost($bookingDetails->campaign_discount_amount)['provider'];
            $bookingDetailsAmount->save();

            if ($refundAmount > 0) {
                removeBookingServiceTransactionForDigitalPayment($booking, $removedTotal);
            }

           $otyDecrease = isNotificationActive(null, 'booking', 'notification', 'user');
           $providerQtyDecrease = isNotificationActive(null, 'booking', 'notification', 'provider');
           $servicemanQtyDecrease = isNotificationActive(null, 'booking', 'notification', 'serviceman');
           if ($otyDecrease) {
               $notifications[] = [
                   'key' => 'user_booking_edit_service_quantity_decrease',
                   'settings_type' => 'customer_notification'
               ];
           }
           if ($providerQtyDecrease) {
               $notifications[] = [
                   'key' => 'provider_booking_edit_service_quantity_decrease',
                   'settings_type' => 'provider_notification'
               ];
           }
           if ($servicemanQtyDecrease) {
               $notifications[] = [
                   'key' => 'serviceman_booking_edit_service_quantity_decrease',
                   'settings_type' => 'serviceman_notification'
               ];
           }


           foreach ($notifications ?? [] as $notification) {
               $key = $notification['key'];
               $settingsType = $notification['settings_type'];

               if ($settingsType == 'customer_notification') {
                   $user = $booking?->booking?->customer;
                   $title = get_push_notification_message($key, $user?->current_language_key);
                   if ($user?->cm_firebase_token && $title) {
                       device_notification($user?->cm_firebase_token, $title, null, null, $booking->booking_id, 'booking', null, null, null, null, 'repeat');
                   }
               }

               if ($settingsType == 'provider_notification') {
                   $provider = $booking?->provider;
                   $title = get_push_notification_message($key, $provider?->current_language_key);
                   if ($provider?->fcm_token && $title) {
                       device_notification($provider?->fcm_token, $title, null, null, $booking->booking_id, 'booking', null, null, null, null, 'repeat');
                   }
               }

               if ($settingsType == 'serviceman_notification') {
                   $serviceman = $booking?->serviceman;
                   $title = get_push_notification_message($key, $serviceman?->current_language_key);
                   if ($serviceman?->fcm_token && $title) {
                       device_notification($serviceman?->fcm_token, $title, null, null, $booking->id, 'booking', null, null, null, null, 'repeat', 'single');
                   }
               }
           }
        });
    }

    /**
     * @param $booking
     * @param $service
     * @return void
     */
    public static function remove_coupon_from_booking($booking, $service): void
    {
        DB::transaction(function () use ($booking, $service) {
            $totalCouponAmountRemoved = 0;
            $totalTaxAmount = 0;
            $totalBookingAmount = 0;

            foreach ($booking->detail as $detail) {
                $totalCouponAmountRemoved += $detail['overall_coupon_discount_amount'];

                $serviceCost = $detail['service_cost'];
                $basicDiscount = $detail['discount_amount'];
                $campaignDiscount = $detail['campaign_discount_amount'];
                $quantity = $detail['quantity'];

                $applicableDiscount = max($campaignDiscount, $basicDiscount);
                $taxPercentage = $service['tax'];
                $tax = round(((($serviceCost * $quantity - $applicableDiscount) * $taxPercentage) / 100), 2);

                $detail->tax_amount = $tax;
                $detail->total_cost = round(($serviceCost * $quantity) - $applicableDiscount + $tax, 2);
                $detail->discount_amount = 0;
                $detail->save();

                $totalTaxAmount += $tax;
                $totalBookingAmount += $detail->total_cost;
            }

            foreach ($booking->details_amounts as $detailsAmount) {
                $detailsAmount->coupon_discount_by_admin = 0;
                $detailsAmount->coupon_discount_by_provider = 0;
                $detailsAmount->save();
            }

            $booking->total_booking_amount = $totalBookingAmount;
            $booking->total_tax_amount = $totalTaxAmount;
            $booking->total_coupon_discount_amount = 0;
            $booking->coupon_code = null;
            $booking->additional_charge += $totalCouponAmountRemoved;
            $booking->removed_coupon_amount += $totalCouponAmountRemoved;
            $booking->save();
        });
    }


    //=============== PROMOTIONAL COST CALCULATION ===============

    /**
     * @param float $discount_amount
     * @return array
     */
    private function calculate_discount_cost(float $discount_amount): array
    {
        $data = business_config('service_discount_cost_bearer');

        if (!isset($data)) return [];

        $data = json_decode($data->value, true);

        if (!is_array($data)) return [];

        $adminPercentage = ($data['admin_percentage'] ?? 0) == 0
            ? 0
            : ($discount_amount * $data['admin_percentage']) / 100;

        $providerPercentage = ($data['provider_percentage'] ?? 0) == 0
            ? 0
            : ($discount_amount * $data['provider_percentage']) / 100;

        return [
            'admin' => $adminPercentage,
            'provider' => $providerPercentage
        ];
    }

    /**
     * @param float $campaignAmount
     * @return array
     */
    private function calculate_campaign_cost(float $campaignAmount): array
    {
        $data = business_config('service_campaign_cost_bearer');
        if (!isset($data)) return [];

        $data = json_decode($data->value, true); // Decode JSON string to array

        if (!is_array($data)) return [];

        $adminPercentage = ($data['admin_percentage'] ?? 0) == 0
            ? 0
            : ($campaignAmount * $data['admin_percentage']) / 100;

        $providerPercentage = ($data['provider_percentage'] ?? 0) == 0
            ? 0
            : ($campaignAmount * $data['provider_percentage']) / 100;

        return [
            'admin' => $adminPercentage,
            'provider' => $providerPercentage
        ];
    }


    /**
     * @param float $couponAmount
     * @return array
     */
    private function calculate_coupon_cost(float $couponAmount): array
    {
        $data = business_config('service_coupon_cost_bearer');
        if (!isset($data)) return [];

        $data = json_decode($data->value, true); // Convert JSON string to array

        if (!is_array($data)) return [];

        $adminPercentage = ($data['admin_percentage'] ?? 0) == 0
            ? 0
            : ($couponAmount * $data['admin_percentage']) / 100;

        $providerPercentage = ($data['provider_percentage'] ?? 0) == 0
            ? 0
            : ($couponAmount * $data['provider_percentage']) / 100;

        return [
            'admin' => $adminPercentage,
            'provider' => $providerPercentage
        ];
    }

    /**
     * @param $booking
     * @param float $bookingAmount
     * @param $providerId
     * @return void
     */
    private function update_admin_commission($booking, float $bookingAmount, $providerId): void
    {
        $commissionDetails = $this->calculateCommissionDetails($booking);

        $adminCommission = $commissionDetails['adminCommission'];
        $adminCommissionWithoutCost = $commissionDetails['adminCommissionWithoutCost'];

        $bookingAmountWithoutCommission = $booking['total_booking_amount'] - $adminCommissionWithoutCost;

        if (isset($booking->booking_id)){
            $bookingAmountDetailAmount = BookingDetailsAmount::where('booking_repeat_id', $booking->id)->first();
        }else{
            $bookingAmountDetailAmount = BookingDetailsAmount::where('booking_id', $booking->id)->first();
        }

        $bookingAmountDetailAmount->admin_commission = $adminCommission;
        $bookingAmountDetailAmount->provider_earning = $bookingAmountWithoutCommission;
        $bookingAmountDetailAmount->save();
    }


    public function calculateCommissionDetails($booking): array
    {
        if (isset($booking->booking_id)) {
            $bookingId = $booking->booking_id;
            $bookingDetailsAmounts = BookingDetailsAmount::where('booking_repeat_id', $booking->id)->get();
        } else {
            $bookingId = $booking->id;
            $bookingDetailsAmounts = BookingDetailsAmount::where('booking_id', $booking->id)->get();
        }

        if($booking->booking_type == 'subscription'){
            return [
                'adminCommission' => 0,
                'adminCommissionWithoutCost' => 0,
            ];
        }

        $serviceCost = $booking['total_booking_amount'] - $booking['total_tax_amount'] + $booking['total_discount_amount'] + $booking['total_campaign_discount_amount'] + $booking['total_coupon_discount_amount'] - $booking['extra_fee'];

        $promotionalCostByAdmin = 0;
        $promotionalCostByProvider = 0;
        foreach ($bookingDetailsAmounts as $bookingDetailsAmount) {
            $promotionalCostByAdmin += $bookingDetailsAmount['discount_by_admin'] + $bookingDetailsAmount['coupon_discount_by_admin'] + $bookingDetailsAmount['campaign_discount_by_admin'];
            $promotionalCostByProvider += $bookingDetailsAmount['discount_by_provider'] + $bookingDetailsAmount['coupon_discount_by_provider'] + $bookingDetailsAmount['campaign_discount_by_provider'];
        }

        $providerReceivableTotalAmount = $serviceCost - $promotionalCostByProvider;

        $provider = Provider::find($booking['provider_id']);
        $commissionPercentage = $provider->commission_status == 1 ? $provider->commission_percentage : (business_config('default_commission'))->value;
        $adminCommission = ($providerReceivableTotalAmount * $commissionPercentage) / 100;

        $adminCommissionWithoutCost = $adminCommission - $promotionalCostByAdmin;

        return [
            'adminCommission' => $adminCommission,
            'adminCommissionWithoutCost' => $adminCommissionWithoutCost,
        ];
    }


    //=============== REFERRAL EARN & LOYALTY POINT ===============

    /**
     * @param $userId
     * @param $zoneId
     * @return false|void
     */
    private function referral_earning_calculation($userId, $zoneId)
    {
        $isFirstBooking = Booking::where('customer_id', $userId)->count('id');
        if ($isFirstBooking > 1) return false;

        $referredByUser = User::find($userId)->referred_by_user ?? null;
        if (is_null($referredByUser)) return false;

        $customerReferralEarning = BusinessSetting::where('key', 'ref_earning_status')->first()->value ?? 0;
        $amount = BusinessSetting::where('key', 'ref_earning_exchange_rate')->first()->value ?? 0;

        if ($customerReferralEarning == 1 && CustomerLogic::check_referral_availability($userId)) {
            referralEarningTransactionAfterBookingComplete($referredByUser, $amount);
            $userRefund  = isNotificationActive(null, 'refer_earn', 'notification', 'user');
            $title = with_currency_symbol($amount) . ' ' . get_push_notification_message('user_referral_earning', $referredByUser?->current_language_key);
            if ($title && $referredByUser?->cm_firebase_token && $userRefund) {
                device_notification($referredByUser?->cm_firebase_token, $title, null, null, null, 'general', null, $referredByUser?->id);
            }

            //        TODO: need to implement referral earning transaction & notification
        //    $pushNotification = new PushNotification();
        //    $pushNotification->title = translate('You have Earned a Referral Reward!');
        //    $pushNotification->description = translate("Great news! You have earned a reward for referring a new user, who has now completed their first booking using your code...");
        //    $pushNotification->to_users = ['customer'];
        //    $pushNotification->zone_ids = [$zoneId];
        //    $pushNotification->is_active = 1;
        //    $pushNotification->cover_image = asset('/public/assets/admin/img/referral_1.png');
        //    $pushNotification->save();

        //    $pushNotificationUser = new PushNotificationUser();
        //    $pushNotificationUser->push_notification_id = $pushNotification->id;
        //    $pushNotificationUser->user_id = $referredByUser->id;
        //    $pushNotificationUser->save();
       }
    }

    /**
     * @param $userId
     * @param $totalAmount
     * @param $zoneId
     * @return false|void
     */

    private function referralEarningCalculationForFirstBooking($userId, $totalAmount, $zoneId)
    {
        $isFirstBooking = Booking::where('customer_id', $userId)->count('id');
        if ($isFirstBooking > 0) return 0;

        $referredByUser = User::find($userId)->referred_by_user ?? null;
        if (is_null($referredByUser)) return 0;

        $newUserDiscount = BusinessSetting::where('key', 'new_customer_discount_status')->first()->value ?? 0;
        $discountType = BusinessSetting::where('key', 'new_customer_discount_amount_type')->first()->value ?? 0;
        $discount = BusinessSetting::where('key', 'new_customer_discount_amount')->first()->value ?? 0;
        $validityType = BusinessSetting::where('key', 'new_customer_discount_amount_validity')->first()->value ?? 0;
        $validity = BusinessSetting::where('key', 'new_customer_discount_validity_type')->first()->value ?? 0;
        $customerReferralEarning = BusinessSetting::where('key', 'ref_earning_status')->first()->value ?? 0;

        if ($newUserDiscount && $customerReferralEarning && CustomerLogic::check_referral_availability($userId)) {

            $todayDate = Carbon::now();
            $user = User::where('id', $userId)->first();

            if ($validityType === 'day') {
                $validityEndDate = $user->created_at->addDays($validity);
            } elseif ($validityType === 'month') {
                $validityEndDate = $user->created_at->addMonths($validity);
            } else {
                return 0;
            }

            if ($todayDate <= $validityEndDate) {
                if ($discountType == 'flat') {
                    $amount = $discount;
                } elseif ($discountType == 'percentage') {
                    $bookingAmount = $totalAmount;
                    $amount = ($discount / 100) * $bookingAmount;
                }

                if ($amount > 0){
                    $userRefund  = isNotificationActive(null, 'refer_earn', 'notification', 'user');
                    $title = with_currency_symbol($amount) . ' ' . get_push_notification_message('user_referral_earning_first_booking', $user?->current_language_key);
                    if ($title && $user->cm_firebase_token && $userRefund) {
                        device_notification($user->cm_firebase_token, $title, null, null, null, 'general', null, $user->id);
                    }

            // TODO: Uncomment this block if you want to send push notification for new user referral earning
            //                    $pushNotification = new PushNotification();
            //                    $pushNotification->title = translate('You have Earned a Reward!');
            //                    $pushNotification->description = translate("Great news! You have earned a reward for sign up with a referral code and first booking...");
            //                    $pushNotification->to_users = ['customer'];
            //                    $pushNotification->zone_ids = [$zoneId];
            //                    $pushNotification->is_active = 1;
            //                    $pushNotification->cover_image = asset('/public/assets/admin/img/referral_2.png');
            //                    $pushNotification->save();
            //                    $pushNotificationUser = new PushNotificationUser();
            //                    $pushNotificationUser->push_notification_id = $pushNotification->id;
            //                    $pushNotificationUser->user_id = $userId;
            //                    $pushNotificationUser->save();
                }

                return $amount;

            } else {
                return 0;
            }
        }
        return 0;
    }



    /**
     * @param $userId
     * @param $bookingAmount
     * @return false|void
     */
    private function loyaltyPointCalculation($userId, $bookingAmount, $bookingId, $transactionType = 'booking_place')
    {
       $customerLoyaltyPoint = BusinessSetting::where('key', 'loyalty_point_status')->first();
       if (isset($customerLoyaltyPoint) && $customerLoyaltyPoint->value != '1') return false;

       $percentagePerBooking = BusinessSetting::where('key', 'loyalty_point_item_purchase_point')->first();
       $pointAmount = ($percentagePerBooking->value * $bookingAmount) / 100;

       $pointPerCurrencyUnit = BusinessSetting::where('key', 'loyalty_point_exchange_rate')->first();

       $point = $pointPerCurrencyUnit->value * $pointAmount;

       CustomerLogic::create_loyalty_point_transaction($userId, $bookingId, $bookingAmount, $transactionType);

       $user = User::where('id', $userId)->first();
       $title = $point . ' ' . get_push_notification_message('user_loyalty_point', $user?->current_language_key);

       $customerNotification = isNotificationActive(null, 'loyality_point', 'notification', 'user');
       $dataInfo = [
           'user_name' => $user?->f_name . ' ' . $user?->l_name,
       ];
       if ($title && $user && $user->status && $user->cm_firebase_token && $customerNotification) {
           device_notification($user->cm_firebase_token, $title, null, null, null, 'loyalty_point', null, $user->id, $dataInfo);
       }
    }

    function readableIdToNumber($suffix): float|int|string
    {
        $suffixes = range('A', 'Z');
        $base = count($suffixes);
        $value = 0;

        for ($i = 0, $len = strlen($suffix); $i < $len; $i++) {
            $value = $value * $base + (array_search($suffix[$i], $suffixes) + 1);
        }

        return $value;
    }

    /**
     * @param $newUserInfo
     * @return array
     */
    private function registerUserFromCheckoutPage($newUserInfo): array
    {
        $user = new User();
        $user->f_name = $newUserInfo['first_name'];
        $user->l_name = $newUserInfo['last_name'];
        $user->phone = $newUserInfo['phone'];
        $user->password = bcrypt($newUserInfo['password']);
        // $user->user_type = 'customer';
        $user->ref_code = Helpers::generate_referer_code($user);
        $user->login_medium = 'manual';
        $user->save();

        $loginToken = $user->createToken('RestaurantCustomerAuth')->accessToken;

        try
        {
            if (config('mail.status') && $newUserInfo['email'] && Helpers::get_mail_status('registration_mail_status_user') == '1' && Helpers::getNotificationStatusData('customer','customer_registration','mail_status')) {
                Mail::to($newUserInfo['email'])->send(new \App\Mail\CustomerRegistration($newUserInfo['first_name']));
            }
        }
        catch (\Exception $exception) {
            info([$exception->getFile(), $exception->getLine(), $exception->getMessage()]);
        }

        return [
            'user' => $user,
            'loginToken' => $loginToken,
        ];
    }

}
