<?php

namespace Modules\Service\Entities\BookingModule;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingIgnore extends Model
{
    use HasFactory;

    protected $table = 'service_booking_ignores';
    protected $fillable = [];

}
