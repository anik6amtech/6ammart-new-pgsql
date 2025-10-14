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
        Schema::create('ride_coupon_setups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50)->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->decimal('min_trip_amount')->default(0);
            $table->decimal('max_coupon_amount')->default(0);
            $table->decimal('coupon')->default(0);
            $table->string('amount_type', 15)->default('percentage');
            $table->string('coupon_type', 15)->default('default');
            $table->string('coupon_code')->nullable()->unique();
            $table->integer('limit')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('rules')->nullable();
            $table->decimal('total_used')->default(0);
            $table->decimal('total_amount')->default(0);
            $table->boolean('is_active')->default(true);
            $table->integer('module_id');
            $table->string('zone_coupon_type')->default('custom');
            $table->string('customer_level_coupon_type')->default('custom');
            $table->string('customer_coupon_type')->default('custom');
            $table->text('category_coupon_type');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_coupon_setups');
    }
};
