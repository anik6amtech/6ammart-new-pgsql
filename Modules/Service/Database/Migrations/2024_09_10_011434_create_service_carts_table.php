<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->foreignId('provider_id')->nullable();
            $table->foreignId('service_id')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->foreignId('sub_category_id')->nullable();
            $table->string('variant_key',50)->nullable();
            $table->decimal('service_cost',24,2)->default(0);
            $table->integer('quantity')->default(1);
            $table->decimal('discount_amount',24,2)->default(0);
            $table->decimal('campaign_discount',24,2)->default(0);
            $table->decimal('coupon_discount',24,2)->default(0);
            $table->string('coupon_code')->nullable();
            $table->decimal('tax_amount',24,2)->default(0);
            $table->decimal('total_cost',24,2)->default(0);
            $table->foreignId('coupon_id')->default(0);
            $table->boolean('is_guest')->default(0);
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
        Schema::dropIfExists('service_carts');
    }
}
