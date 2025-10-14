<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceWithdrawRequestsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_withdraw_requests')->delete();
        
        \DB::table('service_withdraw_requests')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 7,
                'request_updated_by' => 7,
                'amount' => '1.00',
                'request_status' => 'pending',
                'is_paid' => 0,
                'note' => 'ytuiytui',
                'admin_note' => NULL,
                'withdrawal_method_id' => '1',
                'withdrawal_method_fields' => '{"account_name":"uiytytu","account_number":"iytuiyt","email":"uyityui@gmail.com"}',
                'created_at' => '2025-09-10 18:22:21',
                'updated_at' => '2025-09-10 18:22:21',
                'updated_by_type' => 'provider',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 7,
                'request_updated_by' => 7,
                'amount' => '6.50',
                'request_status' => 'pending',
                'is_paid' => 0,
                'note' => '789078',
                'admin_note' => NULL,
                'withdrawal_method_id' => '2',
                'withdrawal_method_fields' => '{"account_name":"9870","account_number":"0978907890"}',
                'created_at' => '2025-09-16 12:48:56',
                'updated_at' => '2025-09-16 12:48:56',
                'updated_by_type' => 'provider',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 8,
                'request_updated_by' => 1,
                'amount' => '500.00',
                'request_status' => 'approved',
                'is_paid' => 1,
                'note' => 'yyyutuyt',
                'admin_note' => 'approved',
                'withdrawal_method_id' => '2',
                'withdrawal_method_fields' => '{"account_name":"ytytuytu","account_number":"6541564"}',
                'created_at' => '2025-09-23 15:57:31',
                'updated_at' => '2025-09-29 16:30:28',
                'updated_by_type' => 'admin',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 8,
                'request_updated_by' => 1,
                'amount' => '33000.00',
                'request_status' => 'approved',
                'is_paid' => 1,
                'note' => 'check',
                'admin_note' => '12345',
                'withdrawal_method_id' => '2',
                'withdrawal_method_fields' => '{"account_name":"tesr","account_number":"1234567"}',
                'created_at' => '2025-09-24 12:20:08',
                'updated_at' => '2025-09-24 12:20:46',
                'updated_by_type' => 'admin',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 8,
                'request_updated_by' => 8,
                'amount' => '500.00',
                'request_status' => 'pending',
                'is_paid' => 0,
                'note' => 'Ggg',
                'admin_note' => NULL,
                'withdrawal_method_id' => '1',
                'withdrawal_method_fields' => '{"account_name":"  cvv","account_number":"66","email":"cv@g.com"}',
                'created_at' => '2025-10-10 16:45:32',
                'updated_at' => '2025-10-10 16:45:32',
                'updated_by_type' => 'provider',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 8,
                'request_updated_by' => 8,
                'amount' => '1767.05',
                'request_status' => 'pending',
                'is_paid' => 0,
                'note' => 'Gg',
                'admin_note' => NULL,
                'withdrawal_method_id' => '1',
                'withdrawal_method_fields' => '{"account_name":"ff","account_number":"222","email":"dd@g.com"}',
                'created_at' => '2025-10-10 16:46:30',
                'updated_at' => '2025-10-10 16:46:30',
                'updated_by_type' => 'provider',
            ),
        ));
        
        
    }
}