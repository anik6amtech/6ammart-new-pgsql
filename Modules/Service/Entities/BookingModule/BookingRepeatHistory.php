<?php

namespace Modules\Service\Entities\BookingModule;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingRepeatHistory extends Model
{
    use HasFactory;

    protected $table = 'service_booking_repeat_histories';

    protected $fillable = [];

    public function repeat(): BelongsTo
    {
        return $this->belongsTo(BookingRepeat::class, 'booking_repeat_id');
    }
}
