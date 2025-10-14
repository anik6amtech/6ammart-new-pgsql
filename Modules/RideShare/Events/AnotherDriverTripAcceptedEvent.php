<?php

namespace Modules\RideShare\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\RideShare\Entities\TripManagement\RideRequest;

class AnotherDriverTripAcceptedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $tripRequest;
    public $user_type = 'driver';
    /**
     * Create a new event instance.
     */
    public function __construct($user, RideRequest $tripRequest)
    {
        $this->user = $user;
        $this->tripRequest = $tripRequest;
        if(get_class($user) == User::class){
            $this->user_type = 'customer';
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("another-driver-trip-accepted.{$this->tripRequest->id}.{$this->user->id}"),
        ];
    }

    public function broadcastAs()
    {
        return "another-driver-trip-accepted.{$this->tripRequest->id}.{$this->user->id}";
    }

    public function broadcastWith()
    {
        return [
            'id'=>$this->user->id,
            'trip_id'=>$this->tripRequest->id,
            'user_type'=> $this->user_type,
        ];
    }
}
