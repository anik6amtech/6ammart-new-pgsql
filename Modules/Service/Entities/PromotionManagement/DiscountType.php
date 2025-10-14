<?php

namespace Modules\Service\Entities\PromotionManagement;

use App\Models\Zone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Service\Entities\CategoryManagement\Category;
use Modules\Service\Entities\ServiceManagement\Service;

class DiscountType extends Model
{
    use HasFactory;

    protected $table = 'service_discount_types';

    protected $fillable = ['discount_id', 'discount_type', 'type_wise_id'];

    public function service(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Service::class, 'type_wise_id');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'type_wise_id');
    }

    public function zone(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Zone::class, 'type_wise_id');
    }

    public function discount(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Discount::class, 'discount_id');
    }

}
