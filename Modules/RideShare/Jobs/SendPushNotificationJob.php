<?php

namespace Modules\RideShare\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\RideShare\Entities\TripManagement\TempRideNotification;

class SendPushNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        protected $notification,
        protected $notify = null,
        protected $user_type = 'customer'
        )
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->notify) {
            foreach ($this->notify as $user) {
                if (get_class($user) == TempRideNotification::class) {
                    if($user->user_type == DRIVER) {
                        $this->user_type = DRIVER;
                    } else {
                        $this->user_type = 'customer';
                    }
                }
                if($this->user_type == 'customer'){
                    if ($user->user?->is_active) {
                        sendDeviceNotification(
                            fcm_token: $user->user->cm_firebase_token,
                            title: $this->notification['title'],
                            description: $this->notification['description'],
                            status: $this->notification['status'],
                            image: $this->notification['image']?? null,
                            ride_request_id: $this->notification['ride_request_id'] ?? null,
                            type: $this->notification['type'] ?? null,
                            action: $this->notification['action']?? null,
                            user_id: $user->user->id ?? null,
                        );
                    }
                }else{
                    if ($user->driver?->status) {
                        sendDeviceNotification(
                            fcm_token: $user->driver->fcm_token,
                            title: $this->notification['title'],
                            description: $this->notification['description'],
                            status: $this->notification['status'],
                            image: $this->notification['image']?? null,
                            ride_request_id: $this->notification['ride_request_id'] ?? null,
                            type: $this->notification['type'] ?? null,
                            action: $this->notification['action']?? null,
                            user_id: $user->driver->id ?? null,
                        );
                    }
                }
            }
        }
        else {
            foreach ($this->notification['user'] as $user) {
                sendDeviceNotification(
                    fcm_token: $user['fcm_token'],
                    title: $this->notification['title'],
                    description: $this->notification['description'],
                    status: $this->notification['status'],
                    image: $this->notification['image']?? null,
                    ride_request_id: $this->notification['ride_request_id'] ?? null,
                    type: $this->notification['type'] ?? null,
                    action: $this->notification['action']?? null,
                    user_id: $user['user_id']?? null,
                );
            }
        }

    }
}
