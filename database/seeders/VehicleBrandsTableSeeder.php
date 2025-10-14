<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VehicleBrandsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('vehicle_brands')->delete();
        
        \DB::table('vehicle_brands')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Toyota',
                'image' => '2025-02-05-67a3306896559.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:33:28',
                'updated_at' => '2025-02-05 15:33:28',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Honda',
                'image' => '2025-02-05-67a3308187198.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:33:53',
                'updated_at' => '2025-02-05 15:33:53',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'BMW',
                'image' => '2025-02-05-67a3309896634.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:34:16',
                'updated_at' => '2025-02-05 15:34:16',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Mercedes-Benz',
                'image' => '2025-02-05-67a330d8b8956.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:35:20',
                'updated_at' => '2025-02-05 15:35:20',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Audi',
                'image' => '2025-02-05-67a330f2f0ea5.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:35:47',
                'updated_at' => '2025-02-05 15:35:47',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Ford',
                'image' => '2025-02-05-67a33113562e3.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:36:19',
                'updated_at' => '2025-02-05 15:36:19',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Chevrolet',
                'image' => '2025-02-05-67a331261c331.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:36:38',
                'updated_at' => '2025-02-05 15:36:38',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Nissan',
                'image' => '2025-02-05-67a3313cb2997.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:37:00',
                'updated_at' => '2025-02-05 15:37:00',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Hyundai',
                'image' => '2025-02-05-67a33152064df.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:37:22',
                'updated_at' => '2025-02-05 15:37:22',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Tesla',
                'image' => '2025-02-05-67a331679c222.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:37:43',
                'updated_at' => '2025-02-05 15:37:43',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Land Rover',
                'image' => '2025-02-05-67a3317f1ba89.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:38:07',
                'updated_at' => '2025-02-05 15:38:07',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Porsche',
                'image' => '2025-02-05-67a3319a12feb.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:38:34',
                'updated_at' => '2025-02-05 15:38:34',
            ),
        ));
        
        
    }
}