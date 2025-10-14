<?php

namespace Modules\Service\Entities\Review;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReviewReply extends Model
{
    use HasFactory;

    protected $table = 'service_review_replies';

    protected $fillable = [];
}
