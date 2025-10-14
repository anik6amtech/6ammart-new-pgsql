<?php

namespace Modules\Service\Entities\BookingModule;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ProviderManagement\Serviceman;

class BookingScheduleHistory extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'service_booking_schedule_histories';


    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }

    public function provider(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Provider::class, 'changed_by');
    }
    public function serviceman(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Serviceman::class, 'changed_by');
    }
}
