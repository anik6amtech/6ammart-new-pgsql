<?php

namespace Modules\Service\Entities\BookingModule;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ProviderManagement\Serviceman;

class BookingStatusHistory extends Model
{
    use HasFactory;

    protected $table = 'service_booking_status_histories';

    protected $fillable = ['booking_id','changed_by','booking_status','is_guest','booking_repeat_id'];

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
