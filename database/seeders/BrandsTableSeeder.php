<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('brands')->delete();
        
        \DB::table('brands')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'GrocerGo',
                'slug' => 'the-kroger-company',
                'image' => '2024-10-29-672091117a24c.png',
                'status' => 1,
                'created_at' => '2024-04-20 14:40:43',
                'updated_at' => '2024-10-29 13:38:57',
                'module_id' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Stationary Point',
                'slug' => 'nutri-science',
                'image' => '2024-10-29-6720909aec3c0.png',
                'status' => 1,
                'created_at' => '2024-04-20 14:41:17',
                'updated_at' => '2024-10-29 13:36:58',
                'module_id' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Grocerylia',
                'slug' => 'razer',
                'image' => '2024-10-29-672090fcad137.png',
                'status' => 1,
                'created_at' => '2024-04-20 14:41:43',
                'updated_at' => '2024-10-29 13:38:36',
                'module_id' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'New Market',
                'slug' => 'johnsons-johnsons',
                'image' => '2024-10-29-672090e50c6dd.png',
                'status' => 1,
                'created_at' => '2024-04-20 14:43:56',
                'updated_at' => '2024-10-29 13:38:13',
                'module_id' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Shop Center',
                'slug' => 'canon',
                'image' => '2024-10-29-672090ad5a562.png',
                'status' => 1,
                'created_at' => '2024-04-20 14:44:19',
                'updated_at' => '2024-10-29 13:37:17',
                'module_id' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'One Click Shop',
                'slug' => 'one-click-shop',
                'image' => '2024-10-29-672090d121240.png',
                'status' => 1,
                'created_at' => '2024-04-20 15:18:05',
                'updated_at' => '2024-10-29 13:37:53',
                'module_id' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Glassy Store',
                'slug' => 'glassy-store',
                'image' => '2024-10-29-6720912309365.png',
                'status' => 1,
                'created_at' => '2024-04-20 15:19:32',
                'updated_at' => '2024-10-29 13:39:15',
                'module_id' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Red Basket',
                'slug' => 'green-basket',
                'image' => '2024-10-29-6720924f23b4e.png',
                'status' => 1,
                'created_at' => '2024-10-29 13:44:15',
                'updated_at' => '2024-10-29 15:10:27',
                'module_id' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Urban Threads',
                'slug' => 'urban-threads',
                'image' => '2024-10-29-6720926605a54.png',
                'status' => 1,
                'created_at' => '2024-10-29 13:44:38',
                'updated_at' => '2024-10-29 13:44:38',
                'module_id' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'The Luxe Nest',
                'slug' => 'the-luxe-nest',
                'image' => '2024-10-29-6720927a173b1.png',
                'status' => 1,
                'created_at' => '2024-10-29 13:44:58',
                'updated_at' => '2024-10-29 13:44:58',
                'module_id' => NULL,
            ),
        ));
        
        
    }
}