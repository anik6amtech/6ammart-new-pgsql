<?php

namespace Modules\Service\Entities\ServiceManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ServiceTag extends Pivot
{
    use HasFactory;

    protected $table = 'service_tags';

    protected $fillable = ['id','service_id', 'tag_id'];
}
