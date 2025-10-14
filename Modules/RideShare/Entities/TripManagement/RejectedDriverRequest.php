<?php

namespace Modules\RideShare\Entities\TripManagement;

use App\Models\DeliveryMan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RejectedDriverRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'ride_request_id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(DeliveryMan::class, 'user_id');
    }


}
