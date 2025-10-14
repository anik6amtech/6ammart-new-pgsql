<?php

namespace Modules\Service\Entities\BidModule;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Service\Entities\ProviderManagement\Provider;

class PostBid extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'service_post_bids';

    protected static function newFactory()
    {
        return \Modules\BidModule\Database\factories\PostBidFactory::new();
    }

    /** Relations */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }
}
