<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OfflinePaymentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('offline_payments')->delete();
        
        \DB::table('offline_payments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'order_id' => 100075,
                'payment_info' => '{"method_id":1,"method_name":"Bkash","name":"Flame Detector","date":"plp[klp[","transaction_id":"786yh"}',
                'status' => 'pending',
                'note' => NULL,
                'customer_note' => NULL,
                'method_fields' => '[{"input_name":"back_name__","input_data":"ACME Bank"},{"input_name":"bank_branch__","input_data":"New York"},{"input_name":"account_name","input_data":"Josh Smith"},{"input_name":"account_number","input_data":"xxxxxxxxxxxxxxxxxxxx"}]',
                'created_at' => '2023-10-19 14:24:20',
                'updated_at' => '2023-10-19 14:24:20',
            ),
        ));
        
        
    }
}