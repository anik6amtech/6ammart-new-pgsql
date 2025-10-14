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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('images')->nullable();
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('model')->nullable();
            $table->string('type')->nullable();
            $table->string('engine_capacity')->nullable();
            $table->string('engine_power')->nullable();
            $table->string('seating_capacity')->nullable();
            $table->boolean('air_condition')->default(false);
            $table->string('fuel_type')->nullable();
            $table->string('transmission_type')->nullable();
            $table->boolean('multiple_vehicles')->default(false);
            $table->boolean('trip_hourly')->default(false);
            $table->boolean('trip_distance')->default(false);
            $table->decimal('hourly_price', 23, 8)->default(0);
            $table->decimal('distance_price', 23, 8)->default(0);
            $table->string('discount_type')->nullable();
            $table->decimal('discount_price', 23, 8)->default(0);
            $table->text('tag')->nullable();
            $table->text('documents')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('new_tag')->default(true);
            $table->integer('total_trip')->default(0);
            $table->decimal('avg_rating')->default(0);
            $table->string('rating')->nullable();
            $table->integer('total_reviews')->default(0);
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
