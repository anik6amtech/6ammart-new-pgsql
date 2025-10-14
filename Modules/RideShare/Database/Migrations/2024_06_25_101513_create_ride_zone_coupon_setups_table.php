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
        Schema::create('ride_zone_coupon_setups', function (Blueprint $table) {
            $table->foreignId('zone_id');
            $table->foreignId('coupon_setup_id');
            $table->primary(['zone_id', 'coupon_setup_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_zone_coupon_setups');
    }
};
