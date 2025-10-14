<?php

namespace Modules\Service\Entities\BookingModule;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Service\Entities\ServiceManagement\Service;
use Modules\Service\Entities\ServiceManagement\Variation;

class BookingDetail extends Model
{
    use HasFactory;
    protected $table = 'service_booking_details';

    protected $casts = [
        'quantity' => 'integer',
        'service_cost' => 'float',
        'discount_amount' => 'float',
        'tax_amount' => 'float',
        'total_cost' => 'float',
        'campaign_discount_amount' => 'float',
        'overall_coupon_discount_amount' => 'float',
    ];

    protected $fillable = [];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function variation(): BelongsTo
    {
        return $this->belongsTo(Variation::class, 'variant_key', 'variant_key');
    }

}
