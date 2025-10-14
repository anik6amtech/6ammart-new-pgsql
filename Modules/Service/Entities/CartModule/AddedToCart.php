<?php

namespace Modules\Service\Entities\CartModule;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Service\Entities\ServiceManagement\Service;

class AddedToCart extends Model
{
    use HasFactory;
    protected $table = 'service_added_to_carts';

    protected $casts = [
        'count' => 'integer',
    ];

    protected $fillable = ['user_id', 'service_id', 'count'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function scopeModule($query, $module_id)
    {
        return $query->where('module_id', $module_id);
    }
}
