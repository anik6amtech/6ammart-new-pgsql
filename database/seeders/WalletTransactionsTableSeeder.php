<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WalletTransactionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('wallet_transactions')->delete();
        
        \DB::table('wallet_transactions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 7,
                'transaction_id' => '6aa493b5-69a8-4dab-bbe1-d65072a1d2ef',
                'credit' => '1000.000',
                'debit' => '0.000',
                'admin_bonus' => '0.000',
                'balance' => '1000.000',
                'transaction_type' => 'add_fund_by_admin',
                'reference' => NULL,
                'created_at' => '2022-09-29 12:15:01',
                'updated_at' => '2022-09-29 12:15:01',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 12,
                'transaction_id' => '2fd6c3b7-4e4d-48fe-8d7b-897fed8f09e7',
                'credit' => '3000.000',
                'debit' => '0.000',
                'admin_bonus' => '0.000',
                'balance' => '3000.000',
                'transaction_type' => 'add_fund_by_admin',
                'reference' => 'Funded',
                'created_at' => '2022-09-29 12:53:42',
                'updated_at' => '2022-09-29 12:53:42',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 11,
                'transaction_id' => '80b89460-0d4d-431c-be3f-999005f36fe6',
                'credit' => '950.000',
                'debit' => '0.000',
                'admin_bonus' => '0.000',
                'balance' => '950.000',
                'transaction_type' => 'add_fund_by_admin',
                'reference' => NULL,
                'created_at' => '2022-09-29 12:54:14',
                'updated_at' => '2022-09-29 12:54:14',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 10,
                'transaction_id' => 'e33a4dee-3df8-425d-bd6c-cc4164adc644',
                'credit' => '1100.000',
                'debit' => '0.000',
                'admin_bonus' => '0.000',
                'balance' => '1100.000',
                'transaction_type' => 'add_fund_by_admin',
                'reference' => 'Cash',
                'created_at' => '2022-09-29 12:55:04',
                'updated_at' => '2022-09-29 12:55:04',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 10,
                'transaction_id' => 'b4dad27f-3c2d-4597-9692-a003d003ef92',
                'credit' => '9000.000',
                'debit' => '0.000',
                'admin_bonus' => '0.000',
                'balance' => '10100.000',
                'transaction_type' => 'add_fund_by_admin',
                'reference' => NULL,
                'created_at' => '2022-09-29 12:58:34',
                'updated_at' => '2022-09-29 12:58:34',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 10,
                'transaction_id' => '46f5b8c4-29cd-48dd-8d7b-97c4f143653d',
                'credit' => '0.000',
                'debit' => '3882.000',
                'admin_bonus' => '0.000',
                'balance' => '6218.000',
                'transaction_type' => 'order_place',
                'reference' => '100033',
                'created_at' => '2022-09-29 12:58:43',
                'updated_at' => '2022-09-29 12:58:43',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 10,
                'transaction_id' => '98b91fcd-ca4c-4d4f-b799-d470ce6f52e8',
                'credit' => '3882.000',
                'debit' => '0.000',
                'admin_bonus' => '0.000',
                'balance' => '10100.000',
                'transaction_type' => 'order_refund',
                'reference' => '100033',
                'created_at' => '2022-09-29 12:58:59',
                'updated_at' => '2022-09-29 12:58:59',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 10,
                'transaction_id' => '504c13c7-df8b-448c-9d51-888980daefae',
                'credit' => '10.000',
                'debit' => '0.000',
                'admin_bonus' => '0.000',
                'balance' => '10110.000',
                'transaction_type' => 'loyalty_point',
                'reference' => NULL,
                'created_at' => '2022-09-29 13:03:55',
                'updated_at' => '2022-09-29 13:03:55',
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 10,
                'transaction_id' => '75cfc4bd-a512-4731-9290-43044da98754',
                'credit' => '5.000',
                'debit' => '0.000',
                'admin_bonus' => '0.000',
                'balance' => '10115.000',
                'transaction_type' => 'loyalty_point',
                'reference' => NULL,
                'created_at' => '2022-09-29 13:04:00',
                'updated_at' => '2022-09-29 13:04:00',
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => 10,
                'transaction_id' => 'cf67be0c-8090-4284-b8d1-ba39140d69a4',
                'credit' => '3.000',
                'debit' => '0.000',
                'admin_bonus' => '0.000',
                'balance' => '10118.000',
                'transaction_type' => 'loyalty_point',
                'reference' => NULL,
                'created_at' => '2022-09-29 13:04:06',
                'updated_at' => '2022-09-29 13:04:06',
            ),
        ));
        
        
    }
}