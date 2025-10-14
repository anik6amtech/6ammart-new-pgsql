<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceProviderSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_provider_settings')->delete();
        
        \DB::table('service_provider_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'provider_id' => 1,
                'key' => 'instant_booking',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-07 04:53:46',
                'updated_at' => '2025-10-05 13:56:24',
            ),
            1 => 
            array (
                'id' => 2,
                'provider_id' => 1,
                'key' => 'repeat_booking',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-07 04:53:46',
                'updated_at' => '2025-10-05 13:56:24',
            ),
            2 => 
            array (
                'id' => 3,
                'provider_id' => 1,
                'key' => 'schedule_booking',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-07 04:53:46',
                'updated_at' => '2025-09-30 10:14:07',
            ),
            3 => 
            array (
                'id' => 4,
                'provider_id' => 1,
                'key' => 'time_restriction_on_schedule_booking',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-07 04:53:46',
                'updated_at' => '2025-09-09 12:35:29',
            ),
            4 => 
            array (
                'id' => 5,
                'provider_id' => 1,
                'key' => 'time_restriction_on_schedule_booking_value',
                'value' => '10',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-07 04:53:46',
                'updated_at' => '2025-09-09 12:35:29',
            ),
            5 => 
            array (
                'id' => 6,
                'provider_id' => 1,
                'key' => 'time_restriction_on_schedule_booking_type',
                'value' => '"min"',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-07 04:53:46',
                'updated_at' => '2025-09-07 04:55:37',
            ),
            6 => 
            array (
                'id' => 7,
                'provider_id' => 1,
                'key' => 'service_at_customer_location',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-07 04:53:46',
                'updated_at' => '2025-09-30 11:19:54',
            ),
            7 => 
            array (
                'id' => 8,
                'provider_id' => 1,
                'key' => 'service_at_provider_location',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-07 04:53:46',
                'updated_at' => '2025-09-07 04:53:46',
            ),
            8 => 
            array (
                'id' => 9,
                'provider_id' => 1,
                'key' => 'serviceman_can_cancel_booking',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-07 04:53:46',
                'updated_at' => '2025-09-09 12:35:29',
            ),
            9 => 
            array (
                'id' => 10,
                'provider_id' => 1,
                'key' => 'serviceman_can_edit_booking',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-07 04:53:46',
                'updated_at' => '2025-09-09 12:35:29',
            ),
            10 => 
            array (
                'id' => 11,
                'provider_id' => 7,
                'key' => 'instant_booking',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-09 10:50:09',
                'updated_at' => '2025-09-09 12:08:40',
            ),
            11 => 
            array (
                'id' => 12,
                'provider_id' => 7,
                'key' => 'repeat_booking',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-09 10:50:09',
                'updated_at' => '2025-09-09 12:08:40',
            ),
            12 => 
            array (
                'id' => 13,
                'provider_id' => 7,
                'key' => 'schedule_booking',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-09 10:50:09',
                'updated_at' => '2025-09-09 10:50:21',
            ),
            13 => 
            array (
                'id' => 14,
                'provider_id' => 7,
                'key' => 'time_restriction_on_schedule_booking',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-09 10:50:09',
                'updated_at' => '2025-09-16 17:49:33',
            ),
            14 => 
            array (
                'id' => 15,
                'provider_id' => 7,
                'key' => 'time_restriction_on_schedule_booking_value',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-09 10:50:09',
                'updated_at' => '2025-09-16 17:49:22',
            ),
            15 => 
            array (
                'id' => 16,
                'provider_id' => 7,
                'key' => 'time_restriction_on_schedule_booking_type',
                'value' => '"min"',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-09 10:50:09',
                'updated_at' => '2025-09-09 10:50:09',
            ),
            16 => 
            array (
                'id' => 17,
                'provider_id' => 7,
                'key' => 'service_at_customer_location',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-09 10:50:09',
                'updated_at' => '2025-09-09 12:09:49',
            ),
            17 => 
            array (
                'id' => 18,
                'provider_id' => 7,
                'key' => 'service_at_provider_location',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-09 10:50:09',
                'updated_at' => '2025-09-09 10:50:09',
            ),
            18 => 
            array (
                'id' => 19,
                'provider_id' => 7,
                'key' => 'serviceman_can_cancel_booking',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-09 10:50:09',
                'updated_at' => '2025-09-09 10:50:09',
            ),
            19 => 
            array (
                'id' => 20,
                'provider_id' => 7,
                'key' => 'serviceman_can_edit_booking',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-09 10:50:09',
                'updated_at' => '2025-09-09 12:08:40',
            ),
            20 => 
            array (
                'id' => 21,
                'provider_id' => 8,
                'key' => 'instant_booking',
                'value' => '0',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-22 13:42:38',
                'updated_at' => '2025-09-22 13:42:38',
            ),
            21 => 
            array (
                'id' => 22,
                'provider_id' => 8,
                'key' => 'repeat_booking',
                'value' => '0',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-22 13:42:38',
                'updated_at' => '2025-09-22 13:42:38',
            ),
            22 => 
            array (
                'id' => 23,
                'provider_id' => 8,
                'key' => 'schedule_booking',
                'value' => '0',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-22 13:42:38',
                'updated_at' => '2025-09-22 13:42:38',
            ),
            23 => 
            array (
                'id' => 24,
                'provider_id' => 8,
                'key' => 'time_restriction_on_schedule_booking',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-22 13:42:38',
                'updated_at' => '2025-09-22 14:54:10',
            ),
            24 => 
            array (
                'id' => 25,
                'provider_id' => 8,
                'key' => 'time_restriction_on_schedule_booking_value',
                'value' => '30',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-22 13:42:38',
                'updated_at' => '2025-09-22 14:54:10',
            ),
            25 => 
            array (
                'id' => 26,
                'provider_id' => 8,
                'key' => 'time_restriction_on_schedule_booking_type',
                'value' => '"min"',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-22 13:42:38',
                'updated_at' => '2025-09-22 13:42:38',
            ),
            26 => 
            array (
                'id' => 27,
                'provider_id' => 8,
                'key' => 'service_at_customer_location',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-22 13:42:38',
                'updated_at' => '2025-09-22 13:42:38',
            ),
            27 => 
            array (
                'id' => 28,
                'provider_id' => 8,
                'key' => 'service_at_provider_location',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-22 13:42:38',
                'updated_at' => '2025-09-22 13:45:25',
            ),
            28 => 
            array (
                'id' => 29,
                'provider_id' => 8,
                'key' => 'serviceman_can_cancel_booking',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-22 13:42:38',
                'updated_at' => '2025-09-22 13:42:38',
            ),
            29 => 
            array (
                'id' => 30,
                'provider_id' => 8,
                'key' => 'serviceman_can_edit_booking',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-22 13:42:38',
                'updated_at' => '2025-09-22 13:45:29',
            ),
            30 => 
            array (
                'id' => 31,
                'provider_id' => 9,
                'key' => 'service_at_customer_location',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-25 10:07:57',
                'updated_at' => '2025-09-25 10:07:57',
            ),
            31 => 
            array (
                'id' => 32,
                'provider_id' => 10,
                'key' => 'service_at_customer_location',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-25 10:20:17',
                'updated_at' => '2025-09-25 10:20:17',
            ),
            32 => 
            array (
                'id' => 33,
                'provider_id' => 11,
                'key' => 'service_at_customer_location',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-09-25 14:57:48',
                'updated_at' => '2025-09-25 14:57:48',
            ),
            33 => 
            array (
                'id' => 34,
                'provider_id' => 12,
                'key' => 'service_at_customer_location',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-10-07 15:16:22',
                'updated_at' => '2025-10-07 15:16:22',
            ),
            34 => 
            array (
                'id' => 35,
                'provider_id' => 13,
                'key' => 'service_at_customer_location',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-10-09 12:57:25',
                'updated_at' => '2025-10-09 12:57:25',
            ),
            35 => 
            array (
                'id' => 36,
                'provider_id' => 14,
                'key' => 'service_at_customer_location',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-10-09 12:59:18',
                'updated_at' => '2025-10-09 12:59:18',
            ),
            36 => 
            array (
                'id' => 37,
                'provider_id' => 15,
                'key' => 'service_at_customer_location',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-10-10 12:59:02',
                'updated_at' => '2025-10-10 12:59:02',
            ),
            37 => 
            array (
                'id' => 38,
                'provider_id' => 16,
                'key' => 'service_at_customer_location',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-10-10 15:05:03',
                'updated_at' => '2025-10-10 15:05:03',
            ),
            38 => 
            array (
                'id' => 39,
                'provider_id' => 17,
                'key' => 'service_at_customer_location',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-10-10 15:07:03',
                'updated_at' => '2025-10-10 15:07:03',
            ),
            39 => 
            array (
                'id' => 40,
                'provider_id' => 19,
                'key' => 'service_at_customer_location',
                'value' => '1',
                'type' => 'provider_config',
                'is_active' => 1,
                'created_at' => '2025-10-13 11:52:12',
                'updated_at' => '2025-10-13 11:52:12',
            ),
        ));
        
        
    }
}