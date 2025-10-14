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
        Schema::create('module_zone', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('module_id');
            $table->unsignedBigInteger('zone_id');
            $table->double('per_km_shipping_charge', 23, 2)->nullable();
            $table->double('minimum_shipping_charge', 23, 2)->nullable();
            $table->double('maximum_cod_order_amount', 23, 2)->nullable();
            $table->double('maximum_shipping_charge', 23, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_zone');
    }
};
