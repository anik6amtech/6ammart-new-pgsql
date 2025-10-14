<?php

namespace Modules\Service\Entities\ServiceManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecentSearch extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'service_recent_searches';

    protected $casts = [];

    protected $fillable = [
        'user_id',
        'keyword',
        'module_id',
    ];

    public function response_data_count()
    {
        return $this->hasOne(SearchedData::class, 'attribute_id');
    }

    public function volume()
    {
        return $this->hasOne(SearchedData::class, 'attribute_id');
    }

    public function scopeModule($query, $module_id)
    {
        return $query->where('module_id', $module_id);
    }
}
