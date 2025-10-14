<?php

namespace Modules\Service\Entities\BidModule;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostAdditionalInstruction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'details',
        'post_id'
    ];
    protected $table = 'service_post_additional_instructions';

    protected static function newFactory()
    {
        return \Modules\BidModule\Database\factories\PostAdditionalInstructionFactory::new();
    }
}
