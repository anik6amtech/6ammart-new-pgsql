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
        Schema::create('service_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('module_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->unsignedBigInteger('post_id')->nullable();
            $table->string('booking_status')->default('pending');
            $table->string('booking_type')->default('commission')->comment('Type of booking: commission, subscription, or other');
            $table->boolean('is_paid')->default(false);
            $table->string('payment_method')->default('cash');
            $table->string('transaction_id')->nullable();
            $table->decimal('total_booking_amount', 24, 3)->default(0);
            $table->decimal('total_tax_amount', 24, 3)->default(0);
            $table->decimal('total_discount_amount', 24, 3)->default(0);
            $table->dateTime('service_schedule')->nullable();
            $table->unsignedBigInteger('service_address_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->unsignedBigInteger('serviceman_id')->nullable();
            $table->decimal('total_campaign_discount_amount', 24, 3)->default(0);
            $table->decimal('total_coupon_discount_amount', 24, 3)->default(0);
            $table->string('coupon_code')->nullable();
            $table->decimal('additional_charge', 24)->default(0);
            $table->decimal('additional_tax_amount', 24)->default(0);
            $table->decimal('additional_discount_amount', 24)->default(0);
            $table->decimal('additional_campaign_discount_amount', 24)->default(0);
            $table->decimal('removed_coupon_amount', 24)->default(0);
            $table->json('evidence_photos')->nullable();
            $table->decimal('extra_fee', 24, 3)->default(0);
            $table->decimal('total_referral_discount_amount', 24)->default(0);
            $table->string('booking_otp')->nullable();
            $table->boolean('is_checked')->default(false);
            $table->boolean('is_guest')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->tinyInteger('is_repeated')->default(0);
            $table->string('assigned_by')->nullable();
            $table->string('service_location')->default('customer')->comment('customer,provider');
            $table->text('service_address_location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_bookings');
    }
};
