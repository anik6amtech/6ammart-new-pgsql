<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRideCouponSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ride_coupon_setups', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->nullable();
            $table->string('description', 255)->nullable();
            $table->foreignId('user_id')->nullable();
            // $table->foreignId('user_level_id')->nullable()->constrained('user_levels');
            $table->decimal('min_trip_amount')->default(0);
            $table->decimal('max_coupon_amount')->default(0);
            $table->decimal('coupon')->default(0);
            $table->string('amount_type',15)->default('percentage');
            $table->string('coupon_type',15)->default('default');
            $table->string('coupon_code')->unique()->nullable();
            $table->integer('limit')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('rules')->nullable();
            $table->decimal('total_used')->default(0);
            $table->decimal('total_amount')->default(0);
            $table->boolean('is_active')->default(1);
            $table->integer('module_id');
            $table->string('zone_coupon_type')->default(CUSTOM);
            $table->string('customer_level_coupon_type')->default(CUSTOM);
            $table->string('customer_coupon_type')->default(CUSTOM);
            $table->text('category_coupon_type');
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
        Schema::dropIfExists('ride_coupon_setups');
    }
}
