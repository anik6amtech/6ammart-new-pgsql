<?php

namespace Modules\RideShare\Entities\UserManagement;

use App\Enums\ExportFileNames\Admin\DeliveryMan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiderTimeLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'rider_id',
        'date',
        'online',
        'offline',
        'online_time',
        'accepted',
        'completed',
        'start_driving',
        'on_driving_time',
        'idle_time',
        'on_time_completed',
        'late_completed',
        'late_pickup',
        'created_at',
        'updated_at',
    ];

    protected $casts =[
        "online_time" => "float",
        "idle_time" => "float",
        "on_driving_time" => "float",
    ];

    public function driver()
    {
        return $this->belongsTo(DeliveryMan::class, 'rider_id');
    }
}
