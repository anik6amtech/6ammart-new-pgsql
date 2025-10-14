<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PasswordResetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('password_resets')->delete();
        
        \DB::table('password_resets')->insert(array (
            0 => 
            array (
                'email' => 'demo@inboxgun.com',
                'token' => '4320',
                'created_at' => '2021-08-22 08:45:24',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'created_by' => 'user',
                'phone' => NULL,
            ),
            1 => 
            array (
                'email' => 'ashek@gmail.com',
                'token' => '6625',
                'created_at' => '2021-08-23 21:51:35',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'created_by' => 'user',
                'phone' => NULL,
            ),
            2 => 
            array (
                'email' => 'sunnysultan1640@gmail.com',
                'token' => '1954',
                'created_at' => '2022-03-22 13:16:26',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'created_by' => 'user',
                'phone' => NULL,
            ),
            3 => 
            array (
                'email' => 'sunnysultan1640@gmail.com',
                'token' => '7762',
                'created_at' => '2022-03-22 13:16:31',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'created_by' => 'user',
                'phone' => NULL,
            ),
            4 => 
            array (
                'email' => 'sunnysultan1640@gmail.com',
                'token' => '2563',
                'created_at' => '2022-09-29 12:28:05',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'created_by' => 'user',
                'phone' => NULL,
            ),
            5 => 
            array (
                'email' => 'sunnysultan1640@gmail.com',
                'token' => '6313',
                'created_at' => '2022-09-29 12:28:11',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'created_by' => 'user',
                'phone' => NULL,
            ),
            6 => 
            array (
                'email' => 'sunnysultan1640@gmail.com',
                'token' => '8624',
                'created_at' => '2022-09-29 12:28:48',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'created_by' => 'user',
                'phone' => NULL,
            ),
            7 => 
            array (
                'email' => 'sunnysultan1640@gmail.com',
                'token' => '8502',
                'created_at' => '2022-09-29 12:29:13',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'created_by' => 'user',
                'phone' => NULL,
            ),
            8 => 
            array (
                'email' => 'sunnysultan1640@gmail.com',
                'token' => '1257',
                'created_at' => '2022-09-29 12:29:36',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'created_by' => 'user',
                'phone' => NULL,
            ),
            9 => 
            array (
                'email' => 'sakeef@6amtech.com',
                'token' => '5098',
                'created_at' => '2022-11-21 18:59:28',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'created_by' => 'user',
                'phone' => NULL,
            ),
            10 => 
            array (
                'email' => '6amtest23@gmail.com',
                'token' => 'WCL4R40PCAMYZZW',
                'created_at' => '2023-06-12 19:42:14',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'created_by' => 'admin',
                'phone' => NULL,
            ),
            11 => 
            array (
                'email' => '6amtest23@gmail.com',
                'token' => '2Q6S184WCGUYUFA',
                'created_at' => '2023-06-12 20:38:44',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'created_by' => 'admin',
                'phone' => NULL,
            ),
            12 => 
            array (
                'email' => '6amtest23@gmail.com',
                'token' => 'IHAQUKLB6TNRPWD',
                'created_at' => '2023-06-12 20:39:00',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'created_by' => 'admin',
                'phone' => NULL,
            ),
            13 => 
            array (
                'email' => '6amtest23@gmail.com',
                'token' => 'D8AC0P2NRJQGQT2',
                'created_at' => '2023-06-12 20:39:15',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'created_by' => 'admin',
                'phone' => NULL,
            ),
            14 => 
            array (
                'email' => '6amtest23@gmail.com',
                'token' => '3YCVMWCRXZJ60BD',
                'created_at' => '2023-06-12 20:39:49',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'created_by' => 'admin',
                'phone' => NULL,
            ),
            15 => 
            array (
                'email' => '6amtest23@gmail.com',
                'token' => 'YMNCOGX4N6CEDYS',
                'created_at' => '2023-06-12 20:42:15',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'created_by' => 'admin',
                'phone' => NULL,
            ),
            16 => 
            array (
                'email' => '6amtest23@gmail.com',
                'token' => 'E2MGVLDYPUBUWPI',
                'created_at' => '2023-06-12 20:56:31',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'created_by' => 'admin',
                'phone' => NULL,
            ),
            17 => 
            array (
                'email' => '6amtest23@gmail.com',
                'token' => 'AIDGWQQYM5OP4AX',
                'created_at' => '2023-06-12 21:01:00',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'created_by' => 'admin',
                'phone' => NULL,
            ),
            18 => 
            array (
                'email' => 'jerry@gmail.com',
                'token' => '3265',
                'created_at' => '2023-09-20 10:56:47',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'created_by' => 'user',
                'phone' => NULL,
            ),
            19 => 
            array (
                'email' => 'purna.6amtech@gmail.com',
                'token' => '4344',
                'created_at' => '2023-09-20 11:01:16',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'created_by' => 'user',
                'phone' => NULL,
            ),
            20 => 
            array (
                'email' => 'tr1@gmail.com',
                'token' => '523564',
                'created_at' => '2025-09-29 16:21:56',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'created_by' => 'user',
                'phone' => NULL,
            ),
        ));
        
        
    }
}