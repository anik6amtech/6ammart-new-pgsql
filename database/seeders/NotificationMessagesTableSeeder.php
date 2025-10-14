<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationMessagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notification_messages')->delete();
        
        \DB::table('notification_messages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'module_type' => 'grocery',
                'key' => 'order_pending_message',
                'message' => '{userName}, Your  order {orderId} is successfully placed',
                'status' => 1,
                'created_at' => '2023-01-17 16:53:45',
                'updated_at' => '2023-06-12 18:33:40',
            ),
            1 => 
            array (
                'id' => 2,
                'module_type' => 'grocery',
                'key' => 'order_confirmation_msg',
                'message' => '{userName}, Your order {orderId} is confirmed',
                'status' => 1,
                'created_at' => '2023-01-17 16:53:45',
                'updated_at' => '2023-06-12 18:33:40',
            ),
            2 => 
            array (
                'id' => 3,
                'module_type' => 'grocery',
                'key' => 'order_processing_message',
                'message' => '{userName}, Your order is Processing by {storeName}',
                'status' => 1,
                'created_at' => '2023-01-17 16:53:45',
                'updated_at' => '2023-06-12 18:33:40',
            ),
            3 => 
            array (
                'id' => 4,
                'module_type' => 'grocery',
                'key' => 'order_handover_message',
                'message' => 'Delivery man is on the way. For this order {orderId}',
                'status' => 1,
                'created_at' => '2023-01-17 16:53:45',
                'updated_at' => '2023-06-12 18:33:40',
            ),
            4 => 
            array (
                'id' => 5,
                'module_type' => 'grocery',
                'key' => 'order_refunded_message',
                'message' => 'Order {orderId} Refunded successfully',
                'status' => 1,
                'created_at' => '2023-01-17 16:53:45',
                'updated_at' => '2023-06-12 18:33:40',
            ),
            5 => 
            array (
                'id' => 6,
                'module_type' => 'grocery',
                'key' => 'refund_request_canceled',
                'message' => 'Order {orderId}  Refund request is canceled',
                'status' => 1,
                'created_at' => '2023-01-17 16:53:45',
                'updated_at' => '2023-06-12 18:33:40',
            ),
            6 => 
            array (
                'id' => 7,
                'module_type' => 'grocery',
                'key' => 'out_for_delivery_message',
                'message' => '{userName}, Your order {orderId} is ready for delivery',
                'status' => 1,
                'created_at' => '2023-01-17 16:53:45',
                'updated_at' => '2023-06-12 18:33:41',
            ),
            7 => 
            array (
                'id' => 8,
                'module_type' => 'grocery',
                'key' => 'order_delivered_message',
                'message' => 'Your order {orderId} is delivered',
                'status' => 1,
                'created_at' => '2023-01-17 16:53:45',
                'updated_at' => '2023-06-12 18:33:41',
            ),
            8 => 
            array (
                'id' => 9,
                'module_type' => 'grocery',
                'key' => 'delivery_boy_assign_message',
                'message' => 'Your order {orderId} has been assigned to a delivery man',
                'status' => 1,
                'created_at' => '2023-01-17 16:53:45',
                'updated_at' => '2023-06-12 18:33:41',
            ),
            9 => 
            array (
                'id' => 10,
                'module_type' => 'grocery',
                'key' => 'delivery_boy_delivered_message',
                'message' => 'Order {orderId} delivered successfully',
                'status' => 1,
                'created_at' => '2023-01-17 16:53:45',
                'updated_at' => '2023-06-12 18:33:41',
            ),
            10 => 
            array (
                'id' => 11,
                'module_type' => 'grocery',
                'key' => 'order_cancled_message',
                'message' => 'Order {orderId} is canceled by your request',
                'status' => 1,
                'created_at' => '2023-01-17 16:53:45',
                'updated_at' => '2023-06-12 18:33:41',
            ),
            11 => 
            array (
                'id' => 12,
                'module_type' => 'food',
                'key' => 'order_pending_message',
                'message' => '{userName}, Your  order {orderId} is successfully placed',
                'status' => 1,
                'created_at' => '2023-01-17 16:56:00',
                'updated_at' => '2023-06-12 19:19:14',
            ),
            12 => 
            array (
                'id' => 13,
                'module_type' => 'food',
                'key' => 'order_confirmation_msg',
                'message' => '{userName}, Your order {orderId} is confirmed',
                'status' => 1,
                'created_at' => '2023-01-17 16:56:00',
                'updated_at' => '2023-06-12 19:19:14',
            ),
            13 => 
            array (
                'id' => 14,
                'module_type' => 'food',
                'key' => 'order_processing_message',
                'message' => '{userName}, Your food is started for cooking by {storeName}',
                'status' => 1,
                'created_at' => '2023-01-17 16:56:00',
                'updated_at' => '2023-06-12 19:19:14',
            ),
            14 => 
            array (
                'id' => 15,
                'module_type' => 'food',
                'key' => 'order_handover_message',
                'message' => 'Delivery man is on the way. For this order {orderId}',
                'status' => 1,
                'created_at' => '2023-01-17 16:56:00',
                'updated_at' => '2023-06-12 19:19:14',
            ),
            15 => 
            array (
                'id' => 16,
                'module_type' => 'food',
                'key' => 'order_refunded_message',
                'message' => 'Order {orderId} Refunded successfully',
                'status' => 1,
                'created_at' => '2023-01-17 16:56:00',
                'updated_at' => '2023-06-12 19:19:14',
            ),
            16 => 
            array (
                'id' => 17,
                'module_type' => 'food',
                'key' => 'refund_request_canceled',
                'message' => 'Order {orderId}  Refund request is canceled',
                'status' => 1,
                'created_at' => '2023-01-17 16:56:00',
                'updated_at' => '2023-06-12 19:19:14',
            ),
            17 => 
            array (
                'id' => 18,
                'module_type' => 'food',
                'key' => 'out_for_delivery_message',
                'message' => '{userName}, Your order {orderId}  is ready for delivery',
                'status' => 1,
                'created_at' => '2023-01-17 16:56:00',
                'updated_at' => '2023-06-12 19:19:14',
            ),
            18 => 
            array (
                'id' => 19,
                'module_type' => 'food',
                'key' => 'order_delivered_message',
                'message' => 'Your order {orderId} is delivered',
                'status' => 1,
                'created_at' => '2023-01-17 16:56:00',
                'updated_at' => '2023-06-12 19:19:15',
            ),
            19 => 
            array (
                'id' => 20,
                'module_type' => 'food',
                'key' => 'delivery_boy_assign_message',
                'message' => 'Your order {orderId} has been assigned to a delivery man',
                'status' => 1,
                'created_at' => '2023-01-17 16:56:00',
                'updated_at' => '2023-06-12 19:19:15',
            ),
            20 => 
            array (
                'id' => 21,
                'module_type' => 'food',
                'key' => 'delivery_boy_delivered_message',
                'message' => 'Order {orderId} delivered successfully',
                'status' => 1,
                'created_at' => '2023-01-17 16:56:00',
                'updated_at' => '2023-06-12 19:19:15',
            ),
            21 => 
            array (
                'id' => 22,
                'module_type' => 'food',
                'key' => 'order_cancled_message',
                'message' => 'Order {orderId} is canceled by your request',
                'status' => 1,
                'created_at' => '2023-01-17 16:56:00',
                'updated_at' => '2023-06-12 19:19:15',
            ),
            22 => 
            array (
                'id' => 23,
                'module_type' => 'pharmacy',
                'key' => 'order_pending_message',
                'message' => '{userName}, Your  order {orderId} is successfully placed',
                'status' => 1,
                'created_at' => '2023-01-17 16:57:46',
                'updated_at' => '2023-06-12 19:22:20',
            ),
            23 => 
            array (
                'id' => 24,
                'module_type' => 'pharmacy',
                'key' => 'order_confirmation_msg',
                'message' => '{userName}, Your order {orderId} is confirmed',
                'status' => 1,
                'created_at' => '2023-01-17 16:57:46',
                'updated_at' => '2023-06-12 19:22:20',
            ),
            24 => 
            array (
                'id' => 25,
                'module_type' => 'pharmacy',
                'key' => 'order_processing_message',
                'message' => '{userName}, Your order is Processing by {storeName}',
                'status' => 1,
                'created_at' => '2023-01-17 16:57:46',
                'updated_at' => '2023-06-12 19:22:20',
            ),
            25 => 
            array (
                'id' => 26,
                'module_type' => 'pharmacy',
                'key' => 'order_handover_message',
                'message' => 'Delivery man is on the way. For this order {orderId}',
                'status' => 1,
                'created_at' => '2023-01-17 16:57:46',
                'updated_at' => '2023-06-12 19:22:20',
            ),
            26 => 
            array (
                'id' => 27,
                'module_type' => 'pharmacy',
                'key' => 'order_refunded_message',
                'message' => 'Order {orderId} Refunded successfully',
                'status' => 1,
                'created_at' => '2023-01-17 16:57:46',
                'updated_at' => '2023-06-12 19:22:20',
            ),
            27 => 
            array (
                'id' => 28,
                'module_type' => 'pharmacy',
                'key' => 'refund_request_canceled',
                'message' => 'Order {orderId}  Refund request is canceled',
                'status' => 1,
                'created_at' => '2023-01-17 16:57:46',
                'updated_at' => '2023-06-12 19:22:20',
            ),
            28 => 
            array (
                'id' => 29,
                'module_type' => 'pharmacy',
                'key' => 'out_for_delivery_message',
                'message' => '{userName}, Your order {orderId} is ready for delivery',
                'status' => 1,
                'created_at' => '2023-01-17 16:57:46',
                'updated_at' => '2023-06-12 19:22:20',
            ),
            29 => 
            array (
                'id' => 30,
                'module_type' => 'pharmacy',
                'key' => 'order_delivered_message',
                'message' => 'Your order {orderId} is delivered',
                'status' => 1,
                'created_at' => '2023-01-17 16:57:46',
                'updated_at' => '2023-06-12 19:22:20',
            ),
            30 => 
            array (
                'id' => 31,
                'module_type' => 'pharmacy',
                'key' => 'delivery_boy_assign_message',
                'message' => 'Your order {orderId} has been assigned to a delivery man',
                'status' => 1,
                'created_at' => '2023-01-17 16:57:46',
                'updated_at' => '2023-06-12 19:22:20',
            ),
            31 => 
            array (
                'id' => 32,
                'module_type' => 'pharmacy',
                'key' => 'delivery_boy_delivered_message',
                'message' => 'Order {orderId} delivered successfully',
                'status' => 1,
                'created_at' => '2023-01-17 16:57:46',
                'updated_at' => '2023-06-12 19:22:20',
            ),
            32 => 
            array (
                'id' => 33,
                'module_type' => 'pharmacy',
                'key' => 'order_cancled_message',
                'message' => 'Order {orderId} is canceled by your request',
                'status' => 1,
                'created_at' => '2023-01-17 16:57:46',
                'updated_at' => '2023-06-12 19:22:20',
            ),
            33 => 
            array (
                'id' => 34,
                'module_type' => 'ecommerce',
                'key' => 'order_pending_message',
                'message' => '{userName}, Your  order {orderId} is successfully placed',
                'status' => 1,
                'created_at' => '2023-01-17 16:59:24',
                'updated_at' => '2023-06-12 19:25:02',
            ),
            34 => 
            array (
                'id' => 35,
                'module_type' => 'ecommerce',
                'key' => 'order_confirmation_msg',
                'message' => '{userName}, Your order {orderId} is confirmed',
                'status' => 1,
                'created_at' => '2023-01-17 16:59:24',
                'updated_at' => '2023-06-12 19:25:02',
            ),
            35 => 
            array (
                'id' => 36,
                'module_type' => 'ecommerce',
                'key' => 'order_processing_message',
                'message' => '{userName}, Your order is Processing by {storeName}',
                'status' => 1,
                'created_at' => '2023-01-17 16:59:24',
                'updated_at' => '2023-06-12 19:25:02',
            ),
            36 => 
            array (
                'id' => 37,
                'module_type' => 'ecommerce',
                'key' => 'order_handover_message',
                'message' => 'Delivery man is on the way. For this order {orderId}',
                'status' => 1,
                'created_at' => '2023-01-17 16:59:24',
                'updated_at' => '2023-06-12 19:25:02',
            ),
            37 => 
            array (
                'id' => 38,
                'module_type' => 'ecommerce',
                'key' => 'order_refunded_message',
                'message' => 'Order {orderId} Refunded successfully',
                'status' => 1,
                'created_at' => '2023-01-17 16:59:24',
                'updated_at' => '2023-06-12 19:25:02',
            ),
            38 => 
            array (
                'id' => 39,
                'module_type' => 'ecommerce',
                'key' => 'refund_request_canceled',
                'message' => 'Order {orderId}  Refund request is canceled',
                'status' => 1,
                'created_at' => '2023-01-17 16:59:24',
                'updated_at' => '2023-06-12 19:25:02',
            ),
            39 => 
            array (
                'id' => 40,
                'module_type' => 'ecommerce',
                'key' => 'out_for_delivery_message',
                'message' => '{userName}, Your order {orderId} is ready for delivery',
                'status' => 1,
                'created_at' => '2023-01-17 16:59:24',
                'updated_at' => '2023-06-12 19:25:02',
            ),
            40 => 
            array (
                'id' => 41,
                'module_type' => 'ecommerce',
                'key' => 'order_delivered_message',
                'message' => 'Your order {orderId} is delivered',
                'status' => 1,
                'created_at' => '2023-01-17 16:59:24',
                'updated_at' => '2023-06-12 19:25:02',
            ),
            41 => 
            array (
                'id' => 42,
                'module_type' => 'ecommerce',
                'key' => 'delivery_boy_assign_message',
                'message' => 'Your order {orderId} has been assigned to a delivery man',
                'status' => 1,
                'created_at' => '2023-01-17 16:59:24',
                'updated_at' => '2023-06-12 19:25:02',
            ),
            42 => 
            array (
                'id' => 43,
                'module_type' => 'ecommerce',
                'key' => 'delivery_boy_delivered_message',
                'message' => 'Order {orderId} delivered successfully',
                'status' => 1,
                'created_at' => '2023-01-17 16:59:24',
                'updated_at' => '2023-06-12 19:25:02',
            ),
            43 => 
            array (
                'id' => 44,
                'module_type' => 'ecommerce',
                'key' => 'order_cancled_message',
                'message' => 'Order {orderId} is canceled by your request',
                'status' => 1,
                'created_at' => '2023-01-17 16:59:24',
                'updated_at' => '2023-06-12 19:25:02',
            ),
            44 => 
            array (
                'id' => 45,
                'module_type' => 'parcel',
                'key' => 'order_pending_message',
                'message' => '{userName}, Your parcel order is successfully placed',
                'status' => 1,
                'created_at' => '2023-01-17 17:01:02',
                'updated_at' => '2023-06-12 19:29:42',
            ),
            45 => 
            array (
                'id' => 46,
                'module_type' => 'parcel',
                'key' => 'order_confirmation_msg',
                'message' => 'Your order {orderId} is confirmed',
                'status' => 1,
                'created_at' => '2023-01-17 17:01:02',
                'updated_at' => '2023-06-12 19:29:42',
            ),
            46 => 
            array (
                'id' => 47,
                'module_type' => 'parcel',
                'key' => 'out_for_delivery_message',
                'message' => 'Your parcel order  {orderId}  is ready for delivery',
                'status' => 1,
                'created_at' => '2023-01-17 17:01:02',
                'updated_at' => '2023-06-12 19:29:42',
            ),
            47 => 
            array (
                'id' => 48,
                'module_type' => 'parcel',
                'key' => 'order_delivered_message',
                'message' => 'Your parcel id  {orderId}  is delivered',
                'status' => 1,
                'created_at' => '2023-01-17 17:01:02',
                'updated_at' => '2023-06-12 19:29:42',
            ),
            48 => 
            array (
                'id' => 49,
                'module_type' => 'parcel',
                'key' => 'delivery_boy_assign_message',
                'message' => 'Your order {orderId}  has been assigned to a delivery man',
                'status' => 1,
                'created_at' => '2023-01-17 17:01:02',
                'updated_at' => '2023-06-12 19:29:42',
            ),
            49 => 
            array (
                'id' => 50,
                'module_type' => 'parcel',
                'key' => 'delivery_boy_delivered_message',
                'message' => 'parcel id  {orderId}  delivered successfully',
                'status' => 1,
                'created_at' => '2023-01-17 17:01:02',
                'updated_at' => '2023-06-12 19:29:42',
            ),
            50 => 
            array (
                'id' => 51,
                'module_type' => 'parcel',
                'key' => 'order_cancled_message',
                'message' => 'Order is canceled by your request',
                'status' => 1,
                'created_at' => '2023-01-17 17:01:02',
                'updated_at' => '2023-01-17 17:01:02',
            ),
            51 => 
            array (
                'id' => 52,
                'module_type' => 'rental',
                'key' => 'trip_pending_message',
                'message' => '{userName}, Your  trip {tripId} is successfully placed',
                'status' => 1,
                'created_at' => '2025-02-08 11:20:23',
                'updated_at' => '2025-02-08 11:20:23',
            ),
            52 => 
            array (
                'id' => 53,
                'module_type' => 'rental',
                'key' => 'trip_confirm_message',
                'message' => '{userName}, Your  trip {tripId} is successfully confirmed',
                'status' => 1,
                'created_at' => '2025-02-08 11:20:23',
                'updated_at' => '2025-02-08 11:20:23',
            ),
            53 => 
            array (
                'id' => 54,
                'module_type' => 'rental',
                'key' => 'trip_ongoing_message',
                'message' => '{userName}, Your  trip {tripId} is  Ongoing',
                'status' => 1,
                'created_at' => '2025-02-08 11:20:23',
                'updated_at' => '2025-02-08 11:20:23',
            ),
            54 => 
            array (
                'id' => 55,
                'module_type' => 'rental',
                'key' => 'trip_complete_message',
                'message' => '{userName}, Your  trip {tripId} is successfully completed',
                'status' => 1,
                'created_at' => '2025-02-08 11:20:23',
                'updated_at' => '2025-02-08 11:20:23',
            ),
            55 => 
            array (
                'id' => 56,
                'module_type' => 'rental',
                'key' => 'trip_cancel_message',
                'message' => '{userName}, Your  trip {tripId} is cancelled',
                'status' => 1,
                'created_at' => '2025-02-08 11:20:23',
                'updated_at' => '2025-02-08 11:20:23',
            ),
            56 => 
            array (
                'id' => 57,
                'module_type' => 'ride-share',
                'key' => 'customer_trip_started',
            'message' => 'Trip Started (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:42',
                'updated_at' => '2025-09-08 05:27:42',
            ),
            57 => 
            array (
                'id' => 58,
                'module_type' => 'ride-share',
                'key' => 'customer_trip_completed',
            'message' => 'Trip Completed (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:42',
                'updated_at' => '2025-09-08 05:27:42',
            ),
            58 => 
            array (
                'id' => 59,
                'module_type' => 'ride-share',
                'key' => 'customer_trip_canceled',
            'message' => 'Trip Canceled (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:42',
                'updated_at' => '2025-09-08 05:27:42',
            ),
            59 => 
            array (
                'id' => 60,
                'module_type' => 'ride-share',
                'key' => 'customer_trip_paused',
            'message' => 'Trip Paused (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:42',
                'updated_at' => '2025-09-08 05:27:42',
            ),
            60 => 
            array (
                'id' => 61,
                'module_type' => 'ride-share',
                'key' => 'customer_trip_resumed',
            'message' => 'Trip Resumed (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:42',
                'updated_at' => '2025-09-08 05:27:42',
            ),
            61 => 
            array (
                'id' => 62,
                'module_type' => 'ride-share',
                'key' => 'customer_another_driver_assigned',
            'message' => 'Another Driver Assigned (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:42',
                'updated_at' => '2025-09-08 05:27:42',
            ),
            62 => 
            array (
                'id' => 63,
                'module_type' => 'ride-share',
                'key' => 'customer_driver_on_the_way',
            'message' => 'Driver On The Way (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:42',
                'updated_at' => '2025-09-08 05:27:42',
            ),
            63 => 
            array (
                'id' => 64,
                'module_type' => 'ride-share',
                'key' => 'customer_bid_request_from_driver',
            'message' => 'Bid Request From Driver (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:42',
                'updated_at' => '2025-09-08 05:27:42',
            ),
            64 => 
            array (
                'id' => 65,
                'module_type' => 'ride-share',
                'key' => 'customer_driver_canceled_ride_request',
            'message' => 'Driver Canceled Ride Request (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:42',
                'updated_at' => '2025-09-08 05:27:42',
            ),
            65 => 
            array (
                'id' => 66,
                'module_type' => 'ride-share',
                'key' => 'customer_payment_successful',
            'message' => 'Payment Successful (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:42',
                'updated_at' => '2025-09-08 05:27:42',
            ),
            66 => 
            array (
                'id' => 67,
                'module_type' => 'ride-share',
                'key' => 'driver_new_ride_request',
            'message' => 'New Ride Request (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:42',
                'updated_at' => '2025-09-08 05:27:42',
            ),
            67 => 
            array (
                'id' => 68,
                'module_type' => 'ride-share',
                'key' => 'driver_bid_accepted',
            'message' => 'Bid Accepted (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            68 => 
            array (
                'id' => 69,
                'module_type' => 'ride-share',
                'key' => 'driver_trip_request_canceled',
            'message' => 'Trip Request Canceled (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            69 => 
            array (
                'id' => 70,
                'module_type' => 'ride-share',
                'key' => 'driver_customer_canceled_trip',
            'message' => 'Customer Canceled Trip (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            70 => 
            array (
                'id' => 71,
                'module_type' => 'ride-share',
                'key' => 'driver_bid_request_canceled_by_customer',
            'message' => 'Bid Request Canceled By Customer (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            71 => 
            array (
                'id' => 72,
                'module_type' => 'ride-share',
                'key' => 'driver_tips_from_customer',
            'message' => 'Tips From Customer (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            72 => 
            array (
                'id' => 73,
                'module_type' => 'ride-share',
                'key' => 'driver_received_new_bid',
            'message' => 'Received New Bid (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            73 => 
            array (
                'id' => 74,
                'module_type' => 'ride-share',
                'key' => 'driver_customer_rejected_bid',
            'message' => 'Customer Rejected Bid (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            74 => 
            array (
                'id' => 75,
                'module_type' => 'ride-share',
                'key' => 'driver_registration_registration_approved',
            'message' => 'Registration Approved (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            75 => 
            array (
                'id' => 76,
                'module_type' => 'ride-share',
                'key' => 'driver_registration_vehicle_request_approved',
            'message' => 'Vehicle Request Approved (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            76 => 
            array (
                'id' => 77,
                'module_type' => 'ride-share',
                'key' => 'driver_registration_vehicle_request_denied',
            'message' => 'Vehicle Request Denied (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            77 => 
            array (
                'id' => 78,
                'module_type' => 'ride-share',
                'key' => 'driver_registration_identity_image_rejected',
            'message' => 'Identity Image Rejected (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            78 => 
            array (
                'id' => 79,
                'module_type' => 'ride-share',
                'key' => 'driver_registration_identity_image_approved',
            'message' => 'Identity Image Approved (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            79 => 
            array (
                'id' => 80,
                'module_type' => 'ride-share',
                'key' => 'driver_registration_vehicle_active',
            'message' => 'Vehicle Active (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            80 => 
            array (
                'id' => 81,
                'module_type' => 'ride-share',
                'key' => 'other_coupon_applied',
            'message' => 'Coupon Applied (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            81 => 
            array (
                'id' => 82,
                'module_type' => 'ride-share',
                'key' => 'other_coupon_removed',
            'message' => 'Coupon Removed (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            82 => 
            array (
                'id' => 83,
                'module_type' => 'ride-share',
                'key' => 'other_review_from_customer',
            'message' => 'Review From Customer (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            83 => 
            array (
                'id' => 84,
                'module_type' => 'ride-share',
                'key' => 'other_review_from_driver',
            'message' => 'Review From Driver (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            84 => 
            array (
                'id' => 85,
                'module_type' => 'ride-share',
                'key' => 'other_someone_used_your_code',
            'message' => 'Someone Used Your Code (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            85 => 
            array (
                'id' => 86,
                'module_type' => 'ride-share',
                'key' => 'other_referral_reward_received',
            'message' => 'Referral Reward Received (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            86 => 
            array (
                'id' => 87,
                'module_type' => 'ride-share',
                'key' => 'other_safety_alert_sent',
            'message' => 'Safety Alert Sent (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            87 => 
            array (
                'id' => 88,
                'module_type' => 'ride-share',
                'key' => 'other_safety_problem_resolved',
            'message' => 'Safety Problem Resolved (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            88 => 
            array (
                'id' => 89,
                'module_type' => 'ride-share',
                'key' => 'other_terms_and_conditions_updated',
            'message' => 'Terms And Conditions Updated (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            89 => 
            array (
                'id' => 90,
                'module_type' => 'ride-share',
                'key' => 'other_privacy_policy_updated',
            'message' => 'Privacy Policy Updated (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            90 => 
            array (
                'id' => 91,
                'module_type' => 'ride-share',
                'key' => 'other_legal_updated',
            'message' => 'Legal Updated (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            91 => 
            array (
                'id' => 92,
                'module_type' => 'ride-share',
                'key' => 'other_new_message',
            'message' => 'New Message (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            92 => 
            array (
                'id' => 93,
                'module_type' => 'ride-share',
                'key' => 'other_admin_message',
            'message' => 'Admin Message (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            93 => 
            array (
                'id' => 94,
                'module_type' => 'ride-share',
                'key' => 'other_level_up',
            'message' => 'Level Up (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            94 => 
            array (
                'id' => 95,
                'module_type' => 'ride-share',
                'key' => 'other_fund_added_by_admin',
            'message' => 'Fund Added By Admin (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            95 => 
            array (
                'id' => 96,
                'module_type' => 'ride-share',
                'key' => 'other_admin_collected_cash',
            'message' => 'Admin Collected Cash (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            96 => 
            array (
                'id' => 97,
                'module_type' => 'ride-share',
                'key' => 'other_withdraw_request_rejected',
            'message' => 'Withdraw Request Rejected (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            97 => 
            array (
                'id' => 98,
                'module_type' => 'ride-share',
                'key' => 'other_withdraw_request_approved',
            'message' => 'Withdraw Request Approved (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            98 => 
            array (
                'id' => 99,
                'module_type' => 'ride-share',
                'key' => 'other_withdraw_request_settled',
            'message' => 'Withdraw Request Settled (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            99 => 
            array (
                'id' => 100,
                'module_type' => 'ride-share',
                'key' => 'other_withdraw_request_reversed',
            'message' => 'Withdraw Request Reversed (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:27:43',
                'updated_at' => '2025-09-08 05:27:43',
            ),
            100 => 
            array (
                'id' => 101,
                'module_type' => 'service',
                'key' => 'user_booking_place',
            'message' => 'Booking Place (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            101 => 
            array (
                'id' => 102,
                'module_type' => 'service',
                'key' => 'user_booking_accepted',
            'message' => 'Booking Accepted (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            102 => 
            array (
                'id' => 103,
                'module_type' => 'service',
                'key' => 'user_serviceman_assign',
            'message' => 'Serviceman Assign (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            103 => 
            array (
                'id' => 104,
                'module_type' => 'service',
                'key' => 'user_booking_ongoing',
            'message' => 'Booking Ongoing (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            104 => 
            array (
                'id' => 105,
                'module_type' => 'service',
                'key' => 'user_otp',
            'message' => 'Confirmation OTP (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            105 => 
            array (
                'id' => 106,
                'module_type' => 'service',
                'key' => 'user_booking_complete',
            'message' => 'Booking Complete (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            106 => 
            array (
                'id' => 107,
                'module_type' => 'service',
                'key' => 'user_booking_cancel',
            'message' => 'Booking Cancel (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            107 => 
            array (
                'id' => 108,
                'module_type' => 'service',
                'key' => 'user_booking_schedule_time_change',
            'message' => 'Booking schedule time change (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            108 => 
            array (
                'id' => 109,
                'module_type' => 'service',
                'key' => 'user_add_fund_wallet',
            'message' => 'Add Fund Wallet (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            109 => 
            array (
                'id' => 110,
                'module_type' => 'service',
                'key' => 'user_add_fund_wallet_bonus',
            'message' => 'Add Fund Wallet Bonus (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            110 => 
            array (
                'id' => 111,
                'module_type' => 'service',
                'key' => 'user_customized_booking_request',
            'message' => 'Customized Booking Request (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            111 => 
            array (
                'id' => 112,
                'module_type' => 'service',
                'key' => 'user_customized_booking_request_delete',
            'message' => 'Customized Booking Request Delete (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            112 => 
            array (
                'id' => 113,
                'module_type' => 'service',
                'key' => 'user_offline_payment_approved',
            'message' => 'Offline Payment Approved (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            113 => 
            array (
                'id' => 114,
                'module_type' => 'service',
                'key' => 'user_booking_edit_service_add',
            'message' => 'Booking Edit Service Add (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            114 => 
            array (
                'id' => 115,
                'module_type' => 'service',
                'key' => 'user_booking_edit_service_remove',
            'message' => 'Booking Edit Service Remove (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            115 => 
            array (
                'id' => 116,
                'module_type' => 'service',
                'key' => 'user_booking_edit_service_quantity_increase',
            'message' => 'Booking Edit Service Quantity Increase (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            116 => 
            array (
                'id' => 117,
                'module_type' => 'service',
                'key' => 'user_booking_edit_service_quantity_decrease',
            'message' => 'Booking Edit Service Quantity Decrease (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            117 => 
            array (
                'id' => 118,
                'module_type' => 'service',
                'key' => 'user_referral_earning',
            'message' => 'Referral Earning (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            118 => 
            array (
                'id' => 119,
                'module_type' => 'service',
                'key' => 'user_referral_earning_first_booking',
            'message' => 'Referral Earning First Booking (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            119 => 
            array (
                'id' => 120,
                'module_type' => 'service',
                'key' => 'user_referral_code_used',
            'message' => 'Referral code used (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            120 => 
            array (
                'id' => 121,
                'module_type' => 'service',
                'key' => 'user_loyalty_point',
            'message' => 'Loyalty Point (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            121 => 
            array (
                'id' => 122,
                'module_type' => 'service',
                'key' => 'user_refund',
            'message' => 'Refund (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            122 => 
            array (
                'id' => 123,
                'module_type' => 'service',
                'key' => 'user_customer_notification_for_provider_bid_offer',
            'message' => 'Customer notification for provider bid offer (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            123 => 
            array (
                'id' => 124,
                'module_type' => 'service',
                'key' => 'user_customer_notification_for_provider_bid_withdraw',
            'message' => 'Customer notification for provider bid withdraw (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            124 => 
            array (
                'id' => 125,
                'module_type' => 'service',
                'key' => 'provider_new_service_request_arrived',
            'message' => 'New Service Request Arrived (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            125 => 
            array (
                'id' => 126,
                'module_type' => 'service',
                'key' => 'provider_booking_accepted',
            'message' => 'Booking Accepted (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            126 => 
            array (
                'id' => 127,
                'module_type' => 'service',
                'key' => 'provider_serviceman_assign',
            'message' => 'Serviceman Assign (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            127 => 
            array (
                'id' => 128,
                'module_type' => 'service',
                'key' => 'provider_ongoing_booking',
            'message' => 'Ongoing Booking (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            128 => 
            array (
                'id' => 129,
                'module_type' => 'service',
                'key' => 'provider_booking_complete',
            'message' => 'Booking Complete (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            129 => 
            array (
                'id' => 130,
                'module_type' => 'service',
                'key' => 'provider_booking_cancel',
            'message' => 'Booking Cancel (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            130 => 
            array (
                'id' => 131,
                'module_type' => 'service',
                'key' => 'provider_booking_schedule_time_change',
            'message' => 'Booking schedule time change (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            131 => 
            array (
                'id' => 132,
                'module_type' => 'service',
                'key' => 'provider_provider_bid_request_denied',
            'message' => 'Provider Bid Request Denied (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            132 => 
            array (
                'id' => 133,
                'module_type' => 'service',
                'key' => 'provider_booking_edit_service_add',
            'message' => 'Booking Edit Service Add (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            133 => 
            array (
                'id' => 134,
                'module_type' => 'service',
                'key' => 'provider_booking_edit_service_remove',
            'message' => 'Booking Edit Service Remove (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            134 => 
            array (
                'id' => 135,
                'module_type' => 'service',
                'key' => 'provider_booking_edit_service_quantity_increase',
            'message' => 'Booking Edit Service Quantity Increase (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            135 => 
            array (
                'id' => 136,
                'module_type' => 'service',
                'key' => 'provider_booking_edit_service_quantity_decrease',
            'message' => 'Booking Edit Service Quantity Decrease (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            136 => 
            array (
                'id' => 137,
                'module_type' => 'service',
                'key' => 'provider_widthdraw_request_approve',
            'message' => 'Withdraw Request Approve (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            137 => 
            array (
                'id' => 138,
                'module_type' => 'service',
                'key' => 'provider_widthdraw_request_deny',
            'message' => 'Withdraw Request Deny (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            138 => 
            array (
                'id' => 139,
                'module_type' => 'service',
                'key' => 'provider_admin_payable',
            'message' => 'Admin Payable (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            139 => 
            array (
                'id' => 140,
                'module_type' => 'service',
                'key' => 'provider_service_request_approve',
            'message' => 'Service Request Review (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            140 => 
            array (
                'id' => 141,
                'module_type' => 'service',
                'key' => 'provider_service_request_deny',
            'message' => 'Service Request Reject (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            141 => 
            array (
                'id' => 142,
                'module_type' => 'service',
                'key' => 'provider_provider_suspend',
            'message' => 'Provider Suspend (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            142 => 
            array (
                'id' => 143,
                'module_type' => 'service',
                'key' => 'provider_provider_suspension_remove',
            'message' => 'Provider Suspension removed (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            143 => 
            array (
                'id' => 144,
                'module_type' => 'service',
                'key' => 'provider_advertisement_approved',
            'message' => 'Advertisement Approved (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            144 => 
            array (
                'id' => 145,
                'module_type' => 'service',
                'key' => 'provider_advertisement_denied',
            'message' => 'Advertisement Denied (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            145 => 
            array (
                'id' => 146,
                'module_type' => 'service',
                'key' => 'provider_advertisement_resumed',
            'message' => 'Advertisement Resumed (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            146 => 
            array (
                'id' => 147,
                'module_type' => 'service',
                'key' => 'provider_advertisement_paused',
            'message' => 'Advertisement Paused (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            147 => 
            array (
                'id' => 148,
                'module_type' => 'service',
                'key' => 'provider_advertisement_created_by_admin',
            'message' => 'Advertisement Created By Admin (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            148 => 
            array (
                'id' => 149,
                'module_type' => 'service',
                'key' => 'serviceman_serviceman_assign',
            'message' => 'Serviceman Assign (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            149 => 
            array (
                'id' => 150,
                'module_type' => 'service',
                'key' => 'serviceman_ongoing_booking',
            'message' => 'Ongoing Booking (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            150 => 
            array (
                'id' => 151,
                'module_type' => 'service',
                'key' => 'serviceman_booking_complete',
            'message' => 'Booking Complete (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            151 => 
            array (
                'id' => 152,
                'module_type' => 'service',
                'key' => 'serviceman_booking_cancel',
            'message' => 'Booking Cancel (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            152 => 
            array (
                'id' => 153,
                'module_type' => 'service',
                'key' => 'serviceman_booking_schedule_time_change',
            'message' => 'Booking Schedule Time Change (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            153 => 
            array (
                'id' => 154,
                'module_type' => 'service',
                'key' => 'serviceman_booking_edit_service_add',
            'message' => 'Booking Edit Service Add (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            154 => 
            array (
                'id' => 155,
                'module_type' => 'service',
                'key' => 'serviceman_booking_edit_service_quantity_increase',
            'message' => 'Booking Edit Service Quantity Increase (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            155 => 
            array (
                'id' => 156,
                'module_type' => 'service',
                'key' => 'serviceman_booking_edit_service_quantity_decrease',
            'message' => 'Booking Edit Service Quantity Decrease (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
            156 => 
            array (
                'id' => 157,
                'module_type' => 'service',
                'key' => 'serviceman_booking_edit_service_remove',
            'message' => 'Booking Edit Service Remove (EN)',
                'status' => 1,
                'created_at' => '2025-09-08 05:28:02',
                'updated_at' => '2025-09-08 05:28:02',
            ),
        ));
        
        
    }
}