<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Mail;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Mail\BusinessSettingsModule\CashInHandOverflowMail;
use Modules\Service\Mail\ProviderModule\AccountUnsuspendMail;

class UserAccount extends Model
{
    use HasFactory;

    protected $table = 'ride_user_accounts';

    protected $fillable = [
        'user_id',
        'user_type',
        'payable_balance',
        'receivable_balance',
        'received_balance',
        'pending_balance',
        'wallet_balance',
        'total_withdrawn',
        'referral_earn',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'payable_balance' => 'float',
        'receivable_balance' => 'float',
        'received_balance' => 'float',
        'pending_balance' => 'float',
        'wallet_balance' => 'float',
        'total_withdrawn' => 'float',
        'referral_earn' => 'float',
    ];

    public function customer(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function driver(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class, 'user_id','id');
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

    public function scopeAdminAccount($query)
    {
        return $query->where('user_id', Admin::query()->firstWhere('role_id', '1')->id);
    }

    public static function boot()
    {
        parent::boot();

        self::updated(function ($model) {
            if($model->user_type == PROVIDER) {
                if ($model->isDirty('payable_balance') || $model->isDirty('receivable_balance')) {
                    $limit_status = provider_warning_amount_calculate($model->payable_balance, $model->receivable_balance);
                    $provider = Provider::where('id', $model->user_id)->first();
                    $emailStatus = business_config('email_config_status')->value ?? 0;

                    if ($limit_status == '100_percent') {
                        if ($provider && !$provider->is_suspended) {
                            $provider->is_suspended = 1;
                            $provider->save();

                            // if ($emailStatus){
                                try {
                                    Mail::to($provider?->email)->send(new CashInHandOverflowMail($provider));
                                } catch (\Exception $exception) {
                                    info("Info from UserAccount.php Model boot -> updated1");
                                    info($exception);
                                }
                            // }
                        }
                    }else{
                        if ($provider && $provider->is_suspended) {
                            $provider->is_suspended = 0;
                            $provider->save();

                            // if ($emailStatus){
                                try {
                                    Mail::to($provider?->email)->send(new AccountUnsuspendMail($provider));
                                } catch (\Exception $exception) {
                                    info("Info from UserAccount.php Model boot -> updated2");
                                    info($exception);
                                }
                            // }
                        }
                    }
                }
            }
        });
    }
}
