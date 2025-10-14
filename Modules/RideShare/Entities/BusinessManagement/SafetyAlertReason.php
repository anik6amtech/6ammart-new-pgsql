<?php

namespace Modules\RideShare\Entities\BusinessManagement;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class SafetyAlertReason extends Model
{
    use HasFactory;

    protected $table = 'ride_safety_alert_reasons';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'reason',
        'reason_for_whom',
        'is_active'
    ];

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
    }

    public function getReasonAttribute($value)
    {
        if (count($this->translations) > 0) {
            foreach ($this->translations as $translation) {
                if ($translation['key'] == 'reason') {
                    return $translation['value'];
                }
            }
        }

        return $value;
    }

    protected static function booted()
    {
        static::addGlobalScope('translate', function (Builder $builder) {
            $builder->with(['translations' => function ($query) {
                return $query->where('locale', app()->getLocale());
            }]);
        });
    }
}
