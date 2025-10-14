<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CartsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('carts')->delete();
        
        \DB::table('carts')->insert(array (
            0 => 
            array (
                'id' => 2,
                'user_id' => 146,
                'module_id' => 1,
                'item_id' => 121,
                'is_guest' => 1,
                'add_on_ids' => '"[]"',
                'add_on_qtys' => '"[]"',
                'item_type' => 'App\\Models\\Item',
                'price' => 600.0,
                'quantity' => 2,
                'variation' => '"[]"',
                'created_at' => '2025-09-11 13:15:55',
                'updated_at' => '2025-09-11 13:15:57',
            ),
            1 => 
            array (
                'id' => 4,
                'user_id' => 146,
                'module_id' => 1,
                'item_id' => 15,
                'is_guest' => 1,
                'add_on_ids' => '"[]"',
                'add_on_qtys' => '"[]"',
                'item_type' => 'App\\Models\\Item',
                'price' => 300.0,
                'quantity' => 3,
                'variation' => '"[]"',
                'created_at' => '2025-09-11 13:21:35',
                'updated_at' => '2025-09-11 13:21:39',
            ),
            2 => 
            array (
                'id' => 5,
                'user_id' => 147,
                'module_id' => 1,
                'item_id' => 5,
                'is_guest' => 1,
                'add_on_ids' => '"[]"',
                'add_on_qtys' => '"[]"',
                'item_type' => 'App\\Models\\Item',
                'price' => 20.0,
                'quantity' => 1,
                'variation' => '"[]"',
                'created_at' => '2025-09-11 13:24:31',
                'updated_at' => '2025-09-11 13:24:31',
            ),
            3 => 
            array (
                'id' => 26,
                'user_id' => 32,
                'module_id' => 1,
                'item_id' => 130,
                'is_guest' => 0,
                'add_on_ids' => '"[]"',
                'add_on_qtys' => '"[]"',
                'item_type' => 'App\\Models\\Item',
                'price' => 46.0,
                'quantity' => 1,
                'variation' => '"[]"',
                'created_at' => '2025-10-09 17:21:25',
                'updated_at' => '2025-10-09 17:21:25',
            ),
        ));
        
        
    }
}