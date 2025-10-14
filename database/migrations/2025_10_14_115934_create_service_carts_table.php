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
        Schema::create('service_carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('module_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->string('variant_key', 50)->nullable();
            $table->decimal('service_cost', 24)->default(0);
            $table->integer('quantity')->default(1);
            $table->decimal('discount_amount', 24)->default(0);
            $table->decimal('campaign_discount', 24)->default(0);
            $table->decimal('coupon_discount', 24)->default(0);
            $table->string('coupon_code')->nullable();
            $table->decimal('tax_amount', 24)->default(0);
            $table->decimal('total_cost', 24)->default(0);
            $table->unsignedBigInteger('coupon_id')->default(0);
            $table->boolean('is_guest')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_carts');
    }
};
