<?php

namespace Modules\Service\Entities\ServiceManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory;
    
    protected $table = 'service_faqs';

    protected $casts = [
        'is_active' => 'integer'
    ];

    protected $fillable = [];

    protected function scopeOfStatus($query, $status)
    {
        $query->where('is_active', $status);
    }
}
