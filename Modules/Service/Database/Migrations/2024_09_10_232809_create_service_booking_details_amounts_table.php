<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceBookingDetailsAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_booking_details_amounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->nullable();
            $table->foreignId('booking_details_id');
            $table->foreignId('booking_id');
            $table->foreignId('booking_repeat_id')->nullable();
            $table->foreignId('booking_repeat_details_id')->nullable();

            $table->decimal('service_unit_cost',24,2)->default(0);
            $table->integer('service_quantity')->default(0);
            $table->decimal('service_tax',24,2)->default(0);
            $table->decimal('provider_earning',24,2)->default(0);

            $table->decimal('discount_by_admin',24,2)->default(0);
            $table->decimal('discount_by_provider',24,2)->default(0);

            $table->decimal('coupon_discount_by_admin',24,2)->default(0);
            $table->decimal('coupon_discount_by_provider',24,2)->default(0);

            $table->decimal('campaign_discount_by_admin',24,2)->default(0);
            $table->decimal('campaign_discount_by_provider',24,2)->default(0);

            $table->decimal('admin_commission',24,2)->default(0);
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
        Schema::dropIfExists('service_booking_details_amounts');
    }
}
