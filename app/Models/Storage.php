<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast;

class Storage extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'data_type',
        'data_id',
        'value'
    ];
    protected $casts = [
        'data_type' => 'string',
        'data_id' => 'integer',
        'value' => 'string',
    ];

    public function data()
    {
        return $this->morphTo();
    }
}
