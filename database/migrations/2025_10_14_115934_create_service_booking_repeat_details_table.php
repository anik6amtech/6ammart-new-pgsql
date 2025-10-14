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
        Schema::create('service_booking_repeat_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('booking_repeat_id')->nullable();
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->unsignedBigInteger('booking_details_id')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->string('variant_key')->nullable();
            $table->string('service_name')->nullable();
            $table->decimal('service_cost', 24, 3)->default(0);
            $table->integer('quantity')->default(1);
            $table->decimal('discount_amount', 24, 3)->default(0);
            $table->decimal('tax_amount', 24, 3)->default(0);
            $table->decimal('total_cost', 24, 3)->default(0);
            $table->decimal('campaign_discount_amount', 24, 3)->default(0);
            $table->decimal('overall_coupon_discount_amount', 24, 3)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_booking_repeat_details');
    }
};
