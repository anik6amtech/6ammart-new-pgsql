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
        Schema::create('zone_wise_default_ride_fares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('zone_id');
            $table->double('base_fare', null, 0);
            $table->double('base_fare_per_km', null, 0);
            $table->double('waiting_fee_per_min', null, 0);
            $table->double('cancellation_fee_percent', null, 0);
            $table->double('min_cancellation_fee', null, 0);
            $table->double('idle_fee_per_min', null, 0);
            $table->double('ride_delay_fee_per_min', null, 0);
            $table->double('penalty_fee_for_cancel', null, 0);
            $table->double('fee_add_to_next', null, 0);
            $table->integer('category_wise_different_fare');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zone_wise_default_ride_fares');
    }
};
