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
        Schema::create('rider_vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ref_id', 20);
            $table->foreignId('brand_id');
            $table->foreignId('model_id');
            $table->foreignId('category_id');
            $table->string('licence_plate_number');
            $table->date('licence_expire_date');
            $table->string('vin_number')->nullable();
            $table->string('transmission')->nullable();
            $table->double('parcel_weight_capacity')->nullable();
            $table->string('fuel_type');
            $table->string('ownership');
            $table->foreignId('rider_id');
            $table->json('documents')->nullable();
            $table->boolean('is_active')->default(0);
            $table->json('draft')->nullable();
            $table->string('vehicle_request_status')->default('approved');
            $table->mediumText('deny_note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rider_vehicles');
    }
};
