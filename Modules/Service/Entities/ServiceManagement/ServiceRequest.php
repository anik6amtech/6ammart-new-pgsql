<?php

namespace Modules\Service\Entities\ServiceManagement;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Service\Entities\CategoryManagement\Category;
use Modules\Service\Entities\ProviderManagement\Provider;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $table = 'service_service_requests';

    protected $fillable = ['category_id', 'service_name', 'service_description', 'status', 'user_id', 'module_id', 'type'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function provider(): BelongsTo
    {
        return $this->belongsTo(PROVIDER::class, 'user_id', 'id');
    }


    public function scopeOfStatus($query, $status)
    {
        $query->where('status', '=', $status);
    }

    public function scopeModule($query, $module_id)
    {
        return $query->where('module_id', $module_id);
    }
}
