<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TempRideNotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('temp_ride_notifications')->delete();
        
        \DB::table('temp_ride_notifications')->insert(array (
            0 => 
            array (
                'id' => 1,
                'ride_request_id' => 1,
                'user_id' => 1,
                'user_type' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'ride_request_id' => 3,
                'user_id' => 1,
                'user_type' => NULL,
            ),
            2 => 
            array (
                'id' => 4,
                'ride_request_id' => 4,
                'user_id' => 1,
                'user_type' => NULL,
            ),
            3 => 
            array (
                'id' => 5,
                'ride_request_id' => 5,
                'user_id' => 1,
                'user_type' => NULL,
            ),
            4 => 
            array (
                'id' => 6,
                'ride_request_id' => 6,
                'user_id' => 1,
                'user_type' => NULL,
            ),
            5 => 
            array (
                'id' => 7,
                'ride_request_id' => 7,
                'user_id' => 1,
                'user_type' => NULL,
            ),
            6 => 
            array (
                'id' => 9,
                'ride_request_id' => 9,
                'user_id' => 1,
                'user_type' => NULL,
            ),
            7 => 
            array (
                'id' => 10,
                'ride_request_id' => 10,
                'user_id' => 1,
                'user_type' => NULL,
            ),
            8 => 
            array (
                'id' => 12,
                'ride_request_id' => 12,
                'user_id' => 10,
                'user_type' => NULL,
            ),
            9 => 
            array (
                'id' => 13,
                'ride_request_id' => 12,
                'user_id' => 1,
                'user_type' => NULL,
            ),
            10 => 
            array (
                'id' => 18,
                'ride_request_id' => 15,
                'user_id' => 10,
                'user_type' => NULL,
            ),
            11 => 
            array (
                'id' => 19,
                'ride_request_id' => 15,
                'user_id' => 1,
                'user_type' => NULL,
            ),
            12 => 
            array (
                'id' => 30,
                'ride_request_id' => 21,
                'user_id' => 10,
                'user_type' => NULL,
            ),
            13 => 
            array (
                'id' => 31,
                'ride_request_id' => 21,
                'user_id' => 1,
                'user_type' => NULL,
            ),
            14 => 
            array (
                'id' => 32,
                'ride_request_id' => 22,
                'user_id' => 10,
                'user_type' => NULL,
            ),
            15 => 
            array (
                'id' => 33,
                'ride_request_id' => 22,
                'user_id' => 1,
                'user_type' => NULL,
            ),
            16 => 
            array (
                'id' => 36,
                'ride_request_id' => 25,
                'user_id' => 11,
                'user_type' => NULL,
            ),
            17 => 
            array (
                'id' => 37,
                'ride_request_id' => 26,
                'user_id' => 11,
                'user_type' => NULL,
            ),
            18 => 
            array (
                'id' => 40,
                'ride_request_id' => 35,
                'user_id' => 9,
                'user_type' => NULL,
            ),
            19 => 
            array (
                'id' => 41,
                'ride_request_id' => 35,
                'user_id' => 1,
                'user_type' => NULL,
            ),
            20 => 
            array (
                'id' => 42,
                'ride_request_id' => 35,
                'user_id' => 10,
                'user_type' => NULL,
            ),
            21 => 
            array (
                'id' => 43,
                'ride_request_id' => 36,
                'user_id' => 9,
                'user_type' => NULL,
            ),
            22 => 
            array (
                'id' => 44,
                'ride_request_id' => 36,
                'user_id' => 1,
                'user_type' => NULL,
            ),
            23 => 
            array (
                'id' => 45,
                'ride_request_id' => 36,
                'user_id' => 10,
                'user_type' => NULL,
            ),
            24 => 
            array (
                'id' => 46,
                'ride_request_id' => 37,
                'user_id' => 9,
                'user_type' => NULL,
            ),
            25 => 
            array (
                'id' => 47,
                'ride_request_id' => 37,
                'user_id' => 1,
                'user_type' => NULL,
            ),
            26 => 
            array (
                'id' => 48,
                'ride_request_id' => 37,
                'user_id' => 10,
                'user_type' => NULL,
            ),
            27 => 
            array (
                'id' => 49,
                'ride_request_id' => 38,
                'user_id' => 9,
                'user_type' => NULL,
            ),
            28 => 
            array (
                'id' => 50,
                'ride_request_id' => 38,
                'user_id' => 1,
                'user_type' => NULL,
            ),
            29 => 
            array (
                'id' => 51,
                'ride_request_id' => 38,
                'user_id' => 10,
                'user_type' => NULL,
            ),
            30 => 
            array (
                'id' => 52,
                'ride_request_id' => 39,
                'user_id' => 9,
                'user_type' => NULL,
            ),
            31 => 
            array (
                'id' => 53,
                'ride_request_id' => 39,
                'user_id' => 1,
                'user_type' => NULL,
            ),
            32 => 
            array (
                'id' => 54,
                'ride_request_id' => 39,
                'user_id' => 10,
                'user_type' => NULL,
            ),
            33 => 
            array (
                'id' => 55,
                'ride_request_id' => 40,
                'user_id' => 9,
                'user_type' => NULL,
            ),
            34 => 
            array (
                'id' => 56,
                'ride_request_id' => 40,
                'user_id' => 1,
                'user_type' => NULL,
            ),
            35 => 
            array (
                'id' => 57,
                'ride_request_id' => 40,
                'user_id' => 10,
                'user_type' => NULL,
            ),
            36 => 
            array (
                'id' => 58,
                'ride_request_id' => 41,
                'user_id' => 9,
                'user_type' => NULL,
            ),
            37 => 
            array (
                'id' => 59,
                'ride_request_id' => 41,
                'user_id' => 1,
                'user_type' => NULL,
            ),
            38 => 
            array (
                'id' => 60,
                'ride_request_id' => 41,
                'user_id' => 10,
                'user_type' => NULL,
            ),
            39 => 
            array (
                'id' => 61,
                'ride_request_id' => 42,
                'user_id' => 9,
                'user_type' => NULL,
            ),
            40 => 
            array (
                'id' => 62,
                'ride_request_id' => 42,
                'user_id' => 1,
                'user_type' => NULL,
            ),
            41 => 
            array (
                'id' => 63,
                'ride_request_id' => 42,
                'user_id' => 10,
                'user_type' => NULL,
            ),
            42 => 
            array (
                'id' => 64,
                'ride_request_id' => 43,
                'user_id' => 9,
                'user_type' => NULL,
            ),
            43 => 
            array (
                'id' => 65,
                'ride_request_id' => 43,
                'user_id' => 1,
                'user_type' => NULL,
            ),
            44 => 
            array (
                'id' => 66,
                'ride_request_id' => 43,
                'user_id' => 10,
                'user_type' => NULL,
            ),
            45 => 
            array (
                'id' => 76,
                'ride_request_id' => 47,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            46 => 
            array (
                'id' => 77,
                'ride_request_id' => 47,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            47 => 
            array (
                'id' => 80,
                'ride_request_id' => 50,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            48 => 
            array (
                'id' => 81,
                'ride_request_id' => 51,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            49 => 
            array (
                'id' => 83,
                'ride_request_id' => 52,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            50 => 
            array (
                'id' => 84,
                'ride_request_id' => 53,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            51 => 
            array (
                'id' => 85,
                'ride_request_id' => 54,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            52 => 
            array (
                'id' => 86,
                'ride_request_id' => 55,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            53 => 
            array (
                'id' => 87,
                'ride_request_id' => 56,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            54 => 
            array (
                'id' => 89,
                'ride_request_id' => 57,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            55 => 
            array (
                'id' => 97,
                'ride_request_id' => 60,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            56 => 
            array (
                'id' => 102,
                'ride_request_id' => 63,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            57 => 
            array (
                'id' => 116,
                'ride_request_id' => 74,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            58 => 
            array (
                'id' => 118,
                'ride_request_id' => 75,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            59 => 
            array (
                'id' => 130,
                'ride_request_id' => 88,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            60 => 
            array (
                'id' => 132,
                'ride_request_id' => 89,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            61 => 
            array (
                'id' => 136,
                'ride_request_id' => 91,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            62 => 
            array (
                'id' => 140,
                'ride_request_id' => 93,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            63 => 
            array (
                'id' => 146,
                'ride_request_id' => 96,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            64 => 
            array (
                'id' => 148,
                'ride_request_id' => 97,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            65 => 
            array (
                'id' => 150,
                'ride_request_id' => 98,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            66 => 
            array (
                'id' => 157,
                'ride_request_id' => 102,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            67 => 
            array (
                'id' => 160,
                'ride_request_id' => 103,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            68 => 
            array (
                'id' => 162,
                'ride_request_id' => 104,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            69 => 
            array (
                'id' => 166,
                'ride_request_id' => 107,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            70 => 
            array (
                'id' => 169,
                'ride_request_id' => 109,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            71 => 
            array (
                'id' => 171,
                'ride_request_id' => 110,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            72 => 
            array (
                'id' => 195,
                'ride_request_id' => 155,
                'user_id' => 10,
                'user_type' => 'driver',
            ),
            73 => 
            array (
                'id' => 197,
                'ride_request_id' => 155,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            74 => 
            array (
                'id' => 202,
                'ride_request_id' => 157,
                'user_id' => 10,
                'user_type' => 'driver',
            ),
            75 => 
            array (
                'id' => 203,
                'ride_request_id' => 157,
                'user_id' => 16,
                'user_type' => 'driver',
            ),
            76 => 
            array (
                'id' => 205,
                'ride_request_id' => 158,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            77 => 
            array (
                'id' => 206,
                'ride_request_id' => 158,
                'user_id' => 10,
                'user_type' => 'driver',
            ),
            78 => 
            array (
                'id' => 207,
                'ride_request_id' => 158,
                'user_id' => 16,
                'user_type' => 'driver',
            ),
            79 => 
            array (
                'id' => 209,
                'ride_request_id' => 159,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            80 => 
            array (
                'id' => 210,
                'ride_request_id' => 159,
                'user_id' => 10,
                'user_type' => 'driver',
            ),
            81 => 
            array (
                'id' => 211,
                'ride_request_id' => 159,
                'user_id' => 16,
                'user_type' => 'driver',
            ),
            82 => 
            array (
                'id' => 219,
                'ride_request_id' => 162,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            83 => 
            array (
                'id' => 220,
                'ride_request_id' => 162,
                'user_id' => 10,
                'user_type' => 'driver',
            ),
            84 => 
            array (
                'id' => 221,
                'ride_request_id' => 162,
                'user_id' => 16,
                'user_type' => 'driver',
            ),
            85 => 
            array (
                'id' => 235,
                'ride_request_id' => 165,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            86 => 
            array (
                'id' => 236,
                'ride_request_id' => 165,
                'user_id' => 10,
                'user_type' => 'driver',
            ),
            87 => 
            array (
                'id' => 237,
                'ride_request_id' => 165,
                'user_id' => 16,
                'user_type' => 'driver',
            ),
            88 => 
            array (
                'id' => 239,
                'ride_request_id' => 166,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            89 => 
            array (
                'id' => 240,
                'ride_request_id' => 166,
                'user_id' => 10,
                'user_type' => 'driver',
            ),
            90 => 
            array (
                'id' => 241,
                'ride_request_id' => 166,
                'user_id' => 16,
                'user_type' => 'driver',
            ),
            91 => 
            array (
                'id' => 243,
                'ride_request_id' => 167,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            92 => 
            array (
                'id' => 244,
                'ride_request_id' => 167,
                'user_id' => 10,
                'user_type' => 'driver',
            ),
            93 => 
            array (
                'id' => 245,
                'ride_request_id' => 167,
                'user_id' => 16,
                'user_type' => 'driver',
            ),
            94 => 
            array (
                'id' => 247,
                'ride_request_id' => 168,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            95 => 
            array (
                'id' => 248,
                'ride_request_id' => 168,
                'user_id' => 10,
                'user_type' => 'driver',
            ),
            96 => 
            array (
                'id' => 249,
                'ride_request_id' => 168,
                'user_id' => 16,
                'user_type' => 'driver',
            ),
            97 => 
            array (
                'id' => 251,
                'ride_request_id' => 169,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            98 => 
            array (
                'id' => 252,
                'ride_request_id' => 169,
                'user_id' => 10,
                'user_type' => 'driver',
            ),
            99 => 
            array (
                'id' => 253,
                'ride_request_id' => 169,
                'user_id' => 16,
                'user_type' => 'driver',
            ),
            100 => 
            array (
                'id' => 256,
                'ride_request_id' => 171,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            101 => 
            array (
                'id' => 261,
                'ride_request_id' => 180,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            102 => 
            array (
                'id' => 267,
                'ride_request_id' => 183,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            103 => 
            array (
                'id' => 271,
                'ride_request_id' => 185,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            104 => 
            array (
                'id' => 275,
                'ride_request_id' => 187,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            105 => 
            array (
                'id' => 283,
                'ride_request_id' => 191,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            106 => 
            array (
                'id' => 287,
                'ride_request_id' => 193,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            107 => 
            array (
                'id' => 319,
                'ride_request_id' => 209,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            108 => 
            array (
                'id' => 325,
                'ride_request_id' => 212,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            109 => 
            array (
                'id' => 328,
                'ride_request_id' => 214,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            110 => 
            array (
                'id' => 335,
                'ride_request_id' => 217,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            111 => 
            array (
                'id' => 376,
                'ride_request_id' => 259,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            112 => 
            array (
                'id' => 393,
                'ride_request_id' => 276,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            113 => 
            array (
                'id' => 401,
                'ride_request_id' => 281,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            114 => 
            array (
                'id' => 404,
                'ride_request_id' => 283,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            115 => 
            array (
                'id' => 408,
                'ride_request_id' => 285,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            116 => 
            array (
                'id' => 410,
                'ride_request_id' => 285,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            117 => 
            array (
                'id' => 416,
                'ride_request_id' => 288,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            118 => 
            array (
                'id' => 417,
                'ride_request_id' => 288,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            119 => 
            array (
                'id' => 421,
                'ride_request_id' => 290,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            120 => 
            array (
                'id' => 422,
                'ride_request_id' => 290,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            121 => 
            array (
                'id' => 518,
                'ride_request_id' => 340,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            122 => 
            array (
                'id' => 519,
                'ride_request_id' => 340,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            123 => 
            array (
                'id' => 520,
                'ride_request_id' => 340,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            124 => 
            array (
                'id' => 522,
                'ride_request_id' => 340,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            125 => 
            array (
                'id' => 523,
                'ride_request_id' => 340,
                'user_id' => 17,
                'user_type' => 'driver',
            ),
            126 => 
            array (
                'id' => 524,
                'ride_request_id' => 341,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            127 => 
            array (
                'id' => 525,
                'ride_request_id' => 341,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            128 => 
            array (
                'id' => 526,
                'ride_request_id' => 341,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            129 => 
            array (
                'id' => 528,
                'ride_request_id' => 341,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            130 => 
            array (
                'id' => 529,
                'ride_request_id' => 341,
                'user_id' => 17,
                'user_type' => 'driver',
            ),
            131 => 
            array (
                'id' => 543,
                'ride_request_id' => 353,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            132 => 
            array (
                'id' => 544,
                'ride_request_id' => 353,
                'user_id' => 17,
                'user_type' => 'driver',
            ),
            133 => 
            array (
                'id' => 545,
                'ride_request_id' => 353,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            134 => 
            array (
                'id' => 546,
                'ride_request_id' => 353,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            135 => 
            array (
                'id' => 547,
                'ride_request_id' => 353,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            136 => 
            array (
                'id' => 548,
                'ride_request_id' => 353,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            137 => 
            array (
                'id' => 549,
                'ride_request_id' => 354,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            138 => 
            array (
                'id' => 551,
                'ride_request_id' => 354,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            139 => 
            array (
                'id' => 552,
                'ride_request_id' => 354,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            140 => 
            array (
                'id' => 553,
                'ride_request_id' => 354,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            141 => 
            array (
                'id' => 554,
                'ride_request_id' => 354,
                'user_id' => 17,
                'user_type' => 'driver',
            ),
            142 => 
            array (
                'id' => 555,
                'ride_request_id' => 354,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            143 => 
            array (
                'id' => 556,
                'ride_request_id' => 355,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            144 => 
            array (
                'id' => 557,
                'ride_request_id' => 355,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            145 => 
            array (
                'id' => 559,
                'ride_request_id' => 355,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            146 => 
            array (
                'id' => 560,
                'ride_request_id' => 355,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            147 => 
            array (
                'id' => 561,
                'ride_request_id' => 355,
                'user_id' => 17,
                'user_type' => 'driver',
            ),
            148 => 
            array (
                'id' => 562,
                'ride_request_id' => 355,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            149 => 
            array (
                'id' => 570,
                'ride_request_id' => 357,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            150 => 
            array (
                'id' => 572,
                'ride_request_id' => 357,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            151 => 
            array (
                'id' => 573,
                'ride_request_id' => 357,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            152 => 
            array (
                'id' => 574,
                'ride_request_id' => 357,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            153 => 
            array (
                'id' => 575,
                'ride_request_id' => 357,
                'user_id' => 17,
                'user_type' => 'driver',
            ),
            154 => 
            array (
                'id' => 576,
                'ride_request_id' => 357,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            155 => 
            array (
                'id' => 591,
                'ride_request_id' => 360,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            156 => 
            array (
                'id' => 592,
                'ride_request_id' => 360,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            157 => 
            array (
                'id' => 593,
                'ride_request_id' => 360,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            158 => 
            array (
                'id' => 594,
                'ride_request_id' => 360,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            159 => 
            array (
                'id' => 596,
                'ride_request_id' => 360,
                'user_id' => 17,
                'user_type' => 'driver',
            ),
            160 => 
            array (
                'id' => 597,
                'ride_request_id' => 360,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            161 => 
            array (
                'id' => 670,
                'ride_request_id' => 373,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            162 => 
            array (
                'id' => 671,
                'ride_request_id' => 373,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            163 => 
            array (
                'id' => 672,
                'ride_request_id' => 373,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            164 => 
            array (
                'id' => 673,
                'ride_request_id' => 373,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            165 => 
            array (
                'id' => 674,
                'ride_request_id' => 373,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            166 => 
            array (
                'id' => 675,
                'ride_request_id' => 373,
                'user_id' => 17,
                'user_type' => 'driver',
            ),
            167 => 
            array (
                'id' => 683,
                'ride_request_id' => 375,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            168 => 
            array (
                'id' => 684,
                'ride_request_id' => 375,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            169 => 
            array (
                'id' => 685,
                'ride_request_id' => 375,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            170 => 
            array (
                'id' => 686,
                'ride_request_id' => 375,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            171 => 
            array (
                'id' => 687,
                'ride_request_id' => 375,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            172 => 
            array (
                'id' => 688,
                'ride_request_id' => 375,
                'user_id' => 17,
                'user_type' => 'driver',
            ),
            173 => 
            array (
                'id' => 691,
                'ride_request_id' => 377,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            174 => 
            array (
                'id' => 692,
                'ride_request_id' => 377,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            175 => 
            array (
                'id' => 693,
                'ride_request_id' => 377,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            176 => 
            array (
                'id' => 694,
                'ride_request_id' => 377,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            177 => 
            array (
                'id' => 695,
                'ride_request_id' => 377,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            178 => 
            array (
                'id' => 696,
                'ride_request_id' => 377,
                'user_id' => 17,
                'user_type' => 'driver',
            ),
            179 => 
            array (
                'id' => 741,
                'ride_request_id' => 386,
                'user_id' => 1,
                'user_type' => 'driver',
            ),
            180 => 
            array (
                'id' => 742,
                'ride_request_id' => 387,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            181 => 
            array (
                'id' => 743,
                'ride_request_id' => 387,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            182 => 
            array (
                'id' => 744,
                'ride_request_id' => 387,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            183 => 
            array (
                'id' => 745,
                'ride_request_id' => 387,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            184 => 
            array (
                'id' => 746,
                'ride_request_id' => 387,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            185 => 
            array (
                'id' => 747,
                'ride_request_id' => 387,
                'user_id' => 17,
                'user_type' => 'driver',
            ),
            186 => 
            array (
                'id' => 749,
                'ride_request_id' => 385,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            187 => 
            array (
                'id' => 750,
                'ride_request_id' => 385,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            188 => 
            array (
                'id' => 751,
                'ride_request_id' => 385,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            189 => 
            array (
                'id' => 752,
                'ride_request_id' => 385,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            190 => 
            array (
                'id' => 753,
                'ride_request_id' => 385,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            191 => 
            array (
                'id' => 754,
                'ride_request_id' => 385,
                'user_id' => 17,
                'user_type' => 'driver',
            ),
            192 => 
            array (
                'id' => 810,
                'ride_request_id' => 399,
                'user_id' => 25,
                'user_type' => 'driver',
            ),
            193 => 
            array (
                'id' => 915,
                'ride_request_id' => 419,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            194 => 
            array (
                'id' => 916,
                'ride_request_id' => 419,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            195 => 
            array (
                'id' => 917,
                'ride_request_id' => 419,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            196 => 
            array (
                'id' => 919,
                'ride_request_id' => 419,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            197 => 
            array (
                'id' => 920,
                'ride_request_id' => 419,
                'user_id' => 17,
                'user_type' => 'driver',
            ),
            198 => 
            array (
                'id' => 921,
                'ride_request_id' => 419,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            199 => 
            array (
                'id' => 994,
                'ride_request_id' => 431,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            200 => 
            array (
                'id' => 996,
                'ride_request_id' => 431,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            201 => 
            array (
                'id' => 997,
                'ride_request_id' => 431,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            202 => 
            array (
                'id' => 998,
                'ride_request_id' => 431,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            203 => 
            array (
                'id' => 999,
                'ride_request_id' => 431,
                'user_id' => 17,
                'user_type' => 'driver',
            ),
            204 => 
            array (
                'id' => 1000,
                'ride_request_id' => 431,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            205 => 
            array (
                'id' => 1029,
                'ride_request_id' => 436,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            206 => 
            array (
                'id' => 1031,
                'ride_request_id' => 436,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            207 => 
            array (
                'id' => 1032,
                'ride_request_id' => 436,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            208 => 
            array (
                'id' => 1033,
                'ride_request_id' => 436,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            209 => 
            array (
                'id' => 1034,
                'ride_request_id' => 436,
                'user_id' => 17,
                'user_type' => 'driver',
            ),
            210 => 
            array (
                'id' => 1035,
                'ride_request_id' => 436,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            211 => 
            array (
                'id' => 1036,
                'ride_request_id' => 437,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            212 => 
            array (
                'id' => 1037,
                'ride_request_id' => 437,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            213 => 
            array (
                'id' => 1039,
                'ride_request_id' => 437,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            214 => 
            array (
                'id' => 1040,
                'ride_request_id' => 437,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            215 => 
            array (
                'id' => 1041,
                'ride_request_id' => 437,
                'user_id' => 17,
                'user_type' => 'driver',
            ),
            216 => 
            array (
                'id' => 1042,
                'ride_request_id' => 437,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            217 => 
            array (
                'id' => 1051,
                'ride_request_id' => 439,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            218 => 
            array (
                'id' => 1052,
                'ride_request_id' => 439,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            219 => 
            array (
                'id' => 1053,
                'ride_request_id' => 439,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            220 => 
            array (
                'id' => 1054,
                'ride_request_id' => 439,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            221 => 
            array (
                'id' => 1055,
                'ride_request_id' => 439,
                'user_id' => 17,
                'user_type' => 'driver',
            ),
            222 => 
            array (
                'id' => 1056,
                'ride_request_id' => 439,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            223 => 
            array (
                'id' => 1057,
                'ride_request_id' => 440,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            224 => 
            array (
                'id' => 1059,
                'ride_request_id' => 440,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            225 => 
            array (
                'id' => 1060,
                'ride_request_id' => 440,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            226 => 
            array (
                'id' => 1061,
                'ride_request_id' => 440,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            227 => 
            array (
                'id' => 1062,
                'ride_request_id' => 440,
                'user_id' => 17,
                'user_type' => 'driver',
            ),
            228 => 
            array (
                'id' => 1063,
                'ride_request_id' => 440,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            229 => 
            array (
                'id' => 1064,
                'ride_request_id' => 441,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            230 => 
            array (
                'id' => 1065,
                'ride_request_id' => 441,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            231 => 
            array (
                'id' => 1066,
                'ride_request_id' => 441,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            232 => 
            array (
                'id' => 1067,
                'ride_request_id' => 441,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            233 => 
            array (
                'id' => 1068,
                'ride_request_id' => 441,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            234 => 
            array (
                'id' => 1071,
                'ride_request_id' => 442,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            235 => 
            array (
                'id' => 1072,
                'ride_request_id' => 442,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            236 => 
            array (
                'id' => 1073,
                'ride_request_id' => 442,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            237 => 
            array (
                'id' => 1074,
                'ride_request_id' => 442,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            238 => 
            array (
                'id' => 1075,
                'ride_request_id' => 442,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            239 => 
            array (
                'id' => 1132,
                'ride_request_id' => 453,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            240 => 
            array (
                'id' => 1133,
                'ride_request_id' => 453,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            241 => 
            array (
                'id' => 1134,
                'ride_request_id' => 453,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            242 => 
            array (
                'id' => 1135,
                'ride_request_id' => 453,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            243 => 
            array (
                'id' => 1136,
                'ride_request_id' => 453,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            244 => 
            array (
                'id' => 1148,
                'ride_request_id' => 456,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            245 => 
            array (
                'id' => 1149,
                'ride_request_id' => 456,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            246 => 
            array (
                'id' => 1151,
                'ride_request_id' => 456,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            247 => 
            array (
                'id' => 1152,
                'ride_request_id' => 456,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            248 => 
            array (
                'id' => 1158,
                'ride_request_id' => 459,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            249 => 
            array (
                'id' => 1159,
                'ride_request_id' => 459,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            250 => 
            array (
                'id' => 1160,
                'ride_request_id' => 459,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            251 => 
            array (
                'id' => 1161,
                'ride_request_id' => 459,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            252 => 
            array (
                'id' => 1162,
                'ride_request_id' => 459,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            253 => 
            array (
                'id' => 1165,
                'ride_request_id' => 461,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            254 => 
            array (
                'id' => 1166,
                'ride_request_id' => 461,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            255 => 
            array (
                'id' => 1167,
                'ride_request_id' => 461,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            256 => 
            array (
                'id' => 1168,
                'ride_request_id' => 461,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            257 => 
            array (
                'id' => 1169,
                'ride_request_id' => 461,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            258 => 
            array (
                'id' => 1183,
                'ride_request_id' => 464,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            259 => 
            array (
                'id' => 1184,
                'ride_request_id' => 464,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            260 => 
            array (
                'id' => 1185,
                'ride_request_id' => 464,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            261 => 
            array (
                'id' => 1186,
                'ride_request_id' => 464,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            262 => 
            array (
                'id' => 1187,
                'ride_request_id' => 464,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            263 => 
            array (
                'id' => 1189,
                'ride_request_id' => 465,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            264 => 
            array (
                'id' => 1190,
                'ride_request_id' => 465,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            265 => 
            array (
                'id' => 1191,
                'ride_request_id' => 465,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            266 => 
            array (
                'id' => 1192,
                'ride_request_id' => 465,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            267 => 
            array (
                'id' => 1193,
                'ride_request_id' => 465,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            268 => 
            array (
                'id' => 1203,
                'ride_request_id' => 469,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            269 => 
            array (
                'id' => 1204,
                'ride_request_id' => 469,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            270 => 
            array (
                'id' => 1205,
                'ride_request_id' => 469,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            271 => 
            array (
                'id' => 1206,
                'ride_request_id' => 469,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            272 => 
            array (
                'id' => 1207,
                'ride_request_id' => 469,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            273 => 
            array (
                'id' => 1210,
                'ride_request_id' => 471,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            274 => 
            array (
                'id' => 1211,
                'ride_request_id' => 471,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            275 => 
            array (
                'id' => 1212,
                'ride_request_id' => 471,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            276 => 
            array (
                'id' => 1214,
                'ride_request_id' => 471,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            277 => 
            array (
                'id' => 1215,
                'ride_request_id' => 471,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            278 => 
            array (
                'id' => 1216,
                'ride_request_id' => 472,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            279 => 
            array (
                'id' => 1217,
                'ride_request_id' => 472,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            280 => 
            array (
                'id' => 1218,
                'ride_request_id' => 472,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            281 => 
            array (
                'id' => 1220,
                'ride_request_id' => 472,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            282 => 
            array (
                'id' => 1221,
                'ride_request_id' => 472,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            283 => 
            array (
                'id' => 1222,
                'ride_request_id' => 473,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            284 => 
            array (
                'id' => 1223,
                'ride_request_id' => 473,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            285 => 
            array (
                'id' => 1224,
                'ride_request_id' => 473,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            286 => 
            array (
                'id' => 1226,
                'ride_request_id' => 473,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            287 => 
            array (
                'id' => 1227,
                'ride_request_id' => 473,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            288 => 
            array (
                'id' => 1257,
                'ride_request_id' => 483,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            289 => 
            array (
                'id' => 1258,
                'ride_request_id' => 483,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            290 => 
            array (
                'id' => 1260,
                'ride_request_id' => 483,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            291 => 
            array (
                'id' => 1261,
                'ride_request_id' => 483,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            292 => 
            array (
                'id' => 1262,
                'ride_request_id' => 483,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            293 => 
            array (
                'id' => 1263,
                'ride_request_id' => 484,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            294 => 
            array (
                'id' => 1264,
                'ride_request_id' => 484,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            295 => 
            array (
                'id' => 1266,
                'ride_request_id' => 484,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            296 => 
            array (
                'id' => 1267,
                'ride_request_id' => 484,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            297 => 
            array (
                'id' => 1268,
                'ride_request_id' => 485,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            298 => 
            array (
                'id' => 1269,
                'ride_request_id' => 485,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            299 => 
            array (
                'id' => 1270,
                'ride_request_id' => 485,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            300 => 
            array (
                'id' => 1271,
                'ride_request_id' => 485,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            301 => 
            array (
                'id' => 1273,
                'ride_request_id' => 486,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            302 => 
            array (
                'id' => 1274,
                'ride_request_id' => 486,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            303 => 
            array (
                'id' => 1276,
                'ride_request_id' => 486,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            304 => 
            array (
                'id' => 1277,
                'ride_request_id' => 486,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            305 => 
            array (
                'id' => 1284,
                'ride_request_id' => 488,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            306 => 
            array (
                'id' => 1285,
                'ride_request_id' => 488,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            307 => 
            array (
                'id' => 1286,
                'ride_request_id' => 488,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            308 => 
            array (
                'id' => 1288,
                'ride_request_id' => 488,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            309 => 
            array (
                'id' => 1289,
                'ride_request_id' => 488,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            310 => 
            array (
                'id' => 1290,
                'ride_request_id' => 489,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            311 => 
            array (
                'id' => 1291,
                'ride_request_id' => 489,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            312 => 
            array (
                'id' => 1292,
                'ride_request_id' => 489,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            313 => 
            array (
                'id' => 1294,
                'ride_request_id' => 489,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            314 => 
            array (
                'id' => 1295,
                'ride_request_id' => 489,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            315 => 
            array (
                'id' => 1296,
                'ride_request_id' => 490,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            316 => 
            array (
                'id' => 1297,
                'ride_request_id' => 490,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            317 => 
            array (
                'id' => 1298,
                'ride_request_id' => 490,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            318 => 
            array (
                'id' => 1300,
                'ride_request_id' => 490,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            319 => 
            array (
                'id' => 1301,
                'ride_request_id' => 490,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            320 => 
            array (
                'id' => 1302,
                'ride_request_id' => 491,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            321 => 
            array (
                'id' => 1303,
                'ride_request_id' => 491,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            322 => 
            array (
                'id' => 1304,
                'ride_request_id' => 491,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            323 => 
            array (
                'id' => 1306,
                'ride_request_id' => 491,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            324 => 
            array (
                'id' => 1307,
                'ride_request_id' => 491,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            325 => 
            array (
                'id' => 1308,
                'ride_request_id' => 492,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            326 => 
            array (
                'id' => 1309,
                'ride_request_id' => 492,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            327 => 
            array (
                'id' => 1310,
                'ride_request_id' => 492,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            328 => 
            array (
                'id' => 1312,
                'ride_request_id' => 492,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            329 => 
            array (
                'id' => 1313,
                'ride_request_id' => 492,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            330 => 
            array (
                'id' => 1361,
                'ride_request_id' => 506,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            331 => 
            array (
                'id' => 1362,
                'ride_request_id' => 506,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            332 => 
            array (
                'id' => 1364,
                'ride_request_id' => 506,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            333 => 
            array (
                'id' => 1365,
                'ride_request_id' => 506,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            334 => 
            array (
                'id' => 1366,
                'ride_request_id' => 506,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            335 => 
            array (
                'id' => 1378,
                'ride_request_id' => 509,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            336 => 
            array (
                'id' => 1379,
                'ride_request_id' => 509,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            337 => 
            array (
                'id' => 1381,
                'ride_request_id' => 509,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            338 => 
            array (
                'id' => 1382,
                'ride_request_id' => 509,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            339 => 
            array (
                'id' => 1383,
                'ride_request_id' => 509,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            340 => 
            array (
                'id' => 1404,
                'ride_request_id' => 514,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            341 => 
            array (
                'id' => 1406,
                'ride_request_id' => 514,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            342 => 
            array (
                'id' => 1407,
                'ride_request_id' => 514,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            343 => 
            array (
                'id' => 1408,
                'ride_request_id' => 514,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            344 => 
            array (
                'id' => 1430,
                'ride_request_id' => 520,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            345 => 
            array (
                'id' => 1431,
                'ride_request_id' => 520,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            346 => 
            array (
                'id' => 1432,
                'ride_request_id' => 520,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            347 => 
            array (
                'id' => 1434,
                'ride_request_id' => 520,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            348 => 
            array (
                'id' => 1435,
                'ride_request_id' => 520,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            349 => 
            array (
                'id' => 1436,
                'ride_request_id' => 521,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            350 => 
            array (
                'id' => 1437,
                'ride_request_id' => 521,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            351 => 
            array (
                'id' => 1438,
                'ride_request_id' => 521,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            352 => 
            array (
                'id' => 1439,
                'ride_request_id' => 521,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            353 => 
            array (
                'id' => 1440,
                'ride_request_id' => 521,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            354 => 
            array (
                'id' => 1446,
                'ride_request_id' => 523,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            355 => 
            array (
                'id' => 1447,
                'ride_request_id' => 523,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            356 => 
            array (
                'id' => 1448,
                'ride_request_id' => 523,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            357 => 
            array (
                'id' => 1449,
                'ride_request_id' => 523,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            358 => 
            array (
                'id' => 1450,
                'ride_request_id' => 523,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            359 => 
            array (
                'id' => 1452,
                'ride_request_id' => 524,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            360 => 
            array (
                'id' => 1453,
                'ride_request_id' => 524,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            361 => 
            array (
                'id' => 1454,
                'ride_request_id' => 524,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            362 => 
            array (
                'id' => 1455,
                'ride_request_id' => 524,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            363 => 
            array (
                'id' => 1456,
                'ride_request_id' => 524,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            364 => 
            array (
                'id' => 1458,
                'ride_request_id' => 525,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            365 => 
            array (
                'id' => 1459,
                'ride_request_id' => 525,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            366 => 
            array (
                'id' => 1460,
                'ride_request_id' => 525,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            367 => 
            array (
                'id' => 1461,
                'ride_request_id' => 525,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            368 => 
            array (
                'id' => 1462,
                'ride_request_id' => 525,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            369 => 
            array (
                'id' => 1463,
                'ride_request_id' => 526,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            370 => 
            array (
                'id' => 1464,
                'ride_request_id' => 526,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            371 => 
            array (
                'id' => 1465,
                'ride_request_id' => 526,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            372 => 
            array (
                'id' => 1466,
                'ride_request_id' => 526,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            373 => 
            array (
                'id' => 1468,
                'ride_request_id' => 527,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            374 => 
            array (
                'id' => 1469,
                'ride_request_id' => 527,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            375 => 
            array (
                'id' => 1470,
                'ride_request_id' => 527,
                'user_id' => 9,
                'user_type' => 'driver',
            ),
            376 => 
            array (
                'id' => 1471,
                'ride_request_id' => 527,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            377 => 
            array (
                'id' => 1472,
                'ride_request_id' => 527,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            378 => 
            array (
                'id' => 1482,
                'ride_request_id' => 531,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            379 => 
            array (
                'id' => 1483,
                'ride_request_id' => 531,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            380 => 
            array (
                'id' => 1485,
                'ride_request_id' => 531,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            381 => 
            array (
                'id' => 1486,
                'ride_request_id' => 531,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            382 => 
            array (
                'id' => 1487,
                'ride_request_id' => 531,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            383 => 
            array (
                'id' => 1490,
                'ride_request_id' => 534,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            384 => 
            array (
                'id' => 1492,
                'ride_request_id' => 534,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            385 => 
            array (
                'id' => 1493,
                'ride_request_id' => 534,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            386 => 
            array (
                'id' => 1494,
                'ride_request_id' => 534,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            387 => 
            array (
                'id' => 1495,
                'ride_request_id' => 534,
                'user_id' => 20,
                'user_type' => 'driver',
            ),
            388 => 
            array (
                'id' => 1502,
                'ride_request_id' => 541,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            389 => 
            array (
                'id' => 1503,
                'ride_request_id' => 541,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            390 => 
            array (
                'id' => 1504,
                'ride_request_id' => 541,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            391 => 
            array (
                'id' => 1505,
                'ride_request_id' => 541,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            392 => 
            array (
                'id' => 1507,
                'ride_request_id' => 542,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            393 => 
            array (
                'id' => 1508,
                'ride_request_id' => 542,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            394 => 
            array (
                'id' => 1510,
                'ride_request_id' => 542,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            395 => 
            array (
                'id' => 1511,
                'ride_request_id' => 542,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            396 => 
            array (
                'id' => 1512,
                'ride_request_id' => 543,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            397 => 
            array (
                'id' => 1513,
                'ride_request_id' => 543,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            398 => 
            array (
                'id' => 1515,
                'ride_request_id' => 543,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            399 => 
            array (
                'id' => 1516,
                'ride_request_id' => 543,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            400 => 
            array (
                'id' => 1517,
                'ride_request_id' => 544,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            401 => 
            array (
                'id' => 1518,
                'ride_request_id' => 544,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            402 => 
            array (
                'id' => 1520,
                'ride_request_id' => 544,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            403 => 
            array (
                'id' => 1521,
                'ride_request_id' => 544,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            404 => 
            array (
                'id' => 1523,
                'ride_request_id' => 545,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            405 => 
            array (
                'id' => 1524,
                'ride_request_id' => 545,
                'user_id' => 24,
                'user_type' => 'driver',
            ),
            406 => 
            array (
                'id' => 1525,
                'ride_request_id' => 545,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            407 => 
            array (
                'id' => 1526,
                'ride_request_id' => 545,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            408 => 
            array (
                'id' => 1528,
                'ride_request_id' => 546,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            409 => 
            array (
                'id' => 1529,
                'ride_request_id' => 546,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            410 => 
            array (
                'id' => 1530,
                'ride_request_id' => 546,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
            411 => 
            array (
                'id' => 1536,
                'ride_request_id' => 548,
                'user_id' => 21,
                'user_type' => 'driver',
            ),
            412 => 
            array (
                'id' => 1537,
                'ride_request_id' => 548,
                'user_id' => 2,
                'user_type' => 'driver',
            ),
            413 => 
            array (
                'id' => 1538,
                'ride_request_id' => 548,
                'user_id' => 22,
                'user_type' => 'driver',
            ),
        ));
        
        
    }
}