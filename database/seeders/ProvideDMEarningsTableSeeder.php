<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProvideDMEarningsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('provide_d_m_earnings')->delete();
        
        \DB::table('provide_d_m_earnings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'delivery_man_id' => 6,
                'amount' => '3000.00',
                'method' => 'cash',
                'ref' => NULL,
                'created_at' => '2022-09-29 15:53:18',
                'updated_at' => '2022-09-29 15:53:18',
            ),
            1 => 
            array (
                'id' => 2,
                'delivery_man_id' => 6,
                'amount' => '100.00',
                'method' => 'cash',
                'ref' => '11',
                'created_at' => '2022-09-29 16:02:02',
                'updated_at' => '2022-09-29 16:02:02',
            ),
            2 => 
            array (
                'id' => 3,
                'delivery_man_id' => 1,
                'amount' => '26392.44',
                'method' => 'adjustment',
                'ref' => 'delivery_man_wallet_adjustment_partial',
                'created_at' => '2023-11-27 12:40:12',
                'updated_at' => '2023-11-27 12:40:12',
            ),
            3 => 
            array (
                'id' => 4,
                'delivery_man_id' => 10,
                'amount' => '587.01',
                'method' => 'adjustment',
                'ref' => 'delivery_man_wallet_adjustment_partial',
                'created_at' => '2025-09-13 07:22:43',
                'updated_at' => '2025-09-13 07:22:43',
            ),
            4 => 
            array (
                'id' => 5,
                'delivery_man_id' => 1,
                'amount' => '3556.41',
                'method' => 'adjustment',
                'ref' => 'delivery_man_wallet_adjustment_full',
                'created_at' => '2025-09-21 10:41:14',
                'updated_at' => '2025-09-21 10:41:14',
            ),
            5 => 
            array (
                'id' => 6,
                'delivery_man_id' => 16,
                'amount' => '68.61',
                'method' => 'adjustment',
                'ref' => 'delivery_man_wallet_adjustment_partial',
                'created_at' => '2025-09-26 01:15:19',
                'updated_at' => '2025-09-26 01:15:19',
            ),
            6 => 
            array (
                'id' => 7,
                'delivery_man_id' => 9,
                'amount' => '7204.94',
                'method' => 'adjustment',
                'ref' => 'delivery_man_wallet_adjustment_full',
                'created_at' => '2025-10-06 11:53:50',
                'updated_at' => '2025-10-06 11:53:50',
            ),
            7 => 
            array (
                'id' => 8,
                'delivery_man_id' => 1,
                'amount' => '671.58',
                'method' => 'adjustment',
                'ref' => 'delivery_man_wallet_adjustment_full',
                'created_at' => '2025-10-09 19:41:52',
                'updated_at' => '2025-10-09 19:41:52',
            ),
            8 => 
            array (
                'id' => 9,
                'delivery_man_id' => 1,
                'amount' => '461.43',
                'method' => 'adjustment',
                'ref' => 'delivery_man_wallet_adjustment_full',
                'created_at' => '2025-10-10 17:19:17',
                'updated_at' => '2025-10-10 17:19:17',
            ),
            9 => 
            array (
                'id' => 10,
                'delivery_man_id' => 1,
                'amount' => '265.27',
                'method' => 'adjustment',
                'ref' => 'delivery_man_wallet_adjustment_full',
                'created_at' => '2025-10-10 18:29:34',
                'updated_at' => '2025-10-10 18:29:34',
            ),
        ));
        
        
    }
}