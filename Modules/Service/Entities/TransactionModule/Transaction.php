<?php

namespace Modules\Service\Entities\TransactionModule;

use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Service\Entities\BookingModule\Booking;
use Modules\Service\Entities\BookingModule\BookingRepeat;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ProviderManagement\Serviceman;

class Transaction extends Model
{
    use HasFactory;

    protected $casts = [
        'debit' => 'float',
        'credit' => 'float',
        'balance' => 'float',
    ];

    protected $fillable = ['ref_trx_id', 'booking_id', 'booking_repeat_id', 'trx_type', 'debit', 'credit', 'balance', 'from_user_id', 'from_user_type', 'to_user_id', 'to_user_type', 'from_user_account', 'to_user_account', 'reference_note'];

    protected $table = 'service_transactions';

    public function scopeSearch($query, $keywords, array $searchColumns): mixed
    {
        return $query->when($keywords && $searchColumns, function ($query) use ($keywords, $searchColumns) {
            $keys = explode(' ', $keywords);
            $query->where(function ($query) use ($keys, $searchColumns) {
                foreach ($keys as $key) {
                    foreach ($searchColumns as $column) {
                        $query->orWhere($column, 'LIKE', '%' . $key . '%');
                    }
                }
            });
        });
    }

    public function scopeFilterDateRange($query, $dateRange, $from, $to): mixed
    {
        return $query
            ->when($dateRange === 'custom_date', function ($query) use ($from, $to) {
                return $query->whereBetween('created_at', [Carbon::parse($from,)->startOfDay(), Carbon::parse($to)->endOfDay()]);
            })
            ->when($dateRange !== 'custom_date', function ($query) use ($dateRange) {
                return match ($dateRange) {
                    'this_week' => $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]),
                    'last_week' => $query->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]),
                    'this_month' => $query->whereMonth('created_at', Carbon::now()->month),
                    'last_month' => $query->whereMonth('created_at', Carbon::now()->subMonth()->month),
                    'last_15_days' => $query->whereBetween('created_at', [Carbon::now()->subDay(15), Carbon::now()]),
                    'this_year' => $query->whereYear('created_at', Carbon::now()->year),
                    'last_year' => $query->whereYear('created_at', Carbon::now()->subYear()->year),
                    'last_6_month' => $query->whereBetween('created_at', [Carbon::now()->subMonth(6), Carbon::now()]),
                    'this_year_1st_quarter' => $query->whereBetween('created_at', [Carbon::now()->month(1)->startOfQuarter(), Carbon::now()->month(1)->endOfQuarter()]),
                    'this_year_2nd_quarter' => $query->whereBetween('created_at', [Carbon::now()->month(4)->startOfQuarter(), Carbon::now()->month(4)->endOfQuarter()]),
                    'this_year_3rd_quarter' => $query->whereBetween('created_at', [Carbon::now()->month(7)->startOfQuarter(), Carbon::now()->month(7)->endOfQuarter()]),
                    'this_year_4th_quarter' => $query->whereBetween('created_at', [Carbon::now()->month(10)->startOfQuarter(), Carbon::now()->month(10)->endOfQuarter()]),
                    default => $query,
                };
            });
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class,'booking_id');
    }

    public function repeat(): BelongsTo
    {
        return $this->belongsTo(BookingRepeat::class,'booking_repeat_id');
    }

    public function packageLog(): BelongsTo
    {
        return $this->belongsTo(PackageSubscriberLog::class,'id', 'primary_transaction_id');
    }

    // public function from_user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class,'from_user_id');
    // }

    // public function to_user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class,'to_user_id');
    // }

    public function from_customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function from_provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'from_user_id');
    }

    public function from_service_man(): BelongsTo
    {
        return $this->belongsTo(Serviceman::class, 'from_user_id');
    }

    public function from_admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'from_user_id');
    }

    public function getFromUserAttribute()
    {
        if ($this->user_type === PROVIDER) {
            return $this->from_provider;
        } elseif ($this->user_type === CUSTOMER) {
            return $this->from_customer;
        } elseif ($this->user_type === SERVICEMAN) {
            return $this->from_service_man;
        }
        return $this->from_admin;
    }
    public function to_customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    public function to_provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'to_user_id');
    }

    public function to_service_man(): BelongsTo
    {
        return $this->belongsTo(Serviceman::class, 'to_user_id');
    }

    public function to_admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'to_user_id');
    }

    public function getToUserAttribute()
    {
        if ($this->user_type === PROVIDER) {
            return $this->to_provider;
        } elseif ($this->user_type === CUSTOMER) {
            return $this->to_customer;
        } elseif ($this->user_type === SERVICEMAN) {
            return $this->to_service_man;
        }
        return $this->to_admin;
    }
}
