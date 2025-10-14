<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRideCouponSetupVehicleCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ride_coupon_setup_vehicle_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coupon_setup_id');
            $table->foreignId('vehicle_category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ride_coupon_setup_vehicle_category');
    }
}
