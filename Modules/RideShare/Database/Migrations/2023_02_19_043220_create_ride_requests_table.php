<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRideRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ride_requests', function (Blueprint $table) {
            $table->id();
            $table->string('ref_id', 20);
            $table->foreignId('customer_id')->nullable();
            $table->foreignId('driver_id')->nullable();
            $table->foreignId('vehicle_category_id')->nullable();
            $table->foreignId('vehicle_id')->nullable();
            $table->foreignId('zone_id')->nullable();
            $table->foreignId('area_id')->nullable();
            $table->decimal('estimated_fare', 23, 3);
            $table->decimal('actual_fare', 23, 3)->default(0);
            $table->float('estimated_distance');
            $table->decimal('paid_fare', 23, 3)->default(0);
            $table->float('actual_distance')->nullable();
            $table->text('encoded_polyline')->nullable();
            $table->string('accepted_by')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->nullable()->default('unpaid');
            $table->foreignId('coupon_id')->nullable();
            $table->decimal('coupon_amount', 23, 3)->nullable();
            $table->text('note')->nullable();
            $table->string('entrance')->nullable();
            $table->string('otp')->nullable();
            $table->integer('rise_request_count')->default(0);
            $table->string('type')->nullable();
            $table->string('current_status', 20)->default('pending');
            $table->boolean('checked')->default('0');
            $table->double('tips')->default(0);
            $table->boolean('is_paused')->default(false)->comment('ride_pause_status');
            $table->string('map_screenshot')->nullable();
            $table->longText('ride_cancellation_reason')->nullable();
            $table->foreignId('discount_id')->nullable();
            $table->decimal('discount_amount', 23, 3)->nullable();
            $table->decimal('return_fee', 23, 3)->default(0);
            $table->dateTime('return_time')->nullable();
            $table->decimal('due_amount', 23, 3)->default(0);
            $table->decimal('cancellation_fee', 23, 3)->default(0);
            $table->decimal('extra_fare_fee', 23, 3)->default(0);
            $table->decimal('extra_fare_amount', 23, 3)->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('ride_requests');
    }
}
