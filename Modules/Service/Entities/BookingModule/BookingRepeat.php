<?php

namespace Modules\Service\Entities\BookingModule;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Mail;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ProviderManagement\Serviceman;
use Modules\Service\Traits\BookingModule\BookingScopes;
use Modules\Service\Traits\BookingModule\BookingTrait;

class BookingRepeat extends Model
{
    use HasFactory, BookingTrait, BookingScopes;

    protected $table = 'service_booking_repeats';

    protected $casts = [
        'is_paid' => 'integer',
        'is_verified' => 'integer',
        'total_booking_amount' => 'float',
        'total_tax_amount' => 'float',
        'total_discount_amount' => 'float',
        'total_campaign_discount_amount' => 'float',
        'total_coupon_discount_amount' => 'float',
        'is_checked' => 'integer',
        'additional_charge' => 'float',
        'additional_tax_amount' => 'float',
        'additional_discount_amount' => 'float',
        'additional_campaign_discount_amount' => 'float',
        'evidence_photos' => 'array',
        'extra_fee' => 'float',
        'total_referral_discount_amount' => 'float',
    ];

    protected $fillable = [
        'id',
        'readable_id',
        'provider_id',
        'booking_status',
        'is_paid',
        'payment_method',
        'transaction_id',
        'total_booking_amount',
        'total_tax_amount',
        'total_discount_amount',
        'service_schedule',
        'service_address_id',
        'created_at',
        'updated_at',
        'category_id',
        'sub_category_id',
        'serviceman_id',
        'total_campaign_discount_amount',
        'total_coupon_discount_amount',
        'coupon_code',
        'is_checked',
        'additional_charge',
        'additional_tax_amount',
        'additional_discount_amount',
        'additional_campaign_discount_amount',
        'evidence_photos',
        'booking_otp',
        'is_verified',
        'service_address_location',
        'service_location',
    ];

    protected $appends = ['evidence_photos_full_path', 'skipNotification'];

    protected $hidden = ['skipNotification'];

    public function getSkipNotificationAttribute()
    {
        return $this->attributes['skipNotification'] ?? false;
    }

    public function setSkipNotificationAttribute($value)
    {
        $this->attributes['skipNotification'] = $value;
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function serviceman(): BelongsTo
    {
        return $this->belongsTo(Serviceman::class, 'serviceman_id');
    }

    public function detail(): HasMany
    {
        return $this->hasMany(BookingRepeatDetails::class);
    }

    public function details_amounts(): hasMany
    {
        return $this->hasMany(BookingDetailsAmount::class);
    }

    public function booking_details_amounts(): hasOne
    {
        return $this->hasOne(BookingDetailsAmount::class);
    }

    public function statusHistories(): HasMany
    {
        return $this->hasMany(BookingStatusHistory::class, 'booking_repeat_id');
    }

    public function scheduleHistories(): HasMany
    {
        return $this->hasMany(BookingScheduleHistory::class, 'booking_repeat_id');
    }

    public function repeatHistories(): HasMany
    {
        return $this->hasMany(BookingRepeatHistory::class, 'booking_repeat_id')->latest();
    }

    public function getEvidencePhotosFullPathAttribute()
    {
        $evidenceImages = $this->evidence_photos ?? [];
        $defaultImagePath = asset('public/assets/admin-module/img/media/user.png');
        if (empty($evidenceImages)) {
            if (request()->is('api/*')) {
                $defaultImagePath = null;
            }
            return $defaultImagePath ? [$defaultImagePath] : [];
        }

        $path = 'booking/evidence/';

        return getIdentityImageFullPath(identityImages: $evidenceImages, path: $path, defaultPath: $defaultImagePath);
    }

    public static function boot()
    {
        parent::boot();

       self::updating(function ($model) {
           $permission = isNotificationActive(null, 'booking', 'notification', 'user');
           $providerPermission = isNotificationActive(null, 'booking', 'notification', 'provider');
           $servicemanPermission = isNotificationActive(null, 'booking', 'notification', 'serviceman');

           if ($model->isDirty('booking_status')) {
               $key = null;
               if ($model->booking_status == 'ongoing') {
                   if ($permission) {
                       $notifications[] = [
                           'key' => 'user_booking_ongoing',
                           'settings_type' => 'customer_notification'
                       ];
                   }
                   if ($providerPermission){
                       $notifications[] = [
                           'key' => 'provider_ongoing_booking',
                           'settings_type' => 'provider_notification'
                       ];
                   }
                   if ($servicemanPermission) {
                       $notifications[] = [
                           'key' => 'serviceman_ongoing_booking',
                           'settings_type' => 'serviceman_notification'
                       ];
                   }
               } elseif ($model->booking_status == 'completed') {
                   if ($permission) {
                       $notifications[] = [
                           'key' => 'user_booking_complete',
                           'settings_type' => 'customer_notification'
                       ];
                   }
                   if ($providerPermission) {
                       $notifications[] = [
                           'key' => 'provider_booking_complete',
                           'settings_type' => 'provider_notification'
                       ];
                   }
                   if ($servicemanPermission) {
                       $notifications[] = [
                           'key' => 'serviceman_booking_complete',
                           'settings_type' => 'serviceman_notification'
                       ];
                   }

                   $model->is_paid = 1;

                   $provider = $model->provider;

                   if ($provider) {
                       $model->update_admin_commission($model, $model->total_booking_amount, $model->provider_id);
                   }


                   if (!$model?->booking?->is_guest && $model?->booking?->customer) {
                       $model->referral_earning_calculation($model?->booking?->customer_id, $model?->booking?->zone_id);

                       $model->loyaltyPointCalculation($model?->booking?->customer_id, $model->total_booking_amount, $model->id, 'repeat_booking_place');

                       if ($model->total_referral_discount_amount > 0){
                           referralEarningTransactionAfterBookingRepeatCompleteFirst($model->customer, $model->total_referral_discount_amount, $model->id);
                       }
                   }

                   //================ Transactions for Booking ================

                   if ($model?->provider) {
                       if ($model->payment_method == 'cash_after_service') {
                           completeBookingRepeatTransactionForCashAfterService($model);
                       } else {
                           if ($model->additional_charge == 0) {
                               completeBookingRepeatTransactionForDigitalPayment($model);
                           }

//                            if ($model->additional_charge > 0) {
//                                completeBookingTransactionForDigitalPaymentAndExtraService($model);
//                            }
                       }

                       $limit_status = provider_warning_amount_calculate($provider->account->payable_balance, $provider->account->receivable_balance);

                       if ($limit_status == '100_percent' && business_config('provider_suspend_on_exceed_cash_limit')->value) {
                           $provider->is_suspended = 1;
                           $provider->save();

                           $notification = isNotificationActive($provider?->id, 'transaction', 'notification', 'provider');
                           $title = get_push_notification_message('provider_provider_suspend', $provider?->current_language_key);
                           if ($provider?->fcm_token && $title && $notification) {
                               device_notification($provider?->fcm_token, $title, null, null, $model->id, 'suspend', null, $provider->id);
                           }

                           try {
                            //    Mail::to($provider?->email)->send(new CashInHandOverflowMail($provider));
                           } catch (\Exception $exception) {
                               info($exception);
                           }
                       }
                   }

               } elseif ($model->booking_status == 'canceled' && $model->skipNotification) {
                   if ($permission) {
                       $notifications[] = [
                           'key' => 'user_booking_cancel',
                           'settings_type' => 'customer_notification'
                       ];
                   }
                   if ($providerPermission) {
                       $notifications[] = [
                           'key' => 'provider_booking_cancel',
                           'settings_type' => 'provider_notification'
                       ];
                   }
                   if ($servicemanPermission) {
                       $notifications[] = [
                           'key' => 'serviceman_booking_cancel',
                           'settings_type' => 'serviceman_notification'
                       ];
                   }

//                    if ($model?->customer) {
//                        refundTransactionForCanceledBooking($model);
//                    }

               }
//                elseif ($model->booking_status == 'refund_request') {
//                    if ($permission) {
//                        $notifications[] = [
//                            [
//                                'key' => 'refund',
//                                'settings_type' => 'customer_notification'
//                            ]
//                        ];
//                    }
//                }


                foreach ($notifications ?? [] as $notification) {
                    $key = $notification['key'];
                    $settingsType = $notification['settings_type'];

                    if ($settingsType == 'customer_notification') {
                        $user = $model?->booking?->customer;
                        $repeatOrRegular = $model?->booking?->is_repeated ? 'repeat' : 'regular';
                        $title = get_push_notification_message($key, $user?->current_language_key);
                        $permission = isNotificationActive(null, 'booking', 'notification', 'user');
                        if ($user?->cm_firebase_token && $user?->status && $title && $permission) {
                            device_notification($user?->cm_firebase_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular, 'single');
                        }
                    }

                    if ($settingsType == 'provider_notification') {

                        if ((!business_config('provider_suspend_on_exceed_cash_limit', 'service_business_settings')->value || $model?->provider?->is_suspended == 0) && $model->booking_status == 'pending') {
                            $provider = $model?->provider;
                            $repeatOrRegular = $model?->booking?->is_repeated ? 'repeat' : 'regular';
                            $title = get_push_notification_message($key, $provider?->current_language_key);

                            if ($provider?->fcm_token && $title && sendDeviceNotificationPermission($model?->provider_id)) {
                                device_notification($provider?->fcm_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular, 'single');
                            }
                        } else {
                            $provider = $model?->provider;
                            $repeatOrRegular = $model?->booking?->is_repeated ? 'repeat' : 'regular';
                            $title = get_push_notification_message($key, $provider?->current_language_key);

                            if ($provider?->fcm_token && $title  && sendDeviceNotificationPermission($model?->provider_id)) {
                                device_notification($provider?->fcm_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular, 'single');
                            }
                        }
                    }

                    if ($settingsType == 'serviceman_notification') {
                        $serviceman = $model?->serviceman;
                        $repeatOrRegular = $model?->booking?->is_repeated ? 'repeat' : 'regular';
                        $title = get_push_notification_message($key, $serviceman?->current_language_key);
                        if ($serviceman?->fcm_token && $title) {
                            device_notification($serviceman?->fcm_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular, 'single');
                        }
                    }
                }
           }
       });

       self::updated(function ($model) {
           $status = $model->booking_status;
           $bookingScheduleTimeChange = isNotificationActive(null, 'booking', 'notification', 'user');
           $bookingScheduleTimeChangeProvider = isNotificationActive(null, 'booking', 'notification', 'provider');
           $bookingScheduleTimeChangeServiceman = isNotificationActive(null, 'booking', 'notification', 'serviceman');

           $notifications = [];

           if ($model->isDirty('serviceman_id')) {
               if ($bookingScheduleTimeChange) {
                   $notifications[] = [
                       'key' => 'user_serviceman_assign',
                       'settings_type' => 'customer_notification'
                   ];
               }
               if ($bookingScheduleTimeChangeProvider) {
                   $notifications[] = [
                       'key' => 'provider_serviceman_assign',
                       'settings_type' => 'provider_notification'
                   ];
               }
               if ($bookingScheduleTimeChangeServiceman) {
                   $notifications[] = [
                       'key' => 'serviceman_serviceman_assign',
                       'settings_type' => 'serviceman_notification'
                   ];
               }
           }

           if ($model->isDirty('service_schedule')) {
               if ($bookingScheduleTimeChange) {
                   $notifications[] = [
                       'key' => 'user_booking_schedule_time_change',
                       'settings_type' => 'customer_notification'
                   ];
               }
               if ($bookingScheduleTimeChangeProvider) {
                   $notifications[] = [
                       'key' => 'provider_booking_schedule_time_change',
                       'settings_type' => 'provider_notification'
                   ];
               }
               if ($bookingScheduleTimeChangeServiceman) {
                   $notifications[] = [
                       'key' => 'serviceman_booking_schedule_time_change',
                       'settings_type' => 'serviceman_notification'
                   ];
               }
           }

            foreach ($notifications ?? [] as $notification) {
                $key = $notification['key'];
                $settingsType = $notification['settings_type'];

                if ($settingsType == 'customer_notification') {
                    $user = $model?->booking?->customer;
                    $repeatOrRegular = $model?->booking?->is_repeated ? 'repeat' : 'regular';
                    $title = get_push_notification_message($key, $user?->current_language_key);
                    if ($user?->cm_firebase_token && $title) {
                        device_notification($user?->cm_firebase_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular, 'single');
                    }
                }

                if ($settingsType == 'provider_notification') {
                    if ((!business_config('provider_suspend_on_exceed_cash_limit', 'service_business_settings')->value || $model?->provider?->is_suspended == 0) && $model->booking_status == 'pending') {
                        $provider = $model?->provider;
                        $repeatOrRegular = $model?->booking?->is_repeated ? 'repeat' : 'regular';
                        $title = get_push_notification_message($key, $provider?->current_language_key);
                        if ($provider?->fcm_token && $title && sendDeviceNotificationPermission($model?->provider_id)) {
                            device_notification($provider?->fcm_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular, 'single');
                        }
                    } else {
                        $provider = $model?->provider;
                        $repeatOrRegular = $model?->booking?->is_repeated ? 'repeat' : 'regular';
                        $title = get_push_notification_message($key, $provider?->current_language_key);
                        if ($provider?->fcm_token && $title && sendDeviceNotificationPermission($model?->provider_id)) {
                            device_notification($provider?->fcm_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular, 'single');
                        }
                    }
                }

                if ($settingsType == 'serviceman_notification') {
                    $serviceman = $model?->serviceman;
                    $repeatOrRegular = $model?->booking?->is_repeated ? 'repeat' : 'regular';
                    $title = get_push_notification_message($key, $serviceman?->current_language_key);
                    if ($serviceman?->fcm_token && $title) {
                        device_notification($serviceman?->fcm_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular, 'single');
                    }
                }
            }
       });

        self::deleting(function ($model) {

        });

        self::deleted(function ($model) {

        });
    }
}
