<?php

namespace Modules\RideShare\Entities\BusinessManagement;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;


class CancellationReason extends Model
{
    use HasFactory;
    protected $table = 'ride_cancellation_reasons';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'cancellation_type',
        'user_type',
        'is_active'
    ];

    protected $casts = [
      'is_active' => 'boolean'
    ];

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
    }

    public function getTitleAttribute($value)
    {
        if (count($this->translations) > 0) {
            foreach ($this->translations as $translation) {
                if ($translation['key'] == 'title') {
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
