<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToColsServiceBookingDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_booking_details', function (Blueprint $table) {
            $table->string('service_type', 255)->nullable();
            $table->string('service_name', 255)->nullable();
            $table->decimal('campaign_discount_amount', 24,3)->default(0.00);
            $table->decimal('overall_coupon_discount_amount', 24,3)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_booking_details', function (Blueprint $table) {
            $table->dropColumn('service_type');
            $table->dropColumn('service_name');
            $table->dropColumn('campaign_discount_amount');
            $table->dropColumn('overall_coupon_discount_amount');
        });
    }
}
