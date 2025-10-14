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
        Schema::create('ride_fares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('zone_wise_default_ride_fare_id');
            $table->unsignedBigInteger('zone_id');
            $table->unsignedBigInteger('vehicle_category_id');
            $table->decimal('base_fare');
            $table->decimal('base_fare_per_km');
            $table->decimal('waiting_fee_per_min');
            $table->decimal('cancellation_fee_percent');
            $table->decimal('min_cancellation_fee');
            $table->decimal('idle_fee_per_min');
            $table->decimal('ride_delay_fee_per_min');
            $table->decimal('penalty_fee_for_cancel');
            $table->decimal('fee_add_to_next');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_fares');
    }
};
