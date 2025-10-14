<?php

namespace Modules\Service\Entities\BookingModule;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Service\Entities\ServiceManagement\Service;

class BookingRepeatDetails extends Model
{
    use HasFactory;
    protected $table = 'service_booking_repeat_details';

    protected $fillable = [];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function repeat(): BelongsTo
    {
        return $this->belongsTo(BookingRepeat::class, 'booking_repeat_id');
    }
}
