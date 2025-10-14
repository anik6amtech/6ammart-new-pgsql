<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AutomatedMessagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('automated_messages')->delete();
        
        \DB::table('automated_messages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'message' => 'Delivery address need to change',
                'status' => 1,
                'created_at' => '2024-09-24 10:25:49',
                'updated_at' => '2024-09-24 10:25:49',
            ),
            1 => 
            array (
                'id' => 2,
                'message' => 'Need to change the phone number for delivery.',
                'status' => 1,
                'created_at' => '2024-09-24 10:26:00',
                'updated_at' => '2024-09-24 10:26:00',
            ),
            2 => 
            array (
                'id' => 3,
                'message' => 'Ordered the product wrong product',
                'status' => 1,
                'created_at' => '2024-09-24 10:27:27',
                'updated_at' => '2024-09-24 10:27:27',
            ),
            3 => 
            array (
                'id' => 4,
                'message' => 'Product not delivered yet. Could you please check the status?',
                'status' => 1,
                'created_at' => '2024-09-24 10:31:17',
                'updated_at' => '2024-09-24 10:31:17',
            ),
        ));
        
        
    }
}