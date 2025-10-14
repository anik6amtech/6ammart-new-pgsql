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
        Schema::create('rider_vehicle_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->string('image');
            $table->string('type');
            $table->boolean('is_active')->default(true);
            $table->double('starting_coverage_area', 16, 2)->nullable();
            $table->double('maximum_coverage_area', 16, 2)->nullable();
            $table->double('extra_charges', 16, 2)->nullable();
            $table->boolean('is_delivery')->default(false);
            $table->boolean('is_ride')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rider_vehicle_categories');
    }
};
