<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AccountTransactionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('account_transactions')->delete();
        
        \DB::table('account_transactions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'from_type' => 'deliveryman',
                'from_id' => 1,
                'current_balance' => '5900.23',
                'amount' => '900.00',
                'method' => 'cash',
                'ref' => '12',
                'created_at' => '2022-09-29 15:15:34',
                'updated_at' => '2022-09-29 15:15:34',
                'type' => 'collected',
                'created_by' => 'admin',
            ),
            1 => 
            array (
                'id' => 2,
                'from_type' => 'deliveryman',
                'from_id' => 3,
                'current_balance' => '26767.75',
                'amount' => '600.00',
                'method' => 'cash',
                'ref' => '7i96',
                'created_at' => '2022-09-29 15:17:03',
                'updated_at' => '2022-09-29 15:17:03',
                'type' => 'collected',
                'created_by' => 'admin',
            ),
            2 => 
            array (
                'id' => 3,
                'from_type' => 'deliveryman',
                'from_id' => 1,
                'current_balance' => '32560.64',
                'amount' => '1545.00',
                'method' => 'cash_collection',
                'ref' => '100089',
                'created_at' => '2023-11-27 12:35:04',
                'updated_at' => '2023-11-27 12:35:04',
                'type' => 'cash_in',
                'created_by' => 'deliveryman',
            ),
            3 => 
            array (
                'id' => 4,
                'from_type' => 'deliveryman',
                'from_id' => 1,
                'current_balance' => '32792.61',
                'amount' => '231.97',
                'method' => 'cash_collection',
                'ref' => '100090',
                'created_at' => '2023-11-27 12:36:57',
                'updated_at' => '2023-11-27 12:36:57',
                'type' => 'cash_in',
                'created_by' => 'deliveryman',
            ),
            4 => 
            array (
                'id' => 5,
                'from_type' => 'deliveryman',
                'from_id' => 1,
                'current_balance' => '6400.17',
                'amount' => '6400.17',
                'method' => 'ssl_commerz',
                'ref' => 'deliveryman_collect_cash_payments',
                'created_at' => '2023-11-27 12:40:38',
                'updated_at' => '2023-11-27 12:40:38',
                'type' => 'collected',
                'created_by' => 'deliveryman',
            ),
            5 => 
            array (
                'id' => 6,
                'from_type' => 'deliveryman',
                'from_id' => 1,
                'current_balance' => '231.97',
                'amount' => '231.97',
                'method' => 'cash_collection',
                'ref' => '100091',
                'created_at' => '2023-11-27 12:41:40',
                'updated_at' => '2023-11-27 12:41:40',
                'type' => 'cash_in',
                'created_by' => 'deliveryman',
            ),
            6 => 
            array (
                'id' => 7,
                'from_type' => 'deliveryman',
                'from_id' => 1,
                'current_balance' => '10406.07',
                'amount' => '10174.10',
                'method' => 'cash_collection',
                'ref' => '100092',
                'created_at' => '2023-11-27 12:42:48',
                'updated_at' => '2023-11-27 12:42:48',
                'type' => 'cash_in',
                'created_by' => 'deliveryman',
            ),
            7 => 
            array (
                'id' => 8,
                'from_type' => 'deliveryman',
                'from_id' => 1,
                'current_balance' => '10406.07',
                'amount' => '10406.07',
                'method' => 'ssl_commerz',
                'ref' => 'deliveryman_collect_cash_payments',
                'created_at' => '2023-11-27 12:43:23',
                'updated_at' => '2023-11-27 12:43:23',
                'type' => 'collected',
                'created_by' => 'deliveryman',
            ),
            8 => 
            array (
                'id' => 9,
                'from_type' => 'store',
                'from_id' => 2,
                'current_balance' => '760.00',
                'amount' => '760.00',
                'method' => 'cash_collection',
                'ref' => '100095',
                'created_at' => '2023-11-27 13:45:00',
                'updated_at' => '2023-11-27 13:45:00',
                'type' => 'cash_in',
                'created_by' => 'store',
            ),
            9 => 
            array (
                'id' => 10,
                'from_type' => 'store',
                'from_id' => 2,
                'current_balance' => '433.64',
                'amount' => '410.00',
                'method' => 'cash_collection',
                'ref' => '100097',
                'created_at' => '2023-11-27 13:49:28',
                'updated_at' => '2023-11-27 13:49:28',
                'type' => 'cash_in',
                'created_by' => 'store',
            ),
            10 => 
            array (
                'id' => 11,
                'from_type' => 'store',
                'from_id' => 2,
                'current_balance' => '433.64',
                'amount' => '433.64',
                'method' => 'stripe',
                'ref' => 'store_collect_cash_payments',
                'created_at' => '2023-11-27 13:50:23',
                'updated_at' => '2023-11-27 13:50:23',
                'type' => 'collected',
                'created_by' => 'store',
            ),
            11 => 
            array (
                'id' => 12,
                'from_type' => 'deliveryman',
                'from_id' => 1,
                'current_balance' => '100.00',
                'amount' => '100.00',
                'method' => 'cash_collection',
                'ref' => '100096',
                'created_at' => '2024-01-02 16:59:56',
                'updated_at' => '2024-01-02 16:59:56',
                'type' => 'cash_in',
                'created_by' => 'deliveryman',
            ),
            12 => 
            array (
                'id' => 13,
                'from_type' => 'store',
                'from_id' => 64,
                'current_balance' => '4946.17',
                'amount' => '4946.17',
                'method' => 'cash_collection',
                'ref' => '100015',
                'created_at' => '2025-02-06 16:58:19',
                'updated_at' => '2025-02-06 16:58:19',
                'type' => 'cash_in',
                'created_by' => 'store',
            ),
            13 => 
            array (
                'id' => 14,
                'from_type' => 'store',
                'from_id' => 67,
                'current_balance' => '235.00',
                'amount' => '235.00',
                'method' => 'cash_collection',
                'ref' => '100037',
                'created_at' => '2025-02-08 12:49:31',
                'updated_at' => '2025-02-08 12:49:31',
                'type' => 'cash_in',
                'created_by' => 'store',
            ),
            14 => 
            array (
                'id' => 15,
                'from_type' => 'deliveryman',
                'from_id' => 1,
                'current_balance' => '3249.39',
                'amount' => '3149.39',
                'method' => 'cash_collection',
                'ref' => '100065',
                'created_at' => '2025-09-08 05:59:29',
                'updated_at' => '2025-09-08 05:59:29',
                'type' => 'cash_in',
                'created_by' => 'deliveryman',
            ),
            15 => 
            array (
                'id' => 16,
                'from_type' => 'deliveryman',
                'from_id' => 1,
                'current_balance' => '3349.39',
                'amount' => '100.00',
                'method' => 'cash_collection',
                'ref' => '100070',
                'created_at' => '2025-09-08 05:59:51',
                'updated_at' => '2025-09-08 05:59:51',
                'type' => 'cash_in',
                'created_by' => 'deliveryman',
            ),
            16 => 
            array (
                'id' => 17,
                'from_type' => 'provider',
                'from_id' => 1,
                'current_balance' => '797.65',
                'amount' => '34.00',
                'method' => 'tytyt',
                'ref' => NULL,
                'created_at' => '2025-10-07 13:03:45',
                'updated_at' => '2025-10-07 13:03:45',
                'type' => 'collected',
                'created_by' => 'admin',
            ),
            17 => 
            array (
                'id' => 18,
                'from_type' => 'provider',
                'from_id' => 1,
                'current_balance' => '120.00',
                'amount' => '20.00',
                'method' => 'jh',
                'ref' => 'kk',
                'created_at' => '2025-10-10 17:12:26',
                'updated_at' => '2025-10-10 17:12:26',
                'type' => 'collected',
                'created_by' => 'admin',
            ),
            18 => 
            array (
                'id' => 19,
                'from_type' => 'provider',
                'from_id' => 1,
                'current_balance' => '100.00',
                'amount' => '100.00',
                'method' => 'hjjh',
                'ref' => '6',
                'created_at' => '2025-10-10 17:13:42',
                'updated_at' => '2025-10-10 17:13:42',
                'type' => 'collected',
                'created_by' => 'admin',
            ),
            19 => 
            array (
                'id' => 20,
                'from_type' => 'deliveryman',
                'from_id' => 9,
                'current_balance' => '1606.42',
                'amount' => '658.70',
                'method' => 'cash_collection',
                'ref' => '100116',
                'created_at' => '2025-10-12 15:59:10',
                'updated_at' => '2025-10-12 15:59:10',
                'type' => 'cash_in',
                'created_by' => 'deliveryman',
            ),
            20 => 
            array (
                'id' => 21,
                'from_type' => 'deliveryman',
                'from_id' => 24,
                'current_balance' => '788.62',
                'amount' => '658.70',
                'method' => 'cash_collection',
                'ref' => '100117',
                'created_at' => '2025-10-12 16:13:30',
                'updated_at' => '2025-10-12 16:13:30',
                'type' => 'cash_in',
                'created_by' => 'deliveryman',
            ),
            21 => 
            array (
                'id' => 22,
                'from_type' => 'deliveryman',
                'from_id' => 1,
                'current_balance' => '1765.26',
                'amount' => '658.70',
                'method' => 'cash_collection',
                'ref' => '100125',
                'created_at' => '2025-10-12 18:06:21',
                'updated_at' => '2025-10-12 18:06:21',
                'type' => 'cash_in',
                'created_by' => 'deliveryman',
            ),
        ));
        
        
    }
}