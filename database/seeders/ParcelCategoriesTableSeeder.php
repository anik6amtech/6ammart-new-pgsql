<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ParcelCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('parcel_categories')->delete();
        
        \DB::table('parcel_categories')->insert(array (
            0 => 
            array (
                'id' => 2,
                'image' => '2024-11-04-67286a6490390.png',
                'name' => 'Gifts',
                'description' => 'Send heartfelt presents, right on time',
                'status' => 1,
                'orders_count' => 7,
                'module_id' => 5,
                'created_at' => '2022-03-22 18:10:43',
                'updated_at' => '2025-09-13 07:21:08',
                'parcel_per_km_shipping_charge' => 7.0,
                'parcel_minimum_shipping_charge' => 40.0,
            ),
            1 => 
            array (
                'id' => 3,
                'image' => '2024-11-04-672869a5c51ef.png',
                'name' => 'Documents',
                'description' => 'From IDs to forms, we deliver it all',
                'status' => 1,
                'orders_count' => 0,
                'module_id' => 5,
                'created_at' => '2022-03-22 18:24:47',
                'updated_at' => '2024-11-04 12:31:37',
                'parcel_per_km_shipping_charge' => 5.0,
                'parcel_minimum_shipping_charge' => 50.0,
            ),
            2 => 
            array (
                'id' => 4,
                'image' => '2024-11-04-67286a13d1d2d.png',
                'name' => 'Electronics',
                'description' => 'Safeguard your gadgets with secure delivery',
                'status' => 1,
                'orders_count' => 1,
                'module_id' => 5,
                'created_at' => '2022-03-22 18:30:00',
                'updated_at' => '2024-11-04 12:30:43',
                'parcel_per_km_shipping_charge' => 5.0,
                'parcel_minimum_shipping_charge' => 50.0,
            ),
            3 => 
            array (
                'id' => 5,
                'image' => '2024-11-04-67286b70e5662.png',
                'name' => 'Package',
                'description' => 'Small or large packages delivered fast',
                'status' => 1,
                'orders_count' => 1,
                'module_id' => 5,
                'created_at' => '2022-03-22 18:32:54',
                'updated_at' => '2024-11-04 12:36:32',
                'parcel_per_km_shipping_charge' => 5.0,
                'parcel_minimum_shipping_charge' => 10.0,
            ),
            4 => 
            array (
                'id' => 6,
                'image' => '2024-11-04-67286bb262371.png',
                'name' => 'Medicines',
                'description' => 'Get medical essentials, delivered swiftly',
                'status' => 1,
                'orders_count' => 0,
                'module_id' => 5,
                'created_at' => '2024-11-04 12:37:38',
                'updated_at' => '2024-11-04 12:37:38',
                'parcel_per_km_shipping_charge' => 5.0,
                'parcel_minimum_shipping_charge' => 25.0,
            ),
            5 => 
            array (
                'id' => 7,
                'image' => '2024-11-04-67286bfbd1033.png',
                'name' => 'Pet Supplies',
                'description' => 'Furry friend needs bringing with love',
                'status' => 1,
                'orders_count' => 0,
                'module_id' => 5,
                'created_at' => '2024-11-04 12:38:51',
                'updated_at' => '2024-11-04 12:38:51',
                'parcel_per_km_shipping_charge' => 5.0,
                'parcel_minimum_shipping_charge' => 60.0,
            ),
        ));
        
        
    }
}