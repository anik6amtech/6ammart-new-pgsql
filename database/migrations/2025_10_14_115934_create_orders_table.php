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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->decimal('order_amount', 24)->default(0);
            $table->decimal('coupon_discount_amount', 24)->default(0);
            $table->string('coupon_discount_title')->nullable();
            $table->string('payment_status')->default('unpaid');
            $table->string('order_status')->default('pending');
            $table->decimal('total_tax_amount', 24)->default(0);
            $table->string('payment_method', 30)->nullable();
            $table->string('transaction_reference', 30)->nullable();
            $table->bigInteger('delivery_address_id')->nullable();
            $table->unsignedBigInteger('delivery_man_id')->nullable();
            $table->string('coupon_code')->nullable();
            $table->text('order_note')->nullable();
            $table->string('order_type')->default('delivery');
            $table->boolean('checked')->default(false);
            $table->unsignedBigInteger('store_id')->nullable();
            $table->timestamps();
            $table->decimal('delivery_charge', 24)->default(0);
            $table->timestamp('schedule_at')->nullable();
            $table->string('callback')->nullable();
            $table->string('otp')->nullable();
            $table->timestamp('pending')->nullable();
            $table->timestamp('accepted')->nullable();
            $table->timestamp('confirmed')->nullable();
            $table->timestamp('processing')->nullable();
            $table->timestamp('handover')->nullable();
            $table->timestamp('picked_up')->nullable();
            $table->timestamp('delivered')->nullable();
            $table->timestamp('canceled')->nullable();
            $table->timestamp('refund_requested')->nullable();
            $table->timestamp('refunded')->nullable();
            $table->text('delivery_address')->nullable();
            $table->boolean('scheduled')->default(false);
            $table->decimal('store_discount_amount', 24)->default(0);
            $table->decimal('original_delivery_charge', 24)->default(0);
            $table->timestamp('failed')->nullable();
            $table->decimal('adjusment', 24)->default(0);
            $table->boolean('edited')->default(false);
            $table->string('delivery_time')->nullable();
            $table->unsignedBigInteger('zone_id')->nullable()->index('zone_id');
            $table->unsignedBigInteger('module_id')->index('orders_module_id_foreign');
            $table->text('order_attachment')->nullable();
            $table->double('distance', 16, 3)->default(0);
            $table->unsignedBigInteger('parcel_category_id')->nullable();
            $table->longText('receiver_details')->nullable();
            $table->enum('charge_payer', ['sender', 'receiver'])->nullable();
            $table->double('dm_tips', 24, 2)->default(0);
            $table->string('free_delivery_by')->nullable();
            $table->timestamp('refund_request_canceled')->nullable();
            $table->boolean('prescription_order')->default(false);
            $table->string('tax_status', 50)->nullable();
            $table->unsignedBigInteger('dm_vehicle_id')->nullable();
            $table->string('cancellation_reason')->nullable();
            $table->string('canceled_by', 50)->nullable();
            $table->string('coupon_created_by', 50)->nullable();
            $table->string('discount_on_product_by', 50)->default('vendor');
            $table->string('processing_time', 10)->nullable();
            $table->string('unavailable_item_note')->nullable();
            $table->boolean('cutlery')->default(false);
            $table->text('delivery_instruction')->nullable();
            $table->double('tax_percentage', 24, 3)->nullable();
            $table->double('additional_charge', 23, 3)->default(0);
            $table->text('order_proof')->nullable();
            $table->double('partially_paid_amount', 23, 3)->default(0);
            $table->boolean('is_guest')->default(false);
            $table->double('flash_admin_discount_amount', 24, 3)->default(0);
            $table->double('flash_store_discount_amount', 24, 3)->default(0);
            $table->unsignedBigInteger('cash_back_id')->nullable();
            $table->double('extra_packaging_amount', 23, 3)->default(0);
            $table->double('ref_bonus_amount', 23, 3)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
