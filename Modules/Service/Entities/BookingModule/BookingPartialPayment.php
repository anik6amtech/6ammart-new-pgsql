<?php

namespace Modules\Service\Entities\BookingModule;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingPartialPayment extends Model
{
    use HasFactory;
    protected $table = 'service_booking_partial_payments';

    protected $fillable = [
        'module_id',
        'booking_id',
        'paid_with',
        'paid_amount',
        'due_amount',
    ];
}
