<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DiscountsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('discounts')->delete();
        
        \DB::table('discounts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'start_date' => '2024-11-19',
                'end_date' => '2026-12-31',
                'start_time' => '00:00:00',
                'end_time' => '23:59:00',
                'min_purchase' => '0.00',
                'max_discount' => '1000.00',
                'discount' => '10.00',
                'discount_type' => 'percent',
                'store_id' => 14,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'start_date' => '2024-11-19',
                'end_date' => '2026-12-30',
                'start_time' => '00:00:00',
                'end_time' => '23:59:00',
                'min_purchase' => '0.00',
                'max_discount' => '2000.00',
                'discount' => '15.00',
                'discount_type' => 'percent',
                'store_id' => 31,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'start_date' => '2024-11-19',
                'end_date' => '2027-12-19',
                'start_time' => '00:00:00',
                'end_time' => '23:59:00',
                'min_purchase' => '0.00',
                'max_discount' => '2500.00',
                'discount' => '10.00',
                'discount_type' => 'percent',
                'store_id' => 8,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'start_date' => '2024-11-19',
                'end_date' => '2026-12-30',
                'start_time' => '00:00:00',
                'end_time' => '23:59:00',
                'min_purchase' => '0.00',
                'max_discount' => '500.00',
                'discount' => '15.00',
                'discount_type' => 'percent',
                'store_id' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'start_date' => '2024-11-19',
                'end_date' => '2026-12-31',
                'start_time' => '00:00:00',
                'end_time' => '23:59:00',
                'min_purchase' => '0.00',
                'max_discount' => '500.00',
                'discount' => '5.00',
                'discount_type' => 'percent',
                'store_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'start_date' => '2024-11-19',
                'end_date' => '2026-12-31',
                'start_time' => '00:00:00',
                'end_time' => '23:59:00',
                'min_purchase' => '0.00',
                'max_discount' => '1000.00',
                'discount' => '25.00',
                'discount_type' => 'percent',
                'store_id' => 21,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'start_date' => '2024-11-19',
                'end_date' => '2026-12-17',
                'start_time' => '00:00:00',
                'end_time' => '23:59:00',
                'min_purchase' => '100.00',
                'max_discount' => '500.00',
                'discount' => '20.00',
                'discount_type' => 'percent',
                'store_id' => 24,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'start_date' => '2024-11-19',
                'end_date' => '2026-12-31',
                'start_time' => '00:00:00',
                'end_time' => '23:59:00',
                'min_purchase' => '50.00',
                'max_discount' => '1000.00',
                'discount' => '15.00',
                'discount_type' => 'percent',
                'store_id' => 46,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'start_date' => '2024-11-19',
                'end_date' => '2026-12-31',
                'start_time' => '00:00:00',
                'end_time' => '23:59:00',
                'min_purchase' => '100.00',
                'max_discount' => '500.00',
                'discount' => '15.00',
                'discount_type' => 'percent',
                'store_id' => 47,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}