<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FlashSalesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('flash_sales')->delete();
        
        \DB::table('flash_sales')->insert(array (
            0 => 
            array (
                'id' => 1,
                'module_id' => 1,
                'title' => '😊"Grocery Galore Flash Sale: Unbeatable Deals Await!"😊',
                'is_publish' => 1,
                'admin_discount_percentage' => 50.0,
                'vendor_discount_percentage' => 50.0,
                'start_date' => '2023-10-19 13:17:00',
                'end_date' => '2023-12-31 23:18:00',
                'created_at' => '2023-10-19 13:18:35',
                'updated_at' => '2023-10-19 13:18:39',
            ),
            1 => 
            array (
                'id' => 2,
                'module_id' => 3,
                'title' => '🌟Lightning Deals Bonanza: Don\'t Miss Out🌟',
                'is_publish' => 1,
                'admin_discount_percentage' => 50.0,
                'vendor_discount_percentage' => 50.0,
                'start_date' => '2023-10-19 13:24:00',
                'end_date' => '2023-12-31 23:24:00',
                'created_at' => '2023-10-19 13:24:53',
                'updated_at' => '2023-10-19 13:29:21',
            ),
        ));
        
        
    }
}