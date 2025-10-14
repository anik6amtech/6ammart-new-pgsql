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
        Schema::create('ride_vehicle_category_discount_setups', function (Blueprint $table) {
            $table->char('rider_vehicle_category_id', 36);
            $table->char('discount_setup_id', 36);

            $table->primary(['rider_vehicle_category_id', 'discount_setup_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_vehicle_category_discount_setups');
    }
};
