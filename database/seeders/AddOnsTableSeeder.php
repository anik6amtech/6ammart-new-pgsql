<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AddOnsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('add_ons')->delete();
        
        \DB::table('add_ons')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Cheese',
                'price' => '10.00',
                'created_at' => '2021-08-21 14:19:15',
                'updated_at' => '2021-08-21 14:19:15',
                'store_id' => 45,
                'status' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Cheese',
                'price' => '15.00',
                'created_at' => '2021-08-21 14:19:43',
                'updated_at' => '2021-08-21 14:19:43',
                'store_id' => 46,
                'status' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Cheese',
                'price' => '15.00',
                'created_at' => '2021-08-21 14:20:33',
                'updated_at' => '2021-08-21 14:20:33',
                'store_id' => 53,
                'status' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Coke',
                'price' => '10.00',
                'created_at' => '2021-08-21 14:21:51',
                'updated_at' => '2021-08-21 14:21:51',
                'store_id' => 53,
                'status' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Extra Spice',
                'price' => '5.00',
                'created_at' => '2021-08-21 14:23:05',
                'updated_at' => '2021-08-21 14:23:05',
                'store_id' => 53,
                'status' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Cheese',
                'price' => '10.00',
                'created_at' => '2021-08-21 14:29:48',
                'updated_at' => '2021-08-21 14:29:48',
                'store_id' => 58,
                'status' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Extra Spice',
                'price' => '5.00',
                'created_at' => '2021-08-21 14:30:01',
                'updated_at' => '2021-08-21 14:30:01',
                'store_id' => 58,
                'status' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Extra Chicken',
                'price' => '15.00',
                'created_at' => '2021-08-21 14:30:18',
                'updated_at' => '2021-08-21 14:30:18',
                'store_id' => 58,
                'status' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Extra Beef',
                'price' => '50.00',
                'created_at' => '2021-08-21 15:21:50',
                'updated_at' => '2021-08-21 15:21:50',
                'store_id' => 58,
                'status' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'SALAD',
                'price' => '10.00',
                'created_at' => '2021-08-21 15:22:09',
                'updated_at' => '2021-08-21 15:22:09',
                'store_id' => 58,
                'status' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Sauce',
                'price' => '5.00',
                'created_at' => '2021-08-21 15:22:31',
                'updated_at' => '2021-08-21 15:22:31',
                'store_id' => 58,
                'status' => 1,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'salad',
                'price' => '10.00',
                'created_at' => '2021-08-21 15:27:11',
                'updated_at' => '2021-08-21 15:27:11',
                'store_id' => 45,
                'status' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'extra beef',
                'price' => '40.00',
                'created_at' => '2021-08-21 15:27:32',
                'updated_at' => '2021-08-21 15:27:32',
                'store_id' => 45,
                'status' => 1,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'extra chicken',
                'price' => '30.00',
                'created_at' => '2021-08-21 15:27:45',
                'updated_at' => '2021-08-21 15:27:45',
                'store_id' => 45,
                'status' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'sauce',
                'price' => '5.00',
                'created_at' => '2021-08-21 15:27:55',
                'updated_at' => '2021-08-21 15:27:55',
                'store_id' => 45,
                'status' => 1,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Coke',
                'price' => '15.00',
                'created_at' => '2021-08-21 15:41:15',
                'updated_at' => '2021-08-21 15:41:15',
                'store_id' => 57,
                'status' => 1,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Pepsi',
                'price' => '18.00',
                'created_at' => '2021-08-21 15:41:30',
                'updated_at' => '2021-08-21 15:41:30',
                'store_id' => 57,
                'status' => 1,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Extra Cheese',
                'price' => '19.00',
                'created_at' => '2021-08-21 15:44:11',
                'updated_at' => '2021-08-21 15:44:11',
                'store_id' => 57,
                'status' => 1,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Extra Chicken',
                'price' => '14.00',
                'created_at' => '2021-08-21 16:07:48',
                'updated_at' => '2021-08-21 16:07:48',
                'store_id' => 57,
                'status' => 1,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Extra Meat',
                'price' => '18.00',
                'created_at' => '2021-08-21 16:07:59',
                'updated_at' => '2021-08-21 16:07:59',
                'store_id' => 57,
                'status' => 1,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Sauce',
                'price' => '5.00',
                'created_at' => '2021-08-21 16:13:10',
                'updated_at' => '2021-08-21 16:13:10',
                'store_id' => 52,
                'status' => 1,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Extra Chicken',
                'price' => '39.00',
                'created_at' => '2021-08-21 16:13:25',
                'updated_at' => '2021-08-21 16:13:25',
                'store_id' => 52,
                'status' => 1,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Extra Beef',
                'price' => '50.00',
                'created_at' => '2021-08-21 16:13:35',
                'updated_at' => '2021-08-21 16:13:35',
                'store_id' => 52,
                'status' => 1,
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'salad',
                'price' => '10.00',
                'created_at' => '2021-08-21 16:13:44',
                'updated_at' => '2021-08-21 16:13:44',
                'store_id' => 52,
                'status' => 1,
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Coke',
                'price' => '15.00',
                'created_at' => '2021-08-21 16:18:05',
                'updated_at' => '2021-08-21 16:18:05',
                'store_id' => 58,
                'status' => 1,
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Pepsi',
                'price' => '18.00',
                'created_at' => '2021-08-21 16:18:29',
                'updated_at' => '2021-08-21 16:18:29',
                'store_id' => 58,
                'status' => 1,
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Tomato Sauce',
                'price' => '10.00',
                'created_at' => '2021-08-21 17:01:41',
                'updated_at' => '2021-08-21 17:03:37',
                'store_id' => 54,
                'status' => 1,
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Hot Sauce',
                'price' => '12.00',
                'created_at' => '2021-08-21 17:03:52',
                'updated_at' => '2021-08-21 17:03:52',
                'store_id' => 54,
                'status' => 1,
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Taco Sauce',
                'price' => '11.00',
                'created_at' => '2021-08-21 17:04:26',
                'updated_at' => '2021-08-21 17:04:26',
                'store_id' => 54,
                'status' => 1,
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Coke',
                'price' => '12.00',
                'created_at' => '2021-08-21 17:29:24',
                'updated_at' => '2021-08-21 17:29:24',
                'store_id' => 46,
                'status' => 1,
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Pepsi',
                'price' => '18.00',
                'created_at' => '2021-08-21 17:29:34',
                'updated_at' => '2021-08-21 17:29:34',
                'store_id' => 46,
                'status' => 1,
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Sauce',
                'price' => '11.00',
                'created_at' => '2021-08-21 17:29:59',
                'updated_at' => '2021-08-21 17:29:59',
                'store_id' => 46,
                'status' => 1,
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Extra Spice',
                'price' => '9.00',
                'created_at' => '2021-08-21 17:32:13',
                'updated_at' => '2021-08-21 17:32:13',
                'store_id' => 46,
                'status' => 1,
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Extra Meat',
                'price' => '14.00',
                'created_at' => '2021-08-21 17:32:24',
                'updated_at' => '2021-08-21 17:32:24',
                'store_id' => 46,
                'status' => 1,
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Extra Chicken',
                'price' => '12.00',
                'created_at' => '2021-08-21 17:32:35',
                'updated_at' => '2021-08-21 17:32:35',
                'store_id' => 46,
                'status' => 1,
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Tomato Sauce',
                'price' => '10.00',
                'created_at' => '2021-08-21 17:44:58',
                'updated_at' => '2021-08-21 17:44:58',
                'store_id' => 50,
                'status' => 1,
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Hot Sauce',
                'price' => '12.00',
                'created_at' => '2021-08-21 17:45:07',
                'updated_at' => '2021-08-21 17:45:07',
                'store_id' => 50,
                'status' => 1,
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Soft Drinks',
                'price' => '20.00',
                'created_at' => '2021-08-21 17:45:48',
                'updated_at' => '2021-08-21 17:45:48',
                'store_id' => 50,
                'status' => 1,
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Tomato Sauce',
                'price' => '10.00',
                'created_at' => '2021-08-21 18:20:37',
                'updated_at' => '2021-08-21 18:20:37',
                'store_id' => 47,
                'status' => 1,
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Soft Drinks',
                'price' => '20.00',
                'created_at' => '2021-08-21 20:26:27',
                'updated_at' => '2021-08-21 20:26:27',
                'store_id' => 56,
                'status' => 1,
            ),
        ));
        
        
    }
}