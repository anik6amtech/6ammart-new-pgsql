<?php

namespace Modules\Service\Entities\BidModule;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostAdditionalInformation extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'service_post_additional_information';

    protected static function newFactory()
    {
        return \Modules\BidModule\Database\factories\PostAdditionalInformationFactory::new();
    }
}
