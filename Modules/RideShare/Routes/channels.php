<?php

use Illuminate\Support\Facades\Broadcast;
use Modules\RideShare\Broadcasting\AnotherDriverTripAcceptedChannel;
use Modules\RideShare\Broadcasting\CustomerCouponAppliedChannel;
use Modules\RideShare\Broadcasting\CustomerCouponRemovedChannel;
use Modules\RideShare\Broadcasting\CustomerRideChatChannel;
use Modules\RideShare\Broadcasting\CustomerTripCanceledAfterOngoingChannel;
use Modules\RideShare\Broadcasting\CustomerTripCanceledChannel;
use Modules\RideShare\Broadcasting\CustomerTripPaymentSuccessfulChannel;
use Modules\RideShare\Broadcasting\CustomerTripRequestChannel;
use Modules\RideShare\Broadcasting\DriverPaymentReceivedChannel;
use Modules\RideShare\Broadcasting\DriverRideChatChannel;
use Modules\RideShare\Broadcasting\DriverTripAcceptedChannel;
use Modules\RideShare\Broadcasting\DriverTripCancelledChannel;
use Modules\RideShare\Broadcasting\DriverTripCompletedChannel;
use Modules\RideShare\Broadcasting\DriverTripStartedChannel;
use Modules\RideShare\Broadcasting\NewMessageChannel;
use Modules\RideShare\Broadcasting\RideChatChannel;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('ride-request.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('message', NewMessageChannel::class);
#for customer app
// Broadcast::channel('customer-ride-chat.{id}',CustomerRideChatChannel::class);
// Broadcast::channel('ride-chat.{id}',RideChatChannel::class);
Broadcast::channel('driver-trip-accepted.{id}',DriverTripAcceptedChannel::class);
Broadcast::channel('driver-trip-started.{id}',DriverTripStartedChannel::class);
Broadcast::channel('driver-trip-cancelled.{id}',DriverTripCancelledChannel::class);
Broadcast::channel('driver-trip-completed.{id}',DriverTripCompletedChannel::class);
Broadcast::channel('driver-payment-received.{id}',DriverPaymentReceivedChannel::class);


#for driver app
// Broadcast::channel('driver-ride-chat.{id}',DriverRideChatChannel::class);
Broadcast::channel('another-driver-trip-accepted.{id}.{userId}',AnotherDriverTripAcceptedChannel::class);
Broadcast::channel('customer-trip-cancelled-after-ongoing.{id}',CustomerTripCanceledAfterOngoingChannel::class);
Broadcast::channel('customer-trip-cancelled.{id}.{userId}',CustomerTripCanceledChannel::class);
Broadcast::channel('customer-coupon-applied.{id}',CustomerCouponAppliedChannel::class);
Broadcast::channel('customer-coupon-removed.{id}',CustomerCouponRemovedChannel::class);
Broadcast::channel('customer-trip-request.{id}',CustomerTripRequestChannel::class);
Broadcast::channel('customer-trip-payment-successful.{id}',CustomerTripPaymentSuccessfulChannel::class);

Broadcast::channel('store-driver-last-location', function ($user) {
    info("data");
    return true;
});

Broadcast::channel('chat-sample', function () {
    return true;
});

//Broadcast::channel('driver-chat-with-admin')
