<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderCancelReasonsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_cancel_reasons')->delete();
        
        \DB::table('order_cancel_reasons')->insert(array (
            0 => 
            array (
                'id' => 1,
                'reason' => 'Order delivered time is too much',
                'user_type' => 'customer',
                'status' => 1,
                'created_at' => '2023-03-15 21:31:24',
                'updated_at' => '2023-03-15 21:31:24',
            ),
            1 => 
            array (
                'id' => 2,
                'reason' => 'Others reasons',
                'user_type' => 'admin',
                'status' => 1,
                'created_at' => '2023-03-15 21:31:40',
                'updated_at' => '2023-03-15 21:31:40',
            ),
            2 => 
            array (
                'id' => 3,
                'reason' => 'Fake customer',
                'user_type' => 'admin',
                'status' => 1,
                'created_at' => '2023-03-15 21:31:54',
                'updated_at' => '2023-03-15 21:31:54',
            ),
            3 => 
            array (
                'id' => 4,
                'reason' => 'Product shortage',
                'user_type' => 'store',
                'status' => 1,
                'created_at' => '2023-03-15 21:32:23',
                'updated_at' => '2023-03-15 21:32:23',
            ),
            4 => 
            array (
                'id' => 5,
                'reason' => 'Now its restaurant closing hour',
                'user_type' => 'store',
                'status' => 1,
                'created_at' => '2023-03-15 21:32:44',
                'updated_at' => '2023-03-15 21:32:44',
            ),
            5 => 
            array (
                'id' => 6,
                'reason' => 'For bad weather, can\'t serve order',
                'user_type' => 'deliveryman',
                'status' => 1,
                'created_at' => '2023-03-15 21:33:13',
                'updated_at' => '2023-03-15 21:33:13',
            ),
            6 => 
            array (
                'id' => 7,
                'reason' => 'Right now, I am busy to serve another order',
                'user_type' => 'deliveryman',
                'status' => 1,
                'created_at' => '2023-03-15 21:33:33',
                'updated_at' => '2023-03-15 21:33:33',
            ),
            7 => 
            array (
                'id' => 8,
                'reason' => 'I ordered the wrong food',
                'user_type' => 'customer',
                'status' => 1,
                'created_at' => '2023-03-15 21:33:49',
                'updated_at' => '2023-03-15 21:33:49',
            ),
        ));
        
        
    }
}