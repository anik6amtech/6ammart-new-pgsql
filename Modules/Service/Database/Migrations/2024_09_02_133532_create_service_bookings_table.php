<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->foreignId('provider_id')->nullable();
            $table->foreignId('zone_id')->nullable();
            $table->string('booking_status')->default('pending');
            $table->boolean('is_paid')->default(0);
            $table->string('payment_method')->default('cash');
            $table->string('transaction_id')->nullable();
            $table->decimal('total_booking_amount',24,3)->default(0);
            $table->decimal('total_tax_amount',24,3)->default(0);
            $table->decimal('total_discount_amount',24,3)->default(0);
            $table->dateTime('service_schedule')->nullable();
            $table->foreignId('service_address_id')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->foreignId('sub_category_id')->nullable();
            $table->foreignId('serviceman_id')->nullable();
            $table->decimal('total_campaign_discount_amount',24,3)->default(0);
            $table->decimal('total_coupon_discount_amount',24,3)->default(0);
            $table->string('coupon_code')->nullable();
            $table->decimal('additional_charge',24,2)->default(0);
            $table->decimal('additional_tax_amount',24,2)->default(0);
            $table->decimal('additional_discount_amount',24,2)->default(0);
            $table->decimal('additional_campaign_discount_amount',24,2)->default(0);
            $table->decimal('removed_coupon_amount',24,2)->default(0);
            $table->json('evidence_photos')->nullable();
            $table->decimal('extra_fee',24,3)->default(0);
            $table->decimal('total_referral_discount_amount',24,2)->default(0);
            $table->string('booking_otp')->nullable();
            $table->boolean('is_checked')->default(false);
            $table->boolean('is_guest')->default(0);
            $table->boolean('is_verified')->default(0);
            $table->tinyInteger('is_repeated')->default(0);
            $table->string('assigned_by')->nullable();
            $table->string('service_location')->default('customer')->comment('customer,provider');
            $table->text('service_address_location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_bookings');
    }
}
