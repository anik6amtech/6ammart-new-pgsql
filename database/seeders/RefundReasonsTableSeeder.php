<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RefundReasonsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('refund_reasons')->delete();
        
        \DB::table('refund_reasons')->insert(array (
            0 => 
            array (
                'id' => 1,
                'reason' => 'Item quality is not so good.',
                'status' => 1,
                'created_at' => '2022-11-21 18:48:26',
                'updated_at' => '2022-11-21 18:48:26',
            ),
            1 => 
            array (
                'id' => 3,
                'reason' => 'Food was Rotten',
                'status' => 1,
                'created_at' => '2022-11-21 18:53:40',
                'updated_at' => '2022-11-21 18:53:40',
            ),
            2 => 
            array (
                'id' => 4,
                'reason' => 'Delivery man didn\'t arrived timely.',
                'status' => 1,
                'created_at' => '2022-11-21 18:54:00',
                'updated_at' => '2022-11-21 18:54:00',
            ),
            3 => 
            array (
                'id' => 5,
                'reason' => 'The Product Was Damaged Upon Arrival.',
                'status' => 1,
                'created_at' => '2022-11-21 18:54:23',
                'updated_at' => '2022-11-21 18:54:23',
            ),
            4 => 
            array (
                'id' => 6,
                'reason' => 'The Merchant Shipped the Wrong Item.',
                'status' => 1,
                'created_at' => '2022-11-21 18:54:46',
                'updated_at' => '2022-11-21 18:54:46',
            ),
        ));
        
        
    }
}