<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ride_vehicle_category_coupon_setups', function (Blueprint $table) {
            $table->foreignId('rider_vehicle_category_id');
            $table->foreignId('coupon_setup_id');
            $table->primary(['rider_vehicle_category_id', 'coupon_setup_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_vehicle_category_coupon_setups');
    }
};
