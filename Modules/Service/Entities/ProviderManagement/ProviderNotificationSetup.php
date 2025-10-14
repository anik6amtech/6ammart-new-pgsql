<?php

namespace Modules\Service\Entities\ProviderManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderNotificationSetup extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [];

    protected $table = 'service_provider_notification_setups';

}
