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
        Schema::create('order_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('delivery_man_id')->nullable();
            $table->unsignedBigInteger('order_id');
            $table->decimal('order_amount', 24);
            $table->decimal('store_amount', 24)->default(0);
            $table->decimal('admin_commission', 24);
            $table->string('received_by');
            $table->string('status')->nullable();
            $table->timestamps();
            $table->decimal('delivery_charge', 24)->default(0);
            $table->decimal('original_delivery_charge', 24)->default(0);
            $table->decimal('tax', 24)->default(0);
            $table->unsignedBigInteger('zone_id')->nullable()->index();
            $table->unsignedBigInteger('module_id')->index('order_transactions_module_id_foreign');
            $table->unsignedBigInteger('parcel_catgory_id')->nullable();
            $table->double('dm_tips', 24, 2)->default(0);
            $table->double('delivery_fee_comission', 24, 2)->default(0);
            $table->decimal('admin_expense', 23, 3)->nullable()->default(0);
            $table->double('store_expense', 23, 3)->nullable()->default(0);
            $table->double('discount_amount_by_store', 23, 3)->nullable()->default(0);
            $table->double('additional_charge', 23, 3)->default(0);
            $table->double('extra_packaging_amount', 23, 3)->default(0);
            $table->double('ref_bonus_amount', 23, 3)->default(0);
            $table->double('commission_percentage', 16, 3)->nullable()->default(0);
            $table->boolean('is_subscribed')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_transactions');
    }
};
