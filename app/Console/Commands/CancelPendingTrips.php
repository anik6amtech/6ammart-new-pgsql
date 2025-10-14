<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\RideShare\Entities\TripManagement\RideRequest;
use Modules\RideShare\Entities\TripManagement\TempRideNotification;
use Modules\RideShare\Events\CustomerTripCancelledEvent;
use Modules\RideShare\Events\DriverTripCancelledEvent;
use Modules\RideShare\Jobs\SendPushNotificationJob;

class CancelPendingTrips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trip-request:cancel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Cancel Pending Trip after certain period';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $activeMinutes = now()->subMinutes(get_cache('ride_request_active_time') ?? 10);
        $pendingTripRequests = RideRequest::whereIn('current_status', [PENDING])
            ->where('updated_at', '<', $activeMinutes)
            ->get();
        foreach ($pendingTripRequests as $pendingTripRequest) {
            $data = TempRideNotification::where('ride_request_id', $pendingTripRequest->id)->get();
            $push = getNotification('driver_trip_request_canceled');
            sendDeviceNotification(fcm_token: $pendingTripRequest->customer->cm_firebase_token,
                title: translate($push['title']),
                description: translate(textVariableDataFormat(value: $push['description'])),
                status: $push['status'],
                ride_request_id: $pendingTripRequest->id,
                type: $pendingTripRequest->type,
                action: $push['action'],
                user_id: $pendingTripRequest->customer->id
            );

            try {
                info("driver trip cancelled event fired");
                checkPusherConnection(DriverTripCancelledEvent::broadcast($pendingTripRequest));
            } catch (\Exception $exception) {
                info("driver trip cancelled event error: ".$exception->getMessage());
            }
            
            if (!empty($data)) {
                $notification = [
                    'title' => translate($push['title']),
                    'description' => translate($push['description']),
                    'status' => $push['status'],
                    'ride_request_id' => $pendingTripRequest->id,
                    'type' => $pendingTripRequest->type,
                    'action' => $push['action']
                ];
                dispatch(new SendPushNotificationJob($notification, $data))->onQueue('high');

                foreach ($data as $tempNotification) {
                    try {
                        info("customer trip cancelled event fired");
                        checkPusherConnection(CustomerTripCancelledEvent::broadcast($tempNotification->user, $pendingTripRequest));
                    } catch (\Exception $exception) {
                        info("customer trip cancelled event error: ".$exception->getMessage());

                    }
                }

                TempRideNotification::where('ride_request_id', $pendingTripRequest->id)->delete();
                // checkPusherConnection(CustomerTripCancelledEvent::broadcast($pendingTripRequest->customer, $pendingTripRequest));
            }
        }
        RideRequest::whereIn('current_status', [PENDING])
            ->where('updated_at', '<', $activeMinutes)->update([
                'current_status' => 'cancelled',
            ]);
        $this->info('Pending Trips cancelled successfully on ' . now() . ' for before ' . $activeMinutes . ' time' );
    }
}
