<?php

namespace Modules\RideShare\Broadcasting;


class CustomerTripRequestChannel
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
    public function join($user, $id): array|bool
    {
        info("customer trip request channel");
        return $user->id == $id;
    }
}
