<?php

namespace Modules\RideShare\Broadcasting;

use App\Models\User;

class NewMessageChannel
{

    /**
     * Create a new channel instance.
     */
    public function __construct()
    {


    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join($user): array|bool
    {
        info("message.{$user->id}", [$user->email]);
        return true;
    }
}
