<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_roles')->delete();
        
        \DB::table('admin_roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Master Admin',
                'modules' => NULL,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Customer Relation Manager',
                'modules' => '["customerList","order","parcel"]',
                'status' => 1,
                'created_at' => '2022-09-29 11:26:40',
                'updated_at' => '2022-09-29 11:27:32',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'HR',
                'modules' => '["banner","campaign","coupon","custom_role","employee"]',
                'status' => 1,
                'created_at' => '2022-09-29 11:28:36',
                'updated_at' => '2022-09-29 11:28:36',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Manager',
                'modules' => '["account","account","addon","attribute","banner","campaign","category","coupon","custom_role","customerList","deliveryman","provide_dm_earning","employee","item","notification","order","store","report","settings","withdraw_list","zone","module","parcel","pos","unit"]',
                'status' => 1,
                'created_at' => '2022-09-29 11:30:23',
                'updated_at' => '2022-09-29 11:30:23',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Accountant',
                'modules' => '["account","provide_dm_earning","withdraw_list"]',
                'status' => 1,
                'created_at' => '2022-09-29 11:31:12',
                'updated_at' => '2022-09-29 11:31:12',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Receptionist & Front Desk Manager',
                'modules' => '["banner","campaign","category","employee","notification","store","report","parcel","pos"]',
                'status' => 1,
                'created_at' => '2022-09-29 11:34:27',
                'updated_at' => '2022-09-29 11:34:27',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Service & rental',
                'modules' => '["booking","service_provider"]',
                'status' => 1,
                'created_at' => '2025-09-23 11:28:07',
                'updated_at' => '2025-10-07 09:57:14',
            ),
        ));
        
        
    }
}