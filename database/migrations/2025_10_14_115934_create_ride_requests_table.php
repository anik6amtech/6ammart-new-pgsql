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
        Schema::create('ride_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref_id', 20);
            $table->unsignedBigInteger('module_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('vehicle_category_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->decimal('estimated_fare', 23, 3);
            $table->decimal('actual_fare', 23, 3)->default(0);
            $table->double('estimated_distance', 8, 2);
            $table->decimal('paid_fare', 23, 3)->default(0);
            $table->double('actual_distance', 8, 2)->nullable();
            $table->longText('encoded_polyline')->nullable();
            $table->string('accepted_by')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->nullable()->default('unpaid');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->decimal('coupon_amount', 23, 3)->nullable();
            $table->text('note')->nullable();
            $table->string('entrance')->nullable();
            $table->string('otp')->nullable();
            $table->integer('rise_request_count')->default(0);
            $table->string('type')->nullable();
            $table->string('current_status', 20)->default('pending');
            $table->boolean('checked')->default(false);
            $table->double('tips', null, 0)->default(0);
            $table->boolean('is_paused')->default(false)->comment('ride_pause_status');
            $table->string('map_screenshot')->nullable();
            $table->longText('ride_cancellation_reason')->nullable();
            $table->unsignedBigInteger('discount_id')->nullable();
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
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_requests');
    }
};
