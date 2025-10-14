<?php

use Modules\RideShare\Entities\TripManagement\RideRequest;
use Modules\RideShare\Events\CustomerTripPaymentSuccessfulEvent;
use Modules\RideShare\Traits\TransactionManagement\TransactionTrait;

if (!function_exists('tripRequestUpdate'))
{
    function tripRequestUpdate($data)
    {
        $trip = RideRequest::query()
            ->with(['driver', 'customer'])
            ->find($data->attribute_id);
        if($data->is_paid == '0'){
            return $trip;
        }
        $trip->paid_fare = ($trip->paid_fare +$trip->tips);
        $trip->payment_status = PAID;
        $trip->save();
        $push = getNotification('customer_payment_successful');
        
        sendDeviceNotification(
            fcm_token: $trip->driver->fcm_token,
            title: translate($push['title']),
            description: translate(textVariableDataFormat(value: $push['description'],paidAmount: $trip->paid_fare,methodName: $trip->payment_method)),
            status: $push['status'],
            ride_request_id: $trip->id,
            type: $trip->type,
            action: $push['action'],
            user_id: $trip->driver->id
        );
        if ($trip->tips > 0)
        {
            $pushTips = getNotification('tips_from_customer');
            sendDeviceNotification(
                fcm_token: $trip->driver->fcm_token,
                title: translate($pushTips['title']),
                description: translate(textVariableDataFormat(value: $pushTips['description'],tipsAmount: $trip->tips)),
                status: $push['status'],
                ride_request_id: $trip->id,
                type: $trip->type,
                action: $push['action'],
                user_id: $trip->driver->id
            );
        }
        if (!empty($trip)) {
            try {
                event(checkPusherConnection(CustomerTripPaymentSuccessfulEvent::broadcast($trip)));
            }catch(Exception $exception){

            }
        }

        (new class {
            use TransactionTrait;
        })->digitalPaymentTransaction($trip);

        return $trip;
    }
}
