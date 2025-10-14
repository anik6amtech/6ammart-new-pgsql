<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admins')->delete();
        
        \DB::table('admins')->insert(array (
            0 => 
            array (
                'id' => 1,
                'f_name' => 'Jhon',
                'l_name' => 'Doe',
                'phone' => '01700000000',
                'email' => 'admin@admin.com',
                'image' => '2022-09-29-63357074c12f6.png',
                'password' => '$2y$10$xO9XwBzmLQcTrfXDtfoUN.ItVoVaSEoqA3.FQnqovBvhSlHctia12',
                'remember_token' => NULL,
                'created_at' => '2021-05-08 04:30:27',
                'updated_at' => '2025-10-14 09:54:21',
                'role_id' => 1,
                'zone_id' => NULL,
                'is_logged_in' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'f_name' => 'Rowan',
                'l_name' => 'Morton',
                'phone' => '16102458545',
                'email' => 'Morton@gmail.com',
                'image' => '2022-09-29-63352f6676e42.png',
                'password' => '$2y$10$ed8kOiLfJ5aBGhoToSWXT.X.gaEYgFTh4zLe7QMfPje.V3ynCMpHa',
                'remember_token' => NULL,
                'created_at' => '2022-09-29 11:38:46',
                'updated_at' => '2025-10-07 09:40:21',
                'role_id' => 7,
                'zone_id' => NULL,
                'is_logged_in' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'f_name' => 'Gregory',
                'l_name' => 'Mcclure',
                'phone' => '14844578761',
                'email' => 'Gregory@gmail.com',
                'image' => '2022-09-29-63353003dab2b.png',
                'password' => '$2y$10$Vrz67NYtjg.hxnq1Gd.zqO9YycMpWRAZdqetbAwyvYLRbt9/k8YfO',
                'remember_token' => NULL,
                'created_at' => '2022-09-29 11:41:23',
                'updated_at' => '2022-09-29 11:41:23',
                'role_id' => 3,
                'zone_id' => NULL,
                'is_logged_in' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'f_name' => 'Samson',
                'l_name' => 'Armstrong',
                'phone' => '148445787984',
                'email' => 'Samson@gmail.com',
                'image' => '2022-09-29-633530e1834f8.png',
                'password' => '$2y$10$FGrhWByAH9F1T4O0F8HAS.1hU4ctSTHFDW7Ncb2h4YW4RTgT.HKjy',
                'remember_token' => NULL,
                'created_at' => '2022-09-29 11:45:05',
                'updated_at' => '2022-09-29 11:45:05',
                'role_id' => 4,
                'zone_id' => NULL,
                'is_logged_in' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'f_name' => 'Noel',
                'l_name' => 'Flynn',
                'phone' => '14844578258',
                'email' => 'Noel@gmail.com',
                'image' => '2022-09-29-633531459a5a1.png',
                'password' => '$2y$10$fH3K3w520/GFwCA9kOTE0urcY7K3EfaTlc2OuSoJVd2nPx19Ji1gq',
                'remember_token' => NULL,
                'created_at' => '2022-09-29 11:46:45',
                'updated_at' => '2022-09-29 11:46:45',
                'role_id' => 5,
                'zone_id' => NULL,
                'is_logged_in' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'f_name' => 'Ronnie',
                'l_name' => 'Dickson',
                'phone' => '017370000011',
                'email' => 'Dickson@gmail.com',
                'image' => '2022-09-29-633531e5a3795.png',
                'password' => '$2y$10$B9Rbro7U02SiyeuRzxT3N.u.8vI1S8zPV3kgufZ8K0DuFz0FFcCcO',
                'remember_token' => NULL,
                'created_at' => '2022-09-29 11:49:25',
                'updated_at' => '2022-09-29 11:49:25',
                'role_id' => 6,
                'zone_id' => NULL,
                'is_logged_in' => 1,
            ),
        ));
        
        
    }
}