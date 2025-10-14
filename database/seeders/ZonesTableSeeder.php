<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ZonesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('zones')->delete();
        
        \DB::table('zones')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Main Demo Zone',
                'coordinates' => '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '%' . "\0" . '' . "\0" . '' . "\0" . 'ÞWyVÚEfÀ_û(GîQ@ÞWyVðeÀô±é¾çP@ÞWyV"weÀTÙ¥.Z²P@ÞWyV<eÀY½áÌˆP@ÞWyV:_eÀÅžùúcP@ÞWyVeÀ•Œ®æAP@ÞWyVBíeÀWT©+S>P@ÞWyV
CfÀ¬0yñjP@ÞWyVÒ>fÀk¾`»dŸP@"¨†©f@DÌø¦ß‘P@"¨†©Õsf@aoìé³@P@"¨†©õbf@\'ÛÃPZPO@‹1S‹‚5d@Öõc~NL@‹1S‹b±b@$?û‡KÀ‹1S‹âf@ÑÀQšNCÀ‹1S‹-e@Ë	„ÛGÀ‹1S‹"˜a@n<q CBÀc¦…]@<ú^s­@ÀžÅL-ŠcF@ua&ª£q8À<‹™Z+4@ÌÓád°å@À1Yéº1QÀHƒéxKÀ1YézŽRÀ“}­4)ÕHÀ1Yéz&QÀÄ‚
3À1Yéº§SÀ+–H	-û ÀëœYéºtYÀµ„YL6æ2@ëœYé:¤^À‘ÝÊ¦C@uÎ¬tŠcÀ.¤ßAM@uÎ¬t]ÐdÀ€s²TçgP@uÎ¬t®dÀŽÐÂÐ(Q@uÎ¬t½cÀ¥)Û$T¿Q@ëœYézê_À\\àßsQ@1Yé:¾SÀèø—o¶§T@<‹™Z9@^â|ÝíS@žÅL-Š>M@)GGUÔÁR@c¦ÅOZ@
C„YäæR@‹1S‹býa@R{íìõQ@ÞWyVÚEfÀ_û(GîQ@',
                    'status' => 1,
                    'created_at' => '2022-03-16 13:22:55',
                    'updated_at' => '2025-09-28 11:53:45',
                    'store_wise_topic' => 'zone_1_store',
                    'customer_wise_topic' => 'zone_1_customer',
                    'deliveryman_wise_topic' => 'zone_1_delivery_man',
                    'cash_on_delivery' => 1,
                    'digital_payment' => 1,
                    'increased_delivery_fee' => 10.0,
                    'increased_delivery_fee_status' => 1,
                    'increase_delivery_charge_message' => 'Increase Delivery Charge Message for rainy weather.',
                    'offline_payment' => 1,
                    'display_name' => NULL,
                ),
                1 => 
                array (
                    'id' => 2,
                    'name' => 'Ø³ÙˆØ¨Ø± Ù…Ø§Ø±ÙƒØª',
                    'coordinates' => '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . ' jõò\'WG@×4f¼àˆ8@jõò8‚G@çY®¿8@ jõògbG@SG~cà8@Ujõò|MG@swo£ÑÖ8@l´¥öBG@¦i¦†Š²8@ jõò\'WG@×4f¼àˆ8@',
                    'status' => 1,
                    'created_at' => '2022-03-22 18:36:28',
                    'updated_at' => '2025-10-07 16:04:37',
                    'store_wise_topic' => 'zone_2_store',
                    'customer_wise_topic' => 'zone_2_customer',
                    'deliveryman_wise_topic' => 'zone_2_delivery_man',
                    'cash_on_delivery' => 1,
                    'digital_payment' => 1,
                    'increased_delivery_fee' => 0.0,
                    'increased_delivery_fee_status' => 0,
                    'increase_delivery_charge_message' => NULL,
                    'offline_payment' => 1,
                    'display_name' => NULL,
                ),
                2 => 
                array (
                    'id' => 3,
                    'name' => 'Dhaka',
                    'coordinates' => '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '' . "\0" . '(9°Y÷|V@}Q®ÿý7@(9°Y»¸V@ç˜’ï‰8@(9°Y¸V@í…g¥”$7@(9°YÇV@c>Ò7@(9°Y÷|V@}Q®ÿý7@',
                        'status' => 1,
                        'created_at' => '2025-02-05 14:38:53',
                        'updated_at' => '2025-10-07 16:04:32',
                        'store_wise_topic' => 'zone_3_store',
                        'customer_wise_topic' => 'zone_3_customer',
                        'deliveryman_wise_topic' => 'zone_3_delivery_man',
                        'cash_on_delivery' => 1,
                        'digital_payment' => 1,
                        'increased_delivery_fee' => 0.0,
                        'increased_delivery_fee_status' => 0,
                        'increase_delivery_charge_message' => NULL,
                        'offline_payment' => 1,
                        'display_name' => 'Dhaka',
                    ),
                ));
        
        
    }
}