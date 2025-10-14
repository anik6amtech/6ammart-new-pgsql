<?php

namespace Modules\RideShare\Entities\TransactionManagement;

use App\Models\Admin;
use App\Models\DeliveryMan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\RideShare\Entities\TripManagement\RideRequest;
use App\Models\UserAccount;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribute_id',
        'attribute',
        'debit',
        'credit',
        'balance',
        'user_id',
        'user_type',
        'account',
        'transaction_type',
        'trx_ref_id',
        'created_at',
        'updated_at',
        'reference'
    ];

    protected $casts = [
        'debit' => 'float',
        'credit' => 'float',
        'balance' => 'float'
    ];

    protected $table = 'ride_transactions';

    protected $guarded = [];

    public function customerAccount(): BelongsTo
    {
        return $this->belongsTo(UserAccount::class, 'user_id')->where('user_type', CUSTOMER);
    }
    public function driverAccount(): BelongsTo
    {
        return $this->belongsTo(UserAccount::class, 'user_id')->where('user_type', DRIVER);
    }
    public function adminAccount(): BelongsTo
    {
        return $this->belongsTo(UserAccount::class, 'user_id')->where('user_type', 'admin');
    }

    public function getUserAccountAttribute()
    {
        if ($this->user_type === DRIVER) {
            return $this->driverAccount;
        } elseif ($this->user_type === CUSTOMER) {
            return $this->customerAccount;
        }
        return $this->adminAccount;
    }

    public function customer(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function driver(){
        return $this->belongsTo(DeliveryMan::class, 'user_id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class, 'user_id');
    }

    public function getUserAttribute()
    {
        if ($this->user_type === DRIVER) {
            return $this->driver;
        } elseif ($this->user_type === CUSTOMER) {
            return $this->customer;
        }
        return $this->admin;
    }

    public function trip(): BelongsTo
    {
        return $this->belongsTo(RideRequest::class, 'attribute_id');
    }

    public function scopeTransactionType($query, $type)
    {
        return $query->where('attribute', $type);
    }

    public function scopeAccountType($query, $type)
    {
        return $query->where('account', $type);
    }
}
