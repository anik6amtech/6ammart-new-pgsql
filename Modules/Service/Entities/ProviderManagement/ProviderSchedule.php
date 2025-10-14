<?php

namespace Modules\Service\Entities\ProviderManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProviderSchedule extends Model
{
    use HasFactory;

    protected $table = 'service_provider_schedules';

    protected $casts = [
        'day'=>'integer',
        'service_provider_id'=>'integer',
    ];

    protected $fillable = ['service_provider_id','day','opening_time','closing_time'];

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'service_provider_id', 'id');
    }
}
