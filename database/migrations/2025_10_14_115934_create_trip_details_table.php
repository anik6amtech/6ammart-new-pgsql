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
        Schema::create('trip_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('trip_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->smallInteger('quantity')->default(1);
            $table->double('price', 23, 8)->default(0);
            $table->double('original_price', 23, 8)->default(0);
            $table->double('calculated_price', 23, 8)->default(0);
            $table->double('discount_on_trip', 23, 8)->default(0);
            $table->double('tax_amount', 23, 8)->default(0);
            $table->enum('tax_status', ['included', 'excluded'])->default('excluded');
            $table->double('tax_percentage', 23, 8)->default(0);
            $table->string('discount_type', 100)->nullable();
            $table->enum('discount_on_trip_by', ['admin', 'vendor', 'none'])->default('none');
            $table->double('discount_percentage', 23, 8)->default(0);
            $table->text('vehicle_details')->nullable();
            $table->enum('rental_type', ['hourly', 'distance_wise'])->default('hourly');
            $table->double('estimated_hours', 23, 8)->default(0);
            $table->double('distance', 23, 8)->default(0);
            $table->boolean('scheduled')->default(false);
            $table->dateTime('schedule_at')->nullable();
            $table->dateTime('estimated_trip_end_time')->nullable();
            $table->boolean('is_edited')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_details');
    }
};
