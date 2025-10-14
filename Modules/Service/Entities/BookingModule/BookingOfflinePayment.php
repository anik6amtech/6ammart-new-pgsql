<?php

namespace Modules\Service\Entities\BookingModule;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingOfflinePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'offline_payment_id',
        'customer_information',
        'method_name',
        'payment_status',
        'denied_note',
    ];
    protected $casts = [
        'customer_information' => 'array',
    ];

    protected $table = 'service_booking_offline_payments';
}
