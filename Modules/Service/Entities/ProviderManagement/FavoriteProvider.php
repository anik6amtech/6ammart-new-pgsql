<?php

namespace Modules\Service\Entities\ProviderManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FavoriteProvider extends Model
{
    use HasFactory;

    protected $table = 'service_favorite_providers';

    protected $fillable = [];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id', 'id');
    }

    public function scopeModule($query, $module_id)
    {
        return $query->where('module_id', $module_id);
    }
}
