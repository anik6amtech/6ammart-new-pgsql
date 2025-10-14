<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OfflinePaymentMethodsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('offline_payment_methods')->delete();
        
        \DB::table('offline_payment_methods')->insert(array (
            0 => 
            array (
                'id' => 1,
                'method_name' => 'Bank',
                'method_fields' => '[{"input_name":"back_name","input_data":"ACME Bank"},{"input_name":"bank_branch","input_data":"New York"},{"input_name":"account_name","input_data":"Josh Smith"},{"input_name":"account_number","input_data":"xxxxxxxxxxxxxxxxxxxx"}]',
                'method_informations' => '[{"customer_input":"name","customer_placeholder":"Enter your Name","is_required":1},{"customer_input":"date","customer_placeholder":"Enter Date","is_required":1},{"customer_input":"transaction_id","customer_placeholder":"Enter Transaction ID","is_required":1}]',
                'status' => 1,
                'created_at' => '2024-04-20 15:22:07',
                'updated_at' => '2024-04-20 15:22:07',
            ),
        ));
        
        
    }
}