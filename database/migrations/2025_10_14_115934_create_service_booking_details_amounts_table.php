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
        Schema::create('service_booking_details_amounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('module_id')->nullable();
            $table->unsignedBigInteger('booking_details_id');
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('booking_repeat_id')->nullable();
            $table->unsignedBigInteger('booking_repeat_details_id')->nullable();
            $table->decimal('service_unit_cost', 24)->default(0);
            $table->integer('service_quantity')->default(0);
            $table->decimal('service_tax', 24)->default(0);
            $table->decimal('provider_earning', 24)->default(0);
            $table->decimal('discount_by_admin', 24)->default(0);
            $table->decimal('discount_by_provider', 24)->default(0);
            $table->decimal('coupon_discount_by_admin', 24)->default(0);
            $table->decimal('coupon_discount_by_provider', 24)->default(0);
            $table->decimal('campaign_discount_by_admin', 24)->default(0);
            $table->decimal('campaign_discount_by_provider', 24)->default(0);
            $table->decimal('admin_commission', 24)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_booking_details_amounts');
    }
};
