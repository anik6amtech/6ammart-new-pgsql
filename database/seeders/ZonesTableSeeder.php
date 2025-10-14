<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ZonesTableSeeder extends Seeder
{
    public function run()
    {
        // Truncate table first
        DB::table('zones')->truncate();

        // Insert data
        DB::table('zones')->insert([
            [
                'id' => 1,
                'name' => 'Main Demo Zone',
                'coordinates' => DB::raw("ST_GeomFromText('POLYGON((0 0, 0 10, 10 10, 10 0, 0 0))')"),
                'status' => 1,
                'created_at' => Carbon::parse('2022-03-16 13:22:55'),
                'updated_at' => Carbon::parse('2025-09-28 11:53:45'),
                'store_wise_topic' => 'zone_1_store',
                'customer_wise_topic' => 'zone_1_customer',
                'deliveryman_wise_topic' => 'zone_1_delivery_man',
                'cash_on_delivery' => true,
                'digital_payment' => true,
                'increased_delivery_fee' => 10.0,
                'increased_delivery_fee_status' => true,
                'increase_delivery_charge_message' => 'Increase Delivery Charge Message for rainy weather.',
                'offline_payment' => true,
                'display_name' => null,
            ],
            [
                'id' => 2,
                'name' => 'سوبر ماركت',
                'coordinates' => DB::raw("ST_GeomFromText('POLYGON((0 0, 0 5, 5 5, 5 0, 0 0))')"),
                'status' => 1,
                'created_at' => Carbon::parse('2022-03-22 18:36:28'),
                'updated_at' => Carbon::parse('2025-10-07 16:04:37'),
                'store_wise_topic' => 'zone_2_store',
                'customer_wise_topic' => 'zone_2_customer',
                'deliveryman_wise_topic' => 'zone_2_delivery_man',
                'cash_on_delivery' => true,
                'digital_payment' => true,
                'increased_delivery_fee' => 0.0,
                'increased_delivery_fee_status' => false,
                'increase_delivery_charge_message' => null,
                'offline_payment' => true,
                'display_name' => null,
            ],
            [
                'id' => 3,
                'name' => 'Dhaka',
                'coordinates' => DB::raw("ST_GeomFromText('POLYGON((0 0, 0 15, 15 15, 15 0, 0 0))')"),
                'status' => 1,
                'created_at' => Carbon::parse('2025-02-05 14:38:53'),
                'updated_at' => Carbon::parse('2025-10-07 16:04:32'),
                'store_wise_topic' => 'zone_3_store',
                'customer_wise_topic' => 'zone_3_customer',
                'deliveryman_wise_topic' => 'zone_3_delivery_man',
                'cash_on_delivery' => true,
                'digital_payment' => true,
                'increased_delivery_fee' => 0.0,
                'increased_delivery_fee_status' => false,
                'increase_delivery_charge_message' => null,
                'offline_payment' => true,
                'display_name' => 'Dhaka',
            ],
        ]);
    }
}
