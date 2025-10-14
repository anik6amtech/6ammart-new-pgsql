<?php

namespace Modules\RideShare\Broadcasting;

use Modules\RideShare\Entities\TripManagement\TempRideNotification;

class AnotherDriverTripAcceptedChannel
{
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join($user, $id , $userId): array|bool
    {
        return $user->id == $userId && $user->id == TempRideNotification::where(['ride_request_id'=>$id,'user_id'=>$userId, 'user_type' => DRIVER])->first()->user_id;
    }
}
