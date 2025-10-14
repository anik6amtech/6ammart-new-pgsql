<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DeliveryManWalletsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('delivery_man_wallets')->delete();
        
        \DB::table('delivery_man_wallets')->insert(array (
            0 => 
            array (
                'id' => 1,
                'delivery_man_id' => 1,
                'collected_cash' => '1961.66',
                'created_at' => '2022-09-29 14:54:27',
                'updated_at' => '2025-10-14 09:24:14',
                'total_earning' => '45546.08',
                'total_withdrawn' => '31347.13',
                'pending_withdraw' => '11785.06',
            ),
            1 => 
            array (
                'id' => 2,
                'delivery_man_id' => 3,
                'collected_cash' => '38521.25',
                'created_at' => '2022-09-29 15:16:16',
                'updated_at' => '2023-01-17 17:37:06',
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
            ),
            2 => 
            array (
                'id' => 3,
                'delivery_man_id' => 4,
                'collected_cash' => '3576.17',
                'created_at' => '2022-09-29 15:52:45',
                'updated_at' => '2022-09-29 15:52:45',
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
            ),
            3 => 
            array (
                'id' => 4,
                'delivery_man_id' => 6,
                'collected_cash' => '4354.85',
                'created_at' => '2022-09-29 15:52:48',
                'updated_at' => '2022-09-29 16:12:43',
                'total_earning' => '5738.68',
                'total_withdrawn' => '3100.00',
                'pending_withdraw' => '0.00',
            ),
            4 => 
            array (
                'id' => 5,
                'delivery_man_id' => 5,
                'collected_cash' => '71.50',
                'created_at' => '2022-09-29 16:13:23',
                'updated_at' => '2022-09-29 16:13:23',
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
            ),
            5 => 
            array (
                'id' => 6,
                'delivery_man_id' => 10,
                'collected_cash' => '96.28',
                'created_at' => '2025-09-09 12:55:22',
                'updated_at' => '2025-09-25 07:40:08',
                'total_earning' => '606.82',
                'total_withdrawn' => '587.01',
                'pending_withdraw' => '0.00',
            ),
            6 => 
            array (
                'id' => 7,
                'delivery_man_id' => 11,
                'collected_cash' => '302.76',
                'created_at' => '2025-09-11 13:05:05',
                'updated_at' => '2025-09-16 18:05:22',
                'total_earning' => '549.47',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
            ),
            7 => 
            array (
                'id' => 8,
                'delivery_man_id' => 9,
                'collected_cash' => '1654.82',
                'created_at' => '2025-09-14 10:35:51',
                'updated_at' => '2025-10-13 17:14:09',
                'total_earning' => '9450.90',
                'total_withdrawn' => '7327.94',
                'pending_withdraw' => '0.00',
            ),
            8 => 
            array (
                'id' => 9,
                'delivery_man_id' => 14,
                'collected_cash' => '0.00',
                'created_at' => '2025-09-16 15:03:25',
                'updated_at' => '2025-09-16 15:03:25',
                'total_earning' => '50.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
            ),
            9 => 
            array (
                'id' => 10,
                'delivery_man_id' => 16,
                'collected_cash' => '25.72',
                'created_at' => '2025-09-25 18:21:55',
                'updated_at' => '2025-09-26 01:15:19',
                'total_earning' => '68.61',
                'total_withdrawn' => '68.61',
                'pending_withdraw' => '0.00',
            ),
            10 => 
            array (
                'id' => 11,
                'delivery_man_id' => 19,
                'collected_cash' => '0.00',
                'created_at' => '2025-10-05 17:53:22',
                'updated_at' => '2025-10-05 17:53:22',
                'total_earning' => '50.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
            ),
            11 => 
            array (
                'id' => 12,
                'delivery_man_id' => 20,
                'collected_cash' => '103.57',
                'created_at' => '2025-10-08 16:01:26',
                'updated_at' => '2025-10-13 18:25:41',
                'total_earning' => '225.34',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
            ),
            12 => 
            array (
                'id' => 13,
                'delivery_man_id' => 21,
                'collected_cash' => '24.20',
                'created_at' => '2025-10-09 15:57:45',
                'updated_at' => '2025-10-09 17:50:53',
                'total_earning' => '67.60',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
            ),
            13 => 
            array (
                'id' => 14,
                'delivery_man_id' => 2,
                'collected_cash' => '228.86',
                'created_at' => '2025-10-11 13:01:08',
                'updated_at' => '2025-10-13 16:39:04',
                'total_earning' => '266.45',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
            ),
            14 => 
            array (
                'id' => 15,
                'delivery_man_id' => 24,
                'collected_cash' => '1004.69',
                'created_at' => '2025-10-11 16:17:39',
                'updated_at' => '2025-10-13 13:06:27',
                'total_earning' => '826.36',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
            ),
            15 => 
            array (
                'id' => 16,
                'delivery_man_id' => 25,
                'collected_cash' => '18.33',
                'created_at' => '2025-10-12 11:24:27',
                'updated_at' => '2025-10-12 11:24:27',
                'total_earning' => '63.33',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
            ),
        ));
        
        
    }
}