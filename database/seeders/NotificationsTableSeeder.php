<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notifications')->delete();
        
        \DB::table('notifications')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Hello customer',
                'description' => 'Hello customer, 
Now we have a 30 % discount on all Japanese food.',
                'image' => '2022-09-29-63356e4dc0267.png',
                'status' => 1,
                'created_at' => '2022-09-29 16:07:09',
                'updated_at' => '2022-09-29 16:07:09',
                'tergat' => 'customer',
                'zone_id' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Hello All Store',
                'description' => 'We have a buy-one-get-one offer going on now. You can join it.',
                'image' => '2022-09-29-63356f4b7e82b.png',
                'status' => 1,
                'created_at' => '2022-09-29 16:11:23',
                'updated_at' => '2022-09-29 16:11:23',
                'tergat' => 'store',
                'zone_id' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Hello customer',
                'description' => 'We just spotted your favourite festive products at a great deal.',
                'image' => NULL,
                'status' => 1,
                'created_at' => '2022-09-29 16:23:41',
                'updated_at' => '2022-09-29 16:23:41',
                'tergat' => 'customer',
                'zone_id' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Hello customer',
                'description' => 'Get the best car for rent with 20% discount.',
                'image' => '2025-02-05-67a3498b233c9.png',
                'status' => 1,
                'created_at' => '2025-02-05 17:20:43',
                'updated_at' => '2025-02-05 17:20:43',
                'tergat' => 'customer',
                'zone_id' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'y',
                'description' => 'tyyty',
                'image' => '2025-09-17-68ca47a693b77.png',
                'status' => 1,
                'created_at' => '2025-09-17 11:31:18',
                'updated_at' => '2025-09-17 11:31:18',
                'tergat' => 'deliveryman',
                'zone_id' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'title' => 'test notification 22',
                'description' => 'this jis test for our user.',
                'image' => '2025-09-17-68ca47ffe6291.png',
                'status' => 1,
                'created_at' => '2025-09-17 11:32:47',
                'updated_at' => '2025-09-17 11:32:47',
                'tergat' => 'customer',
                'zone_id' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'title' => 'test notification 225',
                'description' => 'This is for test.',
                'image' => '2025-09-17-68ca52cdce20e.png',
                'status' => 1,
                'created_at' => '2025-09-17 12:18:53',
                'updated_at' => '2025-09-17 12:18:53',
                'tergat' => 'store',
                'zone_id' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'title' => 'test notification',
                'description' => 'gfdhggh',
                'image' => '2025-09-17-68ca567d6c61b.png',
                'status' => 1,
                'created_at' => '2025-09-17 12:34:37',
                'updated_at' => '2025-09-17 12:34:37',
                'tergat' => 'customer',
                'zone_id' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'title' => 'test',
                'description' => '321321132321',
                'image' => '2025-09-21-68cf8292eeccb.png',
                'status' => 1,
                'created_at' => '2025-09-21 10:44:02',
                'updated_at' => '2025-09-21 10:44:41',
                'tergat' => 'customer',
                'zone_id' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'title' => 'test ser',
                'description' => 'raerrewrewrewrewrew',
                'image' => '2025-09-22-68d123fc1015a.png',
                'status' => 1,
                'created_at' => '2025-09-22 16:25:00',
                'updated_at' => '2025-09-22 16:25:36',
                'tergat' => 'serviceman',
                'zone_id' => 1,
            ),
        ));
        
        
    }
}