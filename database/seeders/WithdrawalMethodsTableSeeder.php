<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WithdrawalMethodsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('withdrawal_methods')->delete();
        
        \DB::table('withdrawal_methods')->insert(array (
            0 => 
            array (
                'id' => 1,
                'method_name' => 'Card',
                'method_fields' => '[{"input_type":"string","input_name":"account_name","placeholder":"Enter your card holder name","is_required":1},{"input_type":"number","input_name":"account_number","placeholder":"Enter your account number","is_required":1},{"input_type":"email","input_name":"email","placeholder":"Enter your account email","is_required":0}]',
                'is_default' => 1,
                'is_active' => 1,
                'created_at' => '2023-11-27 12:22:06',
                'updated_at' => '2023-11-27 12:22:06',
            ),
            1 => 
            array (
                'id' => 2,
                'method_name' => '6cash',
                'method_fields' => '[{"input_type":"string","input_name":"account_name","placeholder":"Enter your account name","is_required":1},{"input_type":"number","input_name":"account_number","placeholder":"Enter your account Number","is_required":1}]',
                'is_default' => 0,
                'is_active' => 1,
                'created_at' => '2023-11-27 12:23:04',
                'updated_at' => '2023-11-27 12:23:04',
            ),
        ));
        
        
    }
}