<?php

namespace Modules\RideShare\Broadcasting;

use Modules\RideShare\Entities\TripManagement\RideRequest;

class DriverRideChatChannel
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
    public function join($user,$id): array|bool
    {
        return $user->id == RideRequest::find($id)->driver_id;
    }
}
