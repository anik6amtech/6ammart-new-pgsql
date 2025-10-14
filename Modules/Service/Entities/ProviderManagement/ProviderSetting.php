<?php

namespace Modules\Service\Entities\ProviderManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProviderSetting extends Model
{
    use HasFactory;

    protected $table = 'service_provider_settings';

    protected $casts = [
        'value'=>'array',
        'is_active'=>'integer',
    ];

    protected $fillable = ['key', 'provider_id', 'value', 'type', 'is_active'];

}
