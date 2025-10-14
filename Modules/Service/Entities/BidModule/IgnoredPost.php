<?php

namespace Modules\Service\Entities\BidModule;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IgnoredPost extends Model
{
    use HasFactory;

    protected $table = 'service_ignored_posts';

    protected $fillable = ['post_id', 'provider_id'];

    protected static function newFactory()
    {
        return \Modules\BidModule\Database\factories\IgnoredPostFactory::new();
    }
}
