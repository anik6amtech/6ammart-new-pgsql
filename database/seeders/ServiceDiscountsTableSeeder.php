<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceDiscountsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_discounts')->delete();
        
        \DB::table('service_discounts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'module_id' => 8,
                'discount_title' => 'Save Like a Boss',
                'discount_type' => 'mixed',
                'discount_amount' => '10.000',
                'discount_amount_type' => 'percent',
                'min_purchase' => '1.000',
                'max_discount_amount' => '50.000',
                'limit_per_user' => 0,
                'promotion_type' => 'discount',
                'is_active' => 1,
                'start_date' => '2025-09-09',
                'end_date' => '2025-11-08',
                'created_at' => '2025-09-09 11:46:08',
                'updated_at' => '2025-10-07 17:00:50',
            ),
            1 => 
            array (
                'id' => 2,
                'module_id' => 8,
                'discount_title' => 'Happiness in Every Click',
                'discount_type' => 'category',
                'discount_amount' => '10.000',
                'discount_amount_type' => 'percent',
                'min_purchase' => '1.000',
                'max_discount_amount' => '100.000',
                'limit_per_user' => 0,
                'promotion_type' => 'campaign',
                'is_active' => 0,
                'start_date' => '2025-09-09',
                'end_date' => '2025-11-08',
                'created_at' => '2025-09-09 11:55:40',
                'updated_at' => '2025-09-21 14:36:58',
            ),
            2 => 
            array (
                'id' => 3,
                'module_id' => 8,
                'discount_title' => 'Buy Less, Smile More',
                'discount_type' => 'mixed',
                'discount_amount' => '11.000',
                'discount_amount_type' => 'percent',
                'min_purchase' => '1.000',
                'max_discount_amount' => '1000.000',
                'limit_per_user' => 22,
                'promotion_type' => 'coupon',
                'is_active' => 1,
                'start_date' => '2025-09-09',
                'end_date' => '2025-10-31',
                'created_at' => '2025-09-09 11:57:40',
                'updated_at' => '2025-09-09 11:57:40',
            ),
            3 => 
            array (
                'id' => 4,
                'module_id' => 8,
                'discount_title' => '6ammart',
                'discount_type' => 'mixed',
                'discount_amount' => '80.000',
                'discount_amount_type' => 'percent',
                'min_purchase' => '1.000',
                'max_discount_amount' => '1000.000',
                'limit_per_user' => 55,
                'promotion_type' => 'coupon',
                'is_active' => 1,
                'start_date' => '2025-09-10',
                'end_date' => '2025-11-08',
                'created_at' => '2025-09-10 16:46:12',
                'updated_at' => '2025-09-10 16:46:12',
            ),
            4 => 
            array (
                'id' => 5,
                'module_id' => 8,
                'discount_title' => 'TEST',
                'discount_type' => 'service',
                'discount_amount' => '87.000',
                'discount_amount_type' => 'percent',
                'min_purchase' => '38.000',
                'max_discount_amount' => '42.000',
                'limit_per_user' => 0,
                'promotion_type' => 'campaign',
                'is_active' => 0,
                'start_date' => '2025-09-18',
                'end_date' => '2025-10-30',
                'created_at' => '2025-09-18 11:22:47',
                'updated_at' => '2025-10-06 10:22:26',
            ),
            5 => 
            array (
                'id' => 6,
                'module_id' => 8,
                'discount_title' => '5645416546',
                'discount_type' => 'category',
                'discount_amount' => '10.000',
                'discount_amount_type' => 'percentage',
                'min_purchase' => '5.000',
                'max_discount_amount' => '10.000',
                'limit_per_user' => 1,
                'promotion_type' => 'coupon',
                'is_active' => 1,
                'start_date' => '2025-09-28',
                'end_date' => '2025-11-06',
                'created_at' => '2025-09-28 11:22:12',
                'updated_at' => '2025-09-28 11:22:12',
            ),
            6 => 
            array (
                'id' => 7,
                'module_id' => 8,
                'discount_title' => 'Sed nesciunt esse anim sit adipisicing',
                'discount_type' => 'service',
                'discount_amount' => '24.000',
                'discount_amount_type' => 'amount',
                'min_purchase' => '82.000',
                'max_discount_amount' => '65.000',
                'limit_per_user' => 96,
                'promotion_type' => 'coupon',
                'is_active' => 1,
                'start_date' => '2025-09-29',
                'end_date' => '2025-10-24',
                'created_at' => '2025-09-28 15:31:30',
                'updated_at' => '2025-09-28 15:31:30',
            ),
            7 => 
            array (
                'id' => 10,
                'module_id' => 8,
                'discount_title' => 'Save Like a Boss',
                'discount_type' => 'service',
                'discount_amount' => '300.000',
                'discount_amount_type' => 'amount',
                'min_purchase' => '0.000',
                'max_discount_amount' => '0.000',
                'limit_per_user' => 0,
                'promotion_type' => 'discount',
                'is_active' => 1,
                'start_date' => '2025-10-01',
                'end_date' => '2025-11-30',
                'created_at' => '2025-10-06 10:28:07',
                'updated_at' => '2025-10-06 10:28:07',
            ),
            8 => 
            array (
                'id' => 11,
                'module_id' => 8,
                'discount_title' => '43524333',
                'discount_type' => 'category',
                'discount_amount' => '100.000',
                'discount_amount_type' => 'amount',
                'min_purchase' => '0.000',
                'max_discount_amount' => '0.000',
                'limit_per_user' => 0,
                'promotion_type' => 'discount',
                'is_active' => 1,
                'start_date' => '2025-10-01',
                'end_date' => '2025-11-30',
                'created_at' => '2025-10-06 10:30:10',
                'updated_at' => '2025-10-07 15:42:21',
            ),
            9 => 
            array (
                'id' => 12,
                'module_id' => 8,
                'discount_title' => 'tyrey',
                'discount_type' => 'category',
                'discount_amount' => '5.000',
                'discount_amount_type' => 'percentage',
                'min_purchase' => '33.000',
                'max_discount_amount' => '55.000',
                'limit_per_user' => 55,
                'promotion_type' => 'coupon',
                'is_active' => 1,
                'start_date' => '2025-10-06',
                'end_date' => '2025-10-31',
                'created_at' => '2025-10-06 16:05:19',
                'updated_at' => '2025-10-06 16:05:19',
            ),
            10 => 
            array (
                'id' => 13,
                'module_id' => 8,
                'discount_title' => 'Test',
                'discount_type' => 'category',
                'discount_amount' => '250.000',
                'discount_amount_type' => 'amount',
                'min_purchase' => '0.000',
                'max_discount_amount' => '0.000',
                'limit_per_user' => 150,
                'promotion_type' => 'coupon',
                'is_active' => 1,
                'start_date' => '2025-09-28',
                'end_date' => '2025-11-08',
                'created_at' => '2025-10-07 17:10:07',
                'updated_at' => '2025-10-07 17:10:07',
            ),
            11 => 
            array (
                'id' => 14,
                'module_id' => 8,
                'discount_title' => 'Quo eos amet voluptatem velit irure fugiat in laboris omnis',
                'discount_type' => 'service',
                'discount_amount' => '88.000',
                'discount_amount_type' => 'percentage',
                'min_purchase' => '52.000',
                'max_discount_amount' => '89.000',
                'limit_per_user' => 1,
                'promotion_type' => 'coupon',
                'is_active' => 1,
                'start_date' => '2025-10-08',
                'end_date' => '2025-11-13',
                'created_at' => '2025-10-09 18:14:10',
                'updated_at' => '2025-10-09 18:14:10',
            ),
        ));
        
        
    }
}