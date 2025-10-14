<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DisbursementsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('disbursements')->delete();
        
        \DB::table('disbursements')->insert(array (
            0 => 
            array (
                'id' => 1001,
                'title' => 'Disbursement # 1001',
                'description' => NULL,
                'total_amount' => 940.91,
                'status' => 'pending',
                'created_for' => 'store',
                'created_at' => '2023-11-27 12:43:01',
                'updated_at' => '2023-11-27 12:43:01',
            ),
            1 => 
            array (
                'id' => 1002,
                'title' => 'Disbursement # 1002',
                'description' => NULL,
                'total_amount' => 8308.86,
                'status' => 'pending',
                'created_for' => 'delivery_man',
                'created_at' => '2023-11-27 12:44:02',
                'updated_at' => '2023-11-27 12:44:02',
            ),
        ));
        
        
    }
}