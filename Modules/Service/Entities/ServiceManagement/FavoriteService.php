<?php

namespace Modules\Service\Entities\ServiceManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FavoriteService extends Model
{
    use HasFactory;

    protected $table = 'service_favorite_services';

    protected $fillable = [];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id','id');
    }
    
    public function scopeModule($query, $module_id)
    {
        return $query->where('module_id', $module_id);
    }
}
