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
        Schema::create('service_booking_repeats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->unsignedBigInteger('booking_details_id')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->unsignedBigInteger('serviceman_id')->nullable();
            $table->string('booking_type')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('booking_status')->default('pending');
            $table->dateTime('service_schedule')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->string('payment_method')->default('cash');
            $table->decimal('total_booking_amount', 24, 3)->default(0);
            $table->decimal('total_tax_amount', 24, 3)->default(0);
            $table->decimal('total_discount_amount', 24, 3)->default(0);
            $table->decimal('total_campaign_discount_amount', 24, 3)->default(0);
            $table->decimal('total_coupon_discount_amount', 24, 3)->default(0);
            $table->decimal('removed_coupon_amount', 24, 3)->default(0);
            $table->decimal('additional_charge', 24, 3)->default(0);
            $table->decimal('additional_tax_amount', 24, 3)->default(0);
            $table->decimal('additional_discount_amount', 24, 3)->default(0);
            $table->decimal('additional_campaign_discount_amount', 24, 3)->default(0);
            $table->decimal('extra_fee', 24, 3)->default(0);
            $table->decimal('total_referral_discount_amount', 24, 3)->default(0);
            $table->string('coupon_code')->nullable();
            $table->tinyInteger('is_verified')->default(0);
            $table->tinyInteger('is_reassign')->default(0);
            $table->longText('evidence_photos')->nullable();
            $table->string('booking_otp')->nullable();
            $table->string('service_location')->default('customer')->comment('customer,provider');
            $table->text('service_address_location')->nullable();
            $table->timestamps();
            $table->string('readable_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_booking_repeats');
    }
};
