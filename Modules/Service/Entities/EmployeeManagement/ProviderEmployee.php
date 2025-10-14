<?php

namespace Modules\Service\Entities\EmployeeManagement;

use App\CentralLogics\Helpers;
use App\Models\Storage;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Modules\Service\Entities\ProviderManagement\Provider;

class ProviderEmployee extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['remember_token'];

    protected $casts = [
        'provider_role_id' => 'integer',
        'provider_id' => 'integer',
        // 'status' => 'integer',
        'is_logged_in' => 'boolean',
    ];

    protected $hidden = [
        'password',
        'auth_token',
        'remember_token',
    ];
    protected $appends = ['image_full_url'];
    public function getImageFullUrlAttribute(){
        $value = $this->image;
        if (count($this->storage) > 0) {
            foreach ($this->storage as $storage) {
                if ($storage['key'] == 'image') {
                    return Helpers::get_full_url('provider',$value,$storage['value']);
                }
            }
        }

        return Helpers::get_full_url('provider',$value,'public');
    }
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function role(){
        return $this->belongsTo(ProviderRole::class,'provider_role_id');
    }

    public function storage()
    {
        return $this->morphMany(Storage::class, 'data');
    }

    protected static function booted()
    {
        static::addGlobalScope('storage', function ($builder) {
            $builder->with('storage');
        });
    }

    protected static function boot()
    {
        parent::boot();
        static::saved(function ($model) {
            if($model->isDirty('image')){
                $value = Helpers::getDisk();

                DB::table('storages')->updateOrInsert([
                    'data_type' => get_class($model),
                    'data_id' => $model->id,
                    'key' => 'image',
                ], [
                    'value' => $value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });
    }
}
