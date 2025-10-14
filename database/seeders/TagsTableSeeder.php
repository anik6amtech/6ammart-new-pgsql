<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tags')->delete();
        
        \DB::table('tags')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tag' => 'Lunch',
                'created_at' => '2023-01-17 16:22:41',
                'updated_at' => '2023-01-17 16:22:41',
            ),
            1 => 
            array (
                'id' => 2,
                'tag' => 'Chicken',
                'created_at' => '2023-01-17 16:22:56',
                'updated_at' => '2023-01-17 16:22:56',
            ),
            2 => 
            array (
                'id' => 3,
                'tag' => 'Dinner',
                'created_at' => '2023-01-17 16:24:31',
                'updated_at' => '2023-01-17 16:24:31',
            ),
            3 => 
            array (
                'id' => 4,
                'tag' => 'pizza',
                'created_at' => '2023-01-17 16:24:32',
                'updated_at' => '2023-01-17 16:24:32',
            ),
            4 => 
            array (
                'id' => 5,
                'tag' => 'Shawarma',
                'created_at' => '2023-01-17 16:26:07',
                'updated_at' => '2023-01-17 16:26:07',
            ),
            5 => 
            array (
                'id' => 6,
                'tag' => 'Desert',
                'created_at' => '2023-01-17 16:27:31',
                'updated_at' => '2023-01-17 16:27:31',
            ),
            6 => 
            array (
                'id' => 7,
                'tag' => 'Sweet',
                'created_at' => '2023-01-17 16:27:31',
                'updated_at' => '2023-01-17 16:27:31',
            ),
            7 => 
            array (
                'id' => 8,
                'tag' => 'icecream',
                'created_at' => '2023-01-17 16:27:31',
                'updated_at' => '2023-01-17 16:27:31',
            ),
            8 => 
            array (
                'id' => 9,
                'tag' => 'Breakfast',
                'created_at' => '2023-01-17 16:30:46',
                'updated_at' => '2023-01-17 16:30:46',
            ),
            9 => 
            array (
                'id' => 10,
                'tag' => 'Rice',
                'created_at' => '2023-01-17 16:34:38',
                'updated_at' => '2023-01-17 16:34:38',
            ),
            10 => 
            array (
                'id' => 11,
                'tag' => 'Blender',
                'created_at' => '2023-01-18 10:32:24',
                'updated_at' => '2023-01-18 10:32:24',
            ),
            11 => 
            array (
                'id' => 12,
                'tag' => 'Accessories',
                'created_at' => '2023-01-18 10:32:24',
                'updated_at' => '2023-01-18 10:32:24',
            ),
            12 => 
            array (
                'id' => 13,
                'tag' => 'Fruits ',
                'created_at' => '2023-01-18 10:32:52',
                'updated_at' => '2023-01-18 10:32:52',
            ),
            13 => 
            array (
                'id' => 14,
                'tag' => 'Fruit',
                'created_at' => '2023-01-18 10:32:52',
                'updated_at' => '2023-01-18 10:32:52',
            ),
            14 => 
            array (
                'id' => 15,
                'tag' => 'vegetables',
                'created_at' => '2023-01-18 10:34:11',
                'updated_at' => '2023-01-18 10:34:11',
            ),
            15 => 
            array (
                'id' => 16,
                'tag' => 'Imported ',
                'created_at' => '2023-01-18 10:35:16',
                'updated_at' => '2023-01-18 10:35:16',
            ),
            16 => 
            array (
                'id' => 17,
                'tag' => 'Orange',
                'created_at' => '2023-01-18 10:35:16',
                'updated_at' => '2023-01-18 10:35:16',
            ),
            17 => 
            array (
                'id' => 18,
                'tag' => 'Fish',
                'created_at' => '2023-01-18 10:39:15',
                'updated_at' => '2023-01-18 10:39:15',
            ),
            18 => 
            array (
                'id' => 19,
                'tag' => 'Powder',
                'created_at' => '2023-01-18 10:45:07',
                'updated_at' => '2023-01-18 10:45:07',
            ),
            19 => 
            array (
                'id' => 20,
                'tag' => 'Rubik ',
                'created_at' => '2023-01-18 10:49:21',
                'updated_at' => '2023-01-18 10:49:21',
            ),
            20 => 
            array (
                'id' => 21,
                'tag' => 'Rubiks ',
                'created_at' => '2023-01-18 10:49:21',
                'updated_at' => '2023-01-18 10:49:21',
            ),
            21 => 
            array (
                'id' => 22,
                'tag' => 'Cube',
                'created_at' => '2023-01-18 10:49:21',
                'updated_at' => '2023-01-18 10:49:21',
            ),
            22 => 
            array (
                'id' => 23,
                'tag' => 'Mint',
                'created_at' => '2023-01-18 10:58:45',
                'updated_at' => '2023-01-18 10:58:45',
            ),
            23 => 
            array (
                'id' => 24,
                'tag' => 'Bread',
                'created_at' => '2023-01-18 11:00:43',
                'updated_at' => '2023-01-18 11:00:43',
            ),
            24 => 
            array (
                'id' => 25,
                'tag' => 'Oil',
                'created_at' => '2023-01-18 11:01:49',
                'updated_at' => '2023-01-18 11:01:49',
            ),
            25 => 
            array (
                'id' => 26,
                'tag' => 'honey ',
                'created_at' => '2023-01-18 11:02:30',
                'updated_at' => '2023-01-18 11:02:30',
            ),
            26 => 
            array (
                'id' => 27,
                'tag' => 'Spoon ',
                'created_at' => '2023-01-18 11:04:24',
                'updated_at' => '2023-01-18 11:04:24',
            ),
            27 => 
            array (
                'id' => 28,
                'tag' => 'Knife',
                'created_at' => '2023-01-18 11:04:24',
                'updated_at' => '2023-01-18 11:04:24',
            ),
            28 => 
            array (
                'id' => 29,
                'tag' => 'Medicine',
                'created_at' => '2023-01-18 11:20:50',
                'updated_at' => '2023-01-18 11:20:50',
            ),
            29 => 
            array (
                'id' => 30,
                'tag' => 'Temperature',
                'created_at' => '2023-01-18 11:31:36',
                'updated_at' => '2023-01-18 11:31:36',
            ),
            30 => 
            array (
                'id' => 31,
                'tag' => 'Vitamins',
                'created_at' => '2023-01-18 11:32:39',
                'updated_at' => '2023-01-18 11:32:39',
            ),
            31 => 
            array (
                'id' => 32,
                'tag' => 'Nurtrition',
                'created_at' => '2023-01-18 11:35:21',
                'updated_at' => '2023-01-18 11:35:21',
            ),
            32 => 
            array (
                'id' => 33,
                'tag' => 'Vitamin',
                'created_at' => '2023-01-18 11:36:00',
                'updated_at' => '2023-01-18 11:36:00',
            ),
            33 => 
            array (
                'id' => 34,
                'tag' => 'oximetry',
                'created_at' => '2023-01-18 11:37:51',
                'updated_at' => '2023-01-18 11:37:51',
            ),
            34 => 
            array (
                'id' => 35,
                'tag' => 'Gift',
                'created_at' => '2023-01-18 11:45:14',
                'updated_at' => '2023-01-18 11:45:14',
            ),
            35 => 
            array (
                'id' => 36,
                'tag' => 'Table',
                'created_at' => '2023-01-18 11:47:18',
                'updated_at' => '2023-01-18 11:47:18',
            ),
            36 => 
            array (
                'id' => 37,
                'tag' => 'body wash',
                'created_at' => '2023-01-18 11:48:56',
                'updated_at' => '2023-01-18 11:48:56',
            ),
            37 => 
            array (
                'id' => 38,
                'tag' => 'bodywash',
                'created_at' => '2023-01-18 11:48:56',
                'updated_at' => '2023-01-18 11:48:56',
            ),
            38 => 
            array (
                'id' => 39,
                'tag' => 'luggage',
                'created_at' => '2023-01-18 11:50:08',
                'updated_at' => '2023-01-18 11:50:08',
            ),
            39 => 
            array (
                'id' => 40,
                'tag' => 'Noodles',
                'created_at' => '2023-01-18 11:59:25',
                'updated_at' => '2023-01-18 11:59:25',
            ),
            40 => 
            array (
                'id' => 41,
                'tag' => 'recipe',
                'created_at' => '2023-01-18 12:05:15',
                'updated_at' => '2023-01-18 12:05:15',
            ),
            41 => 
            array (
                'id' => 42,
                'tag' => 'spicy',
                'created_at' => '2023-01-18 12:08:44',
                'updated_at' => '2023-01-18 12:08:44',
            ),
            42 => 
            array (
                'id' => 43,
                'tag' => '  Orange',
                'created_at' => '2023-10-19 13:22:46',
                'updated_at' => '2023-10-19 13:22:46',
            ),
            43 => 
            array (
                'id' => 44,
                'tag' => '  Rubiks ',
                'created_at' => '2024-04-20 14:30:04',
                'updated_at' => '2024-04-20 14:30:04',
            ),
            44 => 
            array (
                'id' => 45,
                'tag' => '  Cube',
                'created_at' => '2024-04-20 14:30:04',
                'updated_at' => '2024-04-20 14:30:04',
            ),
            45 => 
            array (
                'id' => 46,
                'tag' => '  Breakfast',
                'created_at' => '2024-04-20 14:31:12',
                'updated_at' => '2024-04-20 14:31:12',
            ),
            46 => 
            array (
                'id' => 47,
                'tag' => '  Fruit',
                'created_at' => '2024-04-20 14:33:39',
                'updated_at' => '2024-04-20 14:33:39',
            ),
            47 => 
            array (
                'id' => 48,
                'tag' => '    Orange',
                'created_at' => '2024-04-20 14:33:45',
                'updated_at' => '2024-04-20 14:33:45',
            ),
            48 => 
            array (
                'id' => 49,
                'tag' => '  Chicken',
                'created_at' => '2024-09-24 10:44:48',
                'updated_at' => '2024-09-24 10:44:48',
            ),
            49 => 
            array (
                'id' => 50,
                'tag' => '    Fruit',
                'created_at' => '2024-09-24 10:48:56',
                'updated_at' => '2024-09-24 10:48:56',
            ),
            50 => 
            array (
                'id' => 51,
                'tag' => '      Orange',
                'created_at' => '2024-09-24 10:51:08',
                'updated_at' => '2024-09-24 10:51:08',
            ),
            51 => 
            array (
                'id' => 52,
                'tag' => 'bedrooms',
                'created_at' => '2025-09-04 05:28:08',
                'updated_at' => '2025-09-04 05:28:08',
            ),
            52 => 
            array (
                'id' => 53,
                'tag' => ' living room',
                'created_at' => '2025-09-04 05:28:08',
                'updated_at' => '2025-09-04 05:28:08',
            ),
            53 => 
            array (
                'id' => 54,
                'tag' => ' kitchen',
                'created_at' => '2025-09-04 05:28:08',
                'updated_at' => '2025-09-04 05:28:08',
            ),
            54 => 
            array (
                'id' => 55,
                'tag' => ' bathroom',
                'created_at' => '2025-09-04 05:28:08',
                'updated_at' => '2025-09-04 05:28:08',
            ),
            55 => 
            array (
                'id' => 56,
                'tag' => 'Floor',
                'created_at' => '2025-09-04 05:30:18',
                'updated_at' => '2025-09-04 05:30:18',
            ),
            56 => 
            array (
                'id' => 57,
                'tag' => ' scrubbing',
                'created_at' => '2025-09-04 05:30:18',
                'updated_at' => '2025-09-04 05:30:18',
            ),
            57 => 
            array (
                'id' => 58,
                'tag' => 'polishing',
                'created_at' => '2025-09-04 05:30:18',
                'updated_at' => '2025-09-04 05:30:18',
            ),
            58 => 
            array (
                'id' => 59,
                'tag' => 'Carpet deep shampooing',
                'created_at' => '2025-09-04 05:33:41',
                'updated_at' => '2025-09-04 05:33:41',
            ),
            59 => 
            array (
                'id' => 60,
                'tag' => '  scrubbing',
                'created_at' => '2025-09-04 05:54:46',
                'updated_at' => '2025-09-04 05:54:46',
            ),
            60 => 
            array (
                'id' => 61,
                'tag' => ' polishing',
                'created_at' => '2025-09-04 05:54:46',
                'updated_at' => '2025-09-04 05:54:46',
            ),
            61 => 
            array (
                'id' => 62,
                'tag' => '  living room',
                'created_at' => '2025-09-04 05:55:07',
                'updated_at' => '2025-09-04 05:55:07',
            ),
            62 => 
            array (
                'id' => 63,
                'tag' => '  kitchen',
                'created_at' => '2025-09-04 05:55:07',
                'updated_at' => '2025-09-04 05:55:07',
            ),
            63 => 
            array (
                'id' => 64,
                'tag' => '  bathroom',
                'created_at' => '2025-09-04 05:55:07',
                'updated_at' => '2025-09-04 05:55:07',
            ),
            64 => 
            array (
                'id' => 65,
                'tag' => 'Dolores id dignissim',
                'created_at' => '2025-09-09 11:04:25',
                'updated_at' => '2025-09-09 11:04:25',
            ),
            65 => 
            array (
                'id' => 66,
                'tag' => 'Quis error voluptate',
                'created_at' => '2025-09-09 11:04:25',
                'updated_at' => '2025-09-09 11:04:25',
            ),
            66 => 
            array (
                'id' => 67,
                'tag' => 'Non voluptatem qui t',
                'created_at' => '2025-09-09 11:04:25',
                'updated_at' => '2025-09-09 11:04:25',
            ),
            67 => 
            array (
                'id' => 68,
                'tag' => 'Eum ratione ea quo s',
                'created_at' => '2025-09-09 11:04:26',
                'updated_at' => '2025-09-09 11:04:26',
            ),
            68 => 
            array (
                'id' => 69,
                'tag' => 'Quae qui nostrum mol',
                'created_at' => '2025-09-09 11:04:26',
                'updated_at' => '2025-09-09 11:04:26',
            ),
            69 => 
            array (
                'id' => 70,
                'tag' => 'cleaning',
                'created_at' => '2025-09-09 11:18:45',
                'updated_at' => '2025-09-09 11:18:45',
            ),
            70 => 
            array (
                'id' => 71,
                'tag' => 'service',
                'created_at' => '2025-09-09 11:18:45',
                'updated_at' => '2025-09-09 11:18:45',
            ),
            71 => 
            array (
                'id' => 72,
                'tag' => 'fan',
                'created_at' => '2025-09-09 11:28:50',
                'updated_at' => '2025-09-09 11:28:50',
            ),
            72 => 
            array (
                'id' => 73,
                'tag' => 'fan service',
                'created_at' => '2025-09-09 11:28:50',
                'updated_at' => '2025-09-09 11:28:50',
            ),
            73 => 
            array (
                'id' => 74,
                'tag' => 'electric',
                'created_at' => '2025-09-09 11:32:21',
                'updated_at' => '2025-09-09 11:32:21',
            ),
            74 => 
            array (
                'id' => 75,
                'tag' => 'Magna dolorem mollit',
                'created_at' => '2025-09-17 10:50:52',
                'updated_at' => '2025-09-17 10:50:52',
            ),
            75 => 
            array (
                'id' => 76,
                'tag' => 'Aut et vel dolorem r',
                'created_at' => '2025-09-17 10:50:52',
                'updated_at' => '2025-09-17 10:50:52',
            ),
            76 => 
            array (
                'id' => 77,
                'tag' => '   living room',
                'created_at' => '2025-09-20 16:47:21',
                'updated_at' => '2025-09-20 16:47:21',
            ),
            77 => 
            array (
                'id' => 78,
                'tag' => '   kitchen',
                'created_at' => '2025-09-20 16:47:21',
                'updated_at' => '2025-09-20 16:47:21',
            ),
            78 => 
            array (
                'id' => 79,
                'tag' => '   bathroom',
                'created_at' => '2025-09-20 16:47:21',
                'updated_at' => '2025-09-20 16:47:21',
            ),
            79 => 
            array (
                'id' => 80,
                'tag' => '    living room',
                'created_at' => '2025-09-20 16:48:08',
                'updated_at' => '2025-09-20 16:48:08',
            ),
            80 => 
            array (
                'id' => 81,
                'tag' => '    kitchen',
                'created_at' => '2025-09-20 16:48:08',
                'updated_at' => '2025-09-20 16:48:08',
            ),
            81 => 
            array (
                'id' => 82,
                'tag' => '    bathroom',
                'created_at' => '2025-09-20 16:48:08',
                'updated_at' => '2025-09-20 16:48:08',
            ),
            82 => 
            array (
                'id' => 83,
                'tag' => '     living room',
                'created_at' => '2025-09-23 10:37:47',
                'updated_at' => '2025-09-23 10:37:47',
            ),
            83 => 
            array (
                'id' => 84,
                'tag' => '     kitchen',
                'created_at' => '2025-09-23 10:37:47',
                'updated_at' => '2025-09-23 10:37:47',
            ),
            84 => 
            array (
                'id' => 85,
                'tag' => '     bathroom',
                'created_at' => '2025-09-23 10:37:47',
                'updated_at' => '2025-09-23 10:37:47',
            ),
            85 => 
            array (
                'id' => 86,
                'tag' => 'Impedit consequatur',
                'created_at' => '2025-09-28 11:05:42',
                'updated_at' => '2025-09-28 11:05:42',
            ),
            86 => 
            array (
                'id' => 87,
                'tag' => 'Sed irure commodi ev',
                'created_at' => '2025-09-28 11:05:42',
                'updated_at' => '2025-09-28 11:05:42',
            ),
            87 => 
            array (
                'id' => 88,
                'tag' => '      living room',
                'created_at' => '2025-10-11 10:33:20',
                'updated_at' => '2025-10-11 10:33:20',
            ),
            88 => 
            array (
                'id' => 89,
                'tag' => '      kitchen',
                'created_at' => '2025-10-11 10:33:20',
                'updated_at' => '2025-10-11 10:33:20',
            ),
            89 => 
            array (
                'id' => 90,
                'tag' => '      bathroom',
                'created_at' => '2025-10-11 10:33:20',
                'updated_at' => '2025-10-11 10:33:20',
            ),
            90 => 
            array (
                'id' => 91,
                'tag' => '       living room',
                'created_at' => '2025-10-11 10:35:36',
                'updated_at' => '2025-10-11 10:35:36',
            ),
            91 => 
            array (
                'id' => 92,
                'tag' => '       kitchen',
                'created_at' => '2025-10-11 10:35:36',
                'updated_at' => '2025-10-11 10:35:36',
            ),
            92 => 
            array (
                'id' => 93,
                'tag' => '       bathroom',
                'created_at' => '2025-10-11 10:35:36',
                'updated_at' => '2025-10-11 10:35:36',
            ),
        ));
        
        
    }
}