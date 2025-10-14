<?php

namespace Modules\Service\Entities\ServiceManagement;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitedService extends Model
{
    use HasFactory;

    protected $table = 'service_visited_services';

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
}
