<?php

namespace Modules\Service\Entities\ServiceManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecentView extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'service_recent_views';

    protected $casts = [
        'total_service_view' => 'integer',
        'total_category_view' => 'integer',
        'total_sub_category_view' => 'integer'
    ];

    protected $fillable = [
        'user_id',
        'service_id',
        'total_service_view',
        'category_id',
        'total_category_view',
        'sub_category_id',
        'total_sub_category_view',
        'module_id'
    ];

    public function scopeModule($query, $module_id)
    {
        return $query->where('module_id', $module_id);
    }

}
