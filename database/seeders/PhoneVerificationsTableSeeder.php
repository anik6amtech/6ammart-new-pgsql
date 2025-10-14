<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PhoneVerificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('phone_verifications')->delete();
        
        \DB::table('phone_verifications')->insert(array (
            0 => 
            array (
                'id' => 3,
                'phone' => '+8801879762951',
                'token' => '3136',
                'created_at' => '2021-08-21 22:13:02',
                'updated_at' => '2021-08-21 22:13:02',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
            ),
            1 => 
            array (
                'id' => 4,
                'phone' => '+8801700000098',
                'token' => '2852',
                'created_at' => '2022-09-29 12:38:41',
                'updated_at' => '2022-09-29 12:38:41',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
            ),
            2 => 
            array (
                'id' => 5,
                'phone' => '+8801621720011',
                'token' => '984837',
                'created_at' => '2025-02-05 14:56:04',
                'updated_at' => '2025-02-05 14:58:06',
                'otp_hit_count' => 2,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
            ),
            3 => 
            array (
                'id' => 6,
                'phone' => '+8801422332233',
                'token' => '716865',
                'created_at' => '2025-09-14 10:22:06',
                'updated_at' => '2025-09-14 10:22:06',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
            ),
            4 => 
            array (
                'id' => 7,
                'phone' => '+8801783721411',
                'token' => '103933',
                'created_at' => '2025-09-17 17:44:02',
                'updated_at' => '2025-09-17 17:44:02',
                'otp_hit_count' => 0,
                'is_blocked' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
            ),
        ));
        
        
    }
}