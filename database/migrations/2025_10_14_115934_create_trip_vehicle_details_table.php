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
        Schema::create('trip_vehicle_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('trip_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('trip_details_id')->nullable();
            $table->unsignedBigInteger('vehicle_identity_id')->nullable();
            $table->unsignedBigInteger('vehicle_driver_id')->nullable();
            $table->dateTime('estimated_trip_end_time')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_vehicle_details');
    }
};
