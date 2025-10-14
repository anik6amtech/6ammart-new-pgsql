<?php

namespace Modules\RideShare\Entities\TripManagement;

use App\Models\DeliveryMan;
use App\Models\Module;
use App\Models\RiderVehicle;
use App\Models\RiderVehicleCategory;
use App\Models\User;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\RideShare\Entities\PromotionManagement\CouponSetup;
use Modules\RideShare\Entities\PromotionManagement\DiscountSetup;
use Modules\RideShare\Entities\ReviewModule\RideReview;
use Modules\RideShare\Entities\UserManagement\RiderDetail;
use Modules\RideShare\Entities\UserManagement\TimeTrack;

class RideRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ref_id',
        'module_id',
        'customer_id',
        'driver_id',
        'vehicle_category_id',
        'vehicle_id',
        'zone_id',
        'area_id',
        'estimated_fare',
        'actual_fare',
        'estimated_distance',
        'paid_fare',
        'return_fee',
        'cancellation_fee',
        'extra_fare_fee',
        'extra_fare_amount',
        'return_time',
        'due_amount',
        'actual_distance',
        'encoded_polyline',
        'accepted_by',
        'payment_method',
        'payment_status',
        'coupon_id',
        'coupon_amount',
        'discount_id',
        'discount_amount',
        'note',
        'entrance',
        'otp',
        'rise_request_count',
        'type',
        'current_status',
        'ride_cancellation_reason',
        'checked',
        'tips',
        'is_paused',
        'map_screenshot',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'estimated_fare' => 'float',
        'actual_fare' => 'float',
        'return_fee' => 'float',
        'cancellation_fee' => 'float',
        'extra_fare_fee' => 'float',
        'extra_fare_amount' => 'float',
        'due_amount' => 'float',
        'estimated_time' => 'float',
        'estimated_distance' => 'float',
        'paid_fare' => 'float',
        "actual_time" => 'float',
        "actual_distance" => 'float',
        "waiting_time" => 'float',
        "idle_time" => 'float',
        "waiting_fare" => 'float',
        "idle_fare" => 'float',
        "vat_tax" => 'float',
        "additional_charge" => 'float',
        "coupon_amount" => 'float',
        "discount_amount" => 'float',
        "total_fare" => 'float',
        "is_paused" => 'boolean',
        "rise_request_count" => 'integer'
    ];

    // public function channel(): MorphOne
    // {
    //     return $this->morphOne(ChannelList::class, 'channelable');
    // }

    // public function conversations(): MorphMany
    // {
    //     return $this->morphMany(ChannelConversation::class, 'convable');
    // }

    public function fare_biddings()
    {
        return $this->hasMany(FareBidding::class, 'ride_request_id');
    }

    public function tripRoutes()
    {
        return $this->hasMany(RideRoute::class);
    }

    public function tripStatus()
    {
        return $this->hasOne(RideStatus::class, 'ride_request_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(RiderVehicle::class);
    }

    public function vehicleCategory()
    {
        return $this->belongsTo(RiderVehicleCategory::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function driver()
    {
        return $this->belongsTo(DeliveryMan::class, 'driver_id');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function coupon()
    {
        return $this->belongsTo(CouponSetup::class, 'coupon_id');
    }

    public function discount()
    {
        return $this->belongsTo(DiscountSetup::class, 'discount_id');
    }

    public function customerReceivedReview()
    {
        return $this->hasOne(RideReview::class, 'ride_request_id', 'id')->where('received_by', $this->customer_id);
    }

    public function driverReceivedReview()
    {
        return $this->hasOne(RideReview::class, 'ride_request_id', 'id')->where('received_by', $this->driver_id);
    }

    public function customerReceivedReviews()
    {
        return $this->hasMany(RideReview::class, 'received_by', 'customer_id');
    }

    public function driverReceivedReviews()
    {
        return $this->hasMany(RideReview::class, 'received_by', 'driver_id');
    }

    public function ignoredRequests()
    {
        return $this->hasOne(RejectedDriverRequest::class, 'ride_request_id');
    }

    public function coordinate()
    {
        return $this->hasOne(RideRequestCoordinate::class, 'ride_request_id');
    }

    public function fee()
    {
        return $this->hasOne(RideRequestFee::class, 'ride_request_id');
    }

    public function time()
    {
        return $this->hasOne(RideRequestTime::class, 'ride_request_id');
    }

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('current_status', $status);
    }

    public function distance_wise_fare()
    {
        return $this->actual_fare;
    }

    public function getDiscountActualFareAttribute()
    {
        $totalFare = $this->actual_fare;
        if ($this->discount_amount > 0) {
            $vat_percent = (double)get_cache('ride_vat') ?? 1;
            $actual_fare = $this->actual_fare / (1 + ($vat_percent / 100));
            $discountReduceFare = $actual_fare - ($this->discount_amount ?? 0);
            $vat = round(($vat_percent * $discountReduceFare) / 100, 2);
            $totalFare = $discountReduceFare + $vat;
        }
        return round((double)$totalFare, 2);
    }

    public function getMapScreenshotAttribute($value)
    {
        if ($value) {
            return asset('storage/app/public/trip/screenshots') . '/' . $value;
        }
        return null;
    }

    // public function logs()
    // {
    //     return $this->morphMany(ActivityLog::class, 'logable');
    // }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            $item->ref_id = $item->withTrashed()->count() + 100000;
            $rideShareModule = Module::where('module_type', 'ride-share')->first();
            if(!empty($rideShareModule)) {
                $item->module_id = $rideShareModule->id;
            }
        });

        static::updated(function ($item) {
            $array = [];
            foreach ($item->changes as $key => $change) {
                if (array_key_exists($key, $item->original)) {
                    $array[$key] = $item->original[$key];
                }
            }
            // if (!empty($array)) {
            //     $log = new ActivityLog();
            //     $log->edited_by = auth()->user()->id ?? 'user_update';
            //     $log->before = $array;
            //     $log->after = $item->changes;
            //     $item->logs()->save($log);
            // }
            // if ($item->current_status == CANCELLED) {
            //     if ($item->type == PARCEL) {
            //         $message = 'a_parcel_request_is_cancelled';
            //     } else {
            //         $message = 'a_trip_request_is_cancelled';
            //     }
            //     $notification = new AdminNotification();
            //     $notification->model = 'trip_request';
            //     $notification->model_id = $item->id;
            //     $notification->message = $message;
            //     $notification->save();
            // }
            if ($item->driver_id && $item->isDirty('current_status')) {
                $track = TimeTrack::query()
                    ->where(['user_id' => $item->driver_id, 'date' => date('Y-m-d')])
                    ->latest()->first();

                if (!$track) {
                    $track = TimeTrack::query()
                        ->where(['user_id' => $item->driver_id])
                        ->latest()->first();
                }
                $driver = RiderDetail::query()->firstWhere('user_id', $item->driver_id);

                if ($item->current_status == ACCEPTED) {
                    if ($item->type == RIDE_REQUEST) {
                        $driver->ride_count += 1;
                    }
                    $driver->availability_status = 'available';
                    $driver->save();

                    if(!$track) {
                        $track = new TimeTrack();
                        $track->user_id = $item->driver_id;
                        $track->date = date('Y-m-d');
                        $track->last_ride_started_at = now();
                        $track->total_driving = 0;
                        $track->total_idle = 0;
                        $track->save();
                    } else {
                        $duration = Carbon::parse($track->last_ride_completed_at)->diffInMinutes();
                        $track->last_ride_started_at = now();
                        $track->total_idle += $duration;
                        $track->save();
                    }
                    
                } elseif ($item->current_status == COMPLETED || $item->current_status == CANCELLED) {
                    $driver->availability_status = 'available';
                    $driver->save();

                    $duration = Carbon::parse($track->last_ride_started_at)->diffInMinutes();
                    $track->last_ride_completed_at = now();
                    $track->total_driving += $duration;
                    $track->save();
                }
            }
        });

        // static::deleted(function ($item) {
        //     $log = new ActivityLog();
        //     $log->edited_by = auth()->user()->id;
        //     $log->before = $item->original;
        //     $item->logs()->save($log);
        // });


    }


    public function safetyAlerts() {
        return $this->hasMany(RideSafetyAlert::class, 'ride_request_id');
    }

    public function customerSafetyAlertPending()
    {
        return $this->hasOne(RideSafetyAlert::class, 'ride_request_id', 'id')->where('status', PENDING)->where('sent_by', $this->customer_id)->where('sent_by_type', CUSTOMER);
    }

    public function driverSafetyAlertPending()
    {
        return $this->hasOne(RideSafetyAlert::class, 'ride_request_id', 'id')->where('status', PENDING)->where('sent_by', $this->driver_id)->where('sent_by_type', DRIVER);
    }

    public function customerSafetyAlert()
    {
        return $this->hasOne(RideSafetyAlert::class, 'ride_request_id', 'id')->where('sent_by', $this->customer_id)->where('sent_by_type', CUSTOMER);
    }

    public function driverSafetyAlert()
    {
        return $this->hasOne(RideSafetyAlert::class, 'ride_request_id', 'id')->where('sent_by', $this->driver_id)->where('sent_by_type', DRIVER);
    }



}
