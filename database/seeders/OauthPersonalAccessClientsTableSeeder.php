<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OauthPersonalAccessClientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('oauth_personal_access_clients')->delete();
        
        \DB::table('oauth_personal_access_clients')->insert(array (
            0 => 
            array (
                'id' => 1,
                'client_id' => 1,
                'created_at' => '2021-08-19 20:44:50',
                'updated_at' => '2021-08-19 20:44:50',
            ),
            1 => 
            array (
                'id' => 2,
                'client_id' => 3,
                'created_at' => '2022-01-05 10:22:36',
                'updated_at' => '2022-01-05 10:22:36',
            ),
            2 => 
            array (
                'id' => 3,
                'client_id' => 5,
                'created_at' => '2022-03-14 17:46:33',
                'updated_at' => '2022-03-14 17:46:33',
            ),
            3 => 
            array (
                'id' => 4,
                'client_id' => 7,
                'created_at' => '2022-03-16 15:09:13',
                'updated_at' => '2022-03-16 15:09:13',
            ),
            4 => 
            array (
                'id' => 5,
                'client_id' => 9,
                'created_at' => '2022-09-29 12:16:18',
                'updated_at' => '2022-09-29 12:16:18',
            ),
            5 => 
            array (
                'id' => 6,
                'client_id' => 11,
                'created_at' => '2024-10-22 14:25:22',
                'updated_at' => '2024-10-22 14:25:22',
            ),
            6 => 
            array (
                'id' => 7,
                'client_id' => 13,
                'created_at' => '2025-02-05 13:02:56',
                'updated_at' => '2025-02-05 13:02:56',
            ),
            7 => 
            array (
                'id' => 8,
                'client_id' => 15,
                'created_at' => '2025-02-05 16:51:11',
                'updated_at' => '2025-02-05 16:51:11',
            ),
            8 => 
            array (
                'id' => 9,
                'client_id' => 17,
                'created_at' => '2025-02-06 12:02:16',
                'updated_at' => '2025-02-06 12:02:16',
            ),
            9 => 
            array (
                'id' => 10,
                'client_id' => 19,
                'created_at' => '2025-02-06 17:27:49',
                'updated_at' => '2025-02-06 17:27:49',
            ),
            10 => 
            array (
                'id' => 11,
                'client_id' => 21,
                'created_at' => '2025-09-10 16:29:15',
                'updated_at' => '2025-09-10 16:29:15',
            ),
        ));
        
        
    }
}