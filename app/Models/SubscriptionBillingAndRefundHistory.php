<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class SubscriptionBillingAndRefundHistory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected static function booted()
    {
        $moduleId = config('module.current_module_id');
        if($moduleId == null) {
            $moduleData = config('module.current_module_data');
            $moduleType = ($moduleData['module_type'] ?? '') == 'service' ? 'service' : 'default';
        } else {
            $module = Module::find($moduleId);
            $moduleType = $module->module_type;
        }

        static::addGlobalScope('module_type', function (Builder $builder) use ($moduleType) {
            $builder->where('module_type', $moduleType);
        });
    }

    public function package()
    {
        return $this->belongsTo(SubscriptionPackage::class);
    }

    public function storeSubscription()
    {
        return $this->belongsTo(StoreSubscription::class, 'subscription_id');
    }
}
