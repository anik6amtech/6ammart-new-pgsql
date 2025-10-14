<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VehicleCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('vehicle_categories')->delete();
        
        \DB::table('vehicle_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Standard Sedan',
                'image' => '2025-02-05-67a32ee01ec2e.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:26:56',
                'updated_at' => '2025-02-05 15:26:56',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Luxury Sedan',
                'image' => '2025-02-05-67a32f00b0e28.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:27:28',
                'updated_at' => '2025-02-05 15:27:28',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'SUV',
                'image' => '2025-02-05-67a32f2447401.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:28:04',
                'updated_at' => '2025-02-05 15:28:04',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Minivan',
                'image' => '2025-02-05-67a32f3829a4d.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:28:24',
                'updated_at' => '2025-02-05 15:28:24',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Premium SUV',
                'image' => '2025-02-05-67a32f71a0f0b.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:29:21',
                'updated_at' => '2025-02-05 15:29:21',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Executive Sedan',
                'image' => '2025-02-05-67a32f8f69340.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:29:51',
                'updated_at' => '2025-02-05 15:29:51',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Electric Car',
                'image' => '2025-02-05-67a32faaefe23.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:30:18',
                'updated_at' => '2025-02-05 15:30:18',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Family Van',
                'image' => '2025-02-05-67a32fc64426e.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:30:46',
                'updated_at' => '2025-02-05 15:30:46',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Limousine',
                'image' => '2025-02-05-67a32fe3e07b8.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:31:15',
                'updated_at' => '2025-02-05 15:31:15',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Crossover',
                'image' => '2025-02-05-67a32ffce3535.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:31:40',
                'updated_at' => '2025-02-05 15:31:40',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Luxury Minibus',
                'image' => '2025-02-05-67a3301d4e52d.png',
                'status' => 1,
                'created_at' => '2025-02-05 15:32:13',
                'updated_at' => '2025-02-05 15:32:13',
            ),
        ));
        
        
    }
}