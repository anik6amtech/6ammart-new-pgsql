<?php

namespace Modules\Service\Entities\BookingModule;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingAdditionalInformation extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $table = 'service_booking_additional_information';

}
