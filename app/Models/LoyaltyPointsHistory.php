<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoyaltyPointsHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_type',
        'model',
        'model_id',
        'points',
        'type',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'points'=>'double'
    ];
}
