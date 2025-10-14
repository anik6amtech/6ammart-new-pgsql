<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DisbursementWithdrawalMethodsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('disbursement_withdrawal_methods')->delete();
        
        \DB::table('disbursement_withdrawal_methods')->insert(array (
            0 => 
            array (
                'id' => 1,
                'store_id' => 2,
                'delivery_man_id' => NULL,
                'withdrawal_method_id' => 2,
                'method_name' => '6cash',
                'method_fields' => '{"account_name":"JHON","account_number":"45321633546"}',
                'is_default' => 1,
                'created_at' => '2023-11-27 12:24:56',
                'updated_at' => '2023-11-27 12:24:59',
            ),
            1 => 
            array (
                'id' => 2,
                'store_id' => NULL,
                'delivery_man_id' => 1,
                'withdrawal_method_id' => 2,
                'method_name' => '6cash',
                'method_fields' => '{"account_name":"Ali 123","account_number":"083868658"}',
                'is_default' => 1,
                'created_at' => '2023-11-27 12:26:14',
                'updated_at' => '2023-11-27 12:26:20',
            ),
            2 => 
            array (
                'id' => 3,
                'store_id' => NULL,
                'delivery_man_id' => 9,
                'withdrawal_method_id' => 1,
                'method_name' => 'Card',
                'method_fields' => '{"account_name":"Chhf","account_number":"3535","email":"Yd@g.com"}',
                'is_default' => 1,
                'created_at' => '2025-10-08 17:05:59',
                'updated_at' => '2025-10-08 17:06:02',
            ),
        ));
        
        
    }
}