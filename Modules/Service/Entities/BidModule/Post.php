<?php

namespace Modules\Service\Entities\BidModule;

use App\Models\CustomerAddress;
use App\Models\User;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\BidModule\Entities\IgnoredPost;
use Modules\Service\Entities\BookingModule\Booking;
use Modules\Service\Entities\CategoryManagement\Category;
use Modules\Service\Entities\ServiceManagement\Service;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'service_posts';

    protected static function newFactory()
    {
        return \Modules\BidModule\Database\factories\PostFactory::new();
    }

    /** Relations */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function sub_category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'sub_category_id')->withoutGlobalScopes();
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bids(): HasMany
    {
        return $this->hasMany(PostBid::class, 'post_id', 'id');
    }

    public function addition_instructions(): HasMany
    {
        return $this->hasMany(PostAdditionalInstruction::class, 'post_id', 'id');
    }

    public function postDeleteNote(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(PostAdditionalInformation::class, 'post_id')->where('key', 'post_delete_note');
    }

    public function ignored_posts(): HasMany
    {
        return $this->hasMany(IgnoredPost::class, 'post_id', 'id');
    }

    public function service_address(): BelongsTo
    {
        return $this->belongsTo(CustomerAddress::class, 'service_address_id');
    }
}
