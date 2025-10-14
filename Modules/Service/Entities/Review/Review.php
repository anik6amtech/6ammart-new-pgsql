<?php

namespace Modules\Service\Entities\Review;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Service\Entities\BookingModule\Booking;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ServiceManagement\Service;

class Review extends Model
{
    use HasFactory;

    protected $table = 'service_reviews';

    protected $casts = [
        'review_rating' => 'integer',
        'review_images' => 'array',
        'is_active' => 'integer',
    ];

    protected $fillable = [];

    public function booking(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function provider(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function service(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'customer_id');
    }

    public function reviewReply(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ReviewReply::class,'review_id');
    }

    protected function scopeOfStatus($query, $status)
    {
        $query->where('is_active', $status);
    }
    public function scopeModule($query, $module_id)
    {
        return $query->where('module_id', $module_id);
    }
}
