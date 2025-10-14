<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DisbursementDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('disbursement_details')->delete();
        
        \DB::table('disbursement_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'disbursement_id' => 1001,
                'store_id' => 2,
                'delivery_man_id' => NULL,
                'disbursement_amount' => 940.91,
                'payment_method' => 1,
                'status' => 'pending',
                'created_at' => '2023-11-27 12:43:01',
                'updated_at' => '2023-11-27 12:43:01',
            ),
            1 => 
            array (
                'id' => 2,
                'disbursement_id' => 1002,
                'store_id' => NULL,
                'delivery_man_id' => 1,
                'disbursement_amount' => 8308.86,
                'payment_method' => 2,
                'status' => 'pending',
                'created_at' => '2023-11-27 12:44:02',
                'updated_at' => '2023-11-27 12:44:02',
            ),
        ));
        
        
    }
}