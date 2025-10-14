<?php

namespace Modules\Service\Entities\BookingModule;

use App\Models\CustomerAddress;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Mail;
use Modules\Service\Entities\BidModule\Post;
use Modules\Service\Entities\CategoryManagement\Category;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ProviderManagement\Serviceman;
use Modules\Service\Entities\Review\Review;
use Modules\Service\Mail\BusinessSettingsModule\CashInHandOverflowMail;
use Modules\Service\Traits\BookingModule\BookingScopes;
use Modules\Service\Traits\BookingModule\BookingTrait;

class Booking extends Model
{
    use HasFactory, BookingTrait, BookingScopes;

    protected $table = 'service_bookings';

    protected $casts = [
        'readable_id' => 'integer',
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
        'customer_id',
        'provider_id',
        'zone_id',
        'post_id',
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
        'booking_type'
    ];

    protected $appends = ['evidence_photos_full_path'];


    public function scopeCanceled($query)
    {
        $query->where('booking_status', '=', 'canceled');
    }

    public function service_address(): BelongsTo
    {
        return $this->belongsTo(CustomerAddress::class, 'service_address_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'sub_category_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    public function serviceman(): BelongsTo
    {
        return $this->belongsTo(Serviceman::class, 'serviceman_id');
    }

    public function detail(): HasMany
    {
        return $this->hasMany(BookingDetail::class);
    }

    public function repeatDetail(): HasMany
    {
        return $this->hasMany(BookingDetail::class);
    }
    public function repeat(): HasMany
    {
        return $this->hasMany(BookingRepeat::class);
    }

    public function booking_partial_payments(): HasMany
    {
        return $this->hasMany(BookingPartialPayment::class)->latest();
    }

    public function booking_details_amounts(): hasOne
    {
        return $this->hasOne(BookingDetailsAmount::class);
    }

    public function bookingDeniedNote(): hasOne
    {
        return $this->hasOne(BookingAdditionalInformation::class, 'booking_id')->where('key', 'booking_deny_note');
    }

    public function details_amounts(): hasMany
    {
        return $this->hasMany(BookingDetailsAmount::class);
    }

    public function schedule_histories(): HasMany
    {
        return $this->hasMany(BookingScheduleHistory::class);
    }
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function status_histories(): HasMany
    {
        return $this->hasMany(BookingStatusHistory::class);
    }

    public function booking_offline_payments(): HasMany
    {
        return $this->hasMany(BookingOfflinePayment::class, 'booking_id');
    }

    public function ignores(): HasMany
    {
        return $this->hasMany(BookingIgnore::class, 'booking_id');
    }

    public function customizeBooking(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'id', 'booking_id');
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

    public function scopeModule($query, $module_id)
    {
        return $query->where('module_id', $module_id);
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
        });

        self::created(function ($model) {
        });

        self::updating(function ($model) {
           $permission = isNotificationActive(null, 'booking', 'notification', 'user');
           $providerPermission = isNotificationActive(null, 'booking', 'notification', 'provider');
           $servicemanPermission = isNotificationActive(null, 'booking', 'notification', 'serviceman');
            //    $permission = false;
            //    $providerPermission = false;
            //    $servicemanPermission = false;

           if ($model->isDirty('booking_status')) {
               $key = null;
               if ($model->booking_status == 'pending') {
                   if ($permission) {
                       $notifications[] = [
                           'key' => 'user_booking_place',
                           'settings_type' => 'customer_notification'
                       ];
                   }
               } elseif ($model->booking_status == 'ongoing') {
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
               } elseif ($model->booking_status == 'accepted') {
                   if ($permission) {
                       $notifications[] = [
                           'key' => 'user_booking_accepted',
                           'settings_type' => 'customer_notification'
                       ];
                   }
                   if ($providerPermission && $model->is_repeated == 0) {
                       $notifications[] = [
                           'key' => 'provider_booking_accepted',
                           'settings_type' => 'provider_notification'
                       ];
                   }
               } elseif ($model->booking_status == 'completed' && $model->is_repeated == 0) {
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


                   if (!$model->is_guest && $model?->customer) {
                       $model->referral_earning_calculation($model->customer_id, $model->zone_id);

                       $model->loyaltyPointCalculation($model->customer_id, $model->total_booking_amount, $model->id);

                       if ($model->total_referral_discount_amount > 0){
                           referralEarningTransactionAfterBookingCompleteFirst($model->customer, $model->total_referral_discount_amount, $model->id);
                       }
                   }

                   //================ Transactions for Booking ================

                   if ($model?->provider) {
                       if ($model->booking_partial_payments->isNotEmpty()) {
                           if ($model['payment_method'] == 'cash_after_service') {
                               $booking_partial_payment = new BookingPartialPayment;
                               $booking_partial_payment->booking_id = $model->id;
                               $booking_partial_payment->paid_with = 'cash_after_service';
                               $booking_partial_payment->paid_amount = $model->booking_partial_payments->first()?->due_amount;
                               $booking_partial_payment->due_amount = 0;
                               $booking_partial_payment->save();

                               completeBookingTransactionForPartialCas($model);
                           } elseif ($model['payment_method'] != 'wallet_payment') {
                               completeBookingTransactionForPartialDigital($model);
                           }

                       } elseif ($model->payment_method == 'cash_after_service') {
                           completeBookingTransactionForCashAfterService($model);
                       } else {
                           if ($model->additional_charge == 0) {
                               completeBookingTransactionForDigitalPayment($model);
                           }

                           if ($model->additional_charge > 0) {
                               completeBookingTransactionForDigitalPaymentAndExtraService($model);
                           }
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
                               Mail::to($provider?->email)->send(new CashInHandOverflowMail($provider));
                           } catch (\Exception $exception) {
                               info($exception);
                           }
                       }
                   }

               } elseif ($model->booking_status == 'canceled') {
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
                   if ($model?->customer) {
                       refundTransactionForCanceledBooking($model);
                   }

               } elseif ($model->booking_status == 'refund_request') {
                   if ($permission) {
                       $notifications[] = [
                           [
                               'key' => 'user_refund',
                               'settings_type' => 'customer_notification'
                           ]
                       ];
                   }
               }

                foreach ($notifications ?? [] as $notification) {
                    $key = $notification['key'];
                    $settingsType = $notification['settings_type'];

                    if ($settingsType == 'customer_notification') {
                        $user = $model?->customer;
                        $repeatOrRegular = $model?->is_repeated ? 'repeat' : 'regular';
                        $title = get_push_notification_message($key, $user?->current_language_key);
                        $permission = isNotificationActive(null, 'booking', 'notification', 'user');
                        if ($user?->cm_firebase_token && $user?->status && $title && $permission) {
                            device_notification($user?->cm_firebase_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular);
                        }
                    }

                    if ($settingsType == 'provider_notification') {

                        if ((!business_config('provider_suspend_on_exceed_cash_limit')->value || $model?->provider?->is_suspended == 0) && $model->booking_status == 'pending') {
                            $provider = $model?->provider;
                            $repeatOrRegular = $model?->is_repeated ? 'repeat' : 'regular';
                            $title = get_push_notification_message($key, $provider?->current_language_key);

                            if ($provider?->fcm_token && $title && sendDeviceNotificationPermission($model?->provider_id)) {
                                device_notification($provider?->fcm_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular);
                            }
                        } else {
                            $provider = $model?->provider;
                            $repeatOrRegular = $model?->is_repeated ? 'repeat' : 'regular';
                            $title = get_push_notification_message($key, $provider?->current_language_key);

                            if ($provider?->fcm_token && $title  && sendDeviceNotificationPermission($model?->provider_id)) {
                                device_notification($provider?->fcm_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular);
                            }
                        }
                    }

                    if ($settingsType == 'serviceman_notification') {
                        $serviceman = $model?->serviceman;
                        $title = get_push_notification_message($key, $serviceman?->current_language_key);
                        if ($serviceman?->fcm_token && $title) {
                            device_notification($serviceman?->fcm_token, $title, null, null, $model->id, 'booking');
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
        //    $bookingScheduleTimeChange = false;
        //    $bookingScheduleTimeChangeProvider = false;
        //    $bookingScheduleTimeChangeServiceman = false;

           $notifications = [];

           if ($model->isDirty('serviceman_id') && !$model->is_repeted) {
               if ($bookingScheduleTimeChange) {
                   $notifications[] = [
                       'key' => 'user_serviceman_assign',
                       'settings_type' => 'customer_notification'
                   ];
               }
               if ($bookingScheduleTimeChangeProvider && !$model->is_repeted) {
                   $notifications[] = [
                       'key' => 'provider_serviceman_assign',
                       'settings_type' => 'provider_notification'
                   ];
               }
               if ($bookingScheduleTimeChangeServiceman && !$model->is_repeted) {
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
                    $user = $model?->customer;
                    $repeatOrRegular = $model?->is_repeated ? 'repeat' : 'regular';
                    $title = get_push_notification_message($key, $user?->current_language_key);
                    if ($user?->cm_firebase_token && $title) {
                        device_notification($user?->cm_firebase_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular);
                    }
                }

                if ($settingsType == 'provider_notification') {
                    if ((!business_config('provider_suspend_on_exceed_cash_limit')->value || $model?->provider?->is_suspended == 0) && $model->booking_status == 'pending') {
                        $provider = $model?->provider;
                        $repeatOrRegular = $model?->is_repeated ? 'repeat' : 'regular';
                        $title = get_push_notification_message($key, $provider?->current_language_key);
                        if ($provider?->fcm_token && $title && sendDeviceNotificationPermission($model?->provider_id)) {
                            device_notification($provider?->fcm_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular);
                        }
                    } else {
                        $provider = $model?->provider;
                        $repeatOrRegular = $model?->is_repeated ? 'repeat' : 'regular';
                        $title = get_push_notification_message($key, $provider?->current_language_key);
                        if ($provider?->fcm_token && $title && sendDeviceNotificationPermission($model?->provider_id)) {
                            device_notification($provider?->fcm_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular);
                        }
                    }
                }

                if ($settingsType == 'serviceman_notification') {
                    $serviceman = $model?->serviceman;
                    $repeatOrRegular = $model?->is_repeated ? 'repeat' : 'regular';
                    $title = get_push_notification_message($key, $serviceman?->current_language_key);
                    if ($serviceman?->fcm_token && $title) {
                        device_notification($serviceman?->fcm_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular);
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
