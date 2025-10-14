<?php

namespace Modules\Service\Entities\ServiceManagement;

use App\Models\User;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SearchedData extends Model
{
    use HasFactory;

    protected $table = 'service_searched_data';

    protected $casts = [
        'response_data_count' => 'integer',
        'volume' => 'integer',
    ];

    protected $fillable = ['user_id', 'attribute', 'attribute_id', 'response_data_count', 'volume', 'module_id', 'zone_id'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    public function searched_key()
    {
        return $this->belongsTo(RecentSearch::class, 'attribute_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'attribute_id');
    }
}
