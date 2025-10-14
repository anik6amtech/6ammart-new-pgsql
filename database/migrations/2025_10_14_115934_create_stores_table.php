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
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone', 20)->unique('restaurants_phone_unique');
            $table->string('email', 100)->nullable();
            $table->string('logo')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('address')->nullable();
            $table->text('footer_text')->nullable();
            $table->decimal('minimum_order', 24)->default(0);
            $table->decimal('comission', 24)->nullable();
            $table->boolean('schedule_order')->default(false);
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('vendor_id');
            $table->timestamps();
            $table->boolean('free_delivery')->default(false);
            $table->string('rating')->nullable();
            $table->string('cover_photo')->nullable();
            $table->boolean('delivery')->default(true);
            $table->boolean('take_away')->default(true);
            $table->boolean('item_section')->default(true);
            $table->decimal('tax', 24)->default(0);
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->boolean('reviews_section')->default(true);
            $table->boolean('active')->default(true);
            $table->string('off_day', 191)->default(' ');
            $table->string('gst', 191)->nullable();
            $table->boolean('self_delivery_system')->default(false);
            $table->boolean('pos_system')->default(false);
            $table->decimal('minimum_shipping_charge', 24)->default(0);
            $table->string('delivery_time', 100)->nullable()->default('30-40');
            $table->boolean('veg')->default(true);
            $table->boolean('non_veg')->default(true);
            $table->unsignedInteger('order_count')->default(0);
            $table->unsignedInteger('total_order')->default(0);
            $table->unsignedBigInteger('module_id')->index('stores_module_id_foreign');
            $table->integer('order_place_to_schedule_interval')->nullable()->default(0);
            $table->boolean('featured')->default(false);
            $table->double('per_km_shipping_charge', 16, 3)->unsigned()->default(0);
            $table->boolean('prescription_order')->default(false);
            $table->string('slug')->nullable();
            $table->double('maximum_shipping_charge', 23, 3)->nullable();
            $table->boolean('cutlery')->default(false);
            $table->string('meta_title', 100)->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_image', 100)->nullable();
            $table->boolean('announcement')->default(false);
            $table->string('announcement_message')->nullable();
            $table->enum('store_business_model', ['none', 'commission', 'subscription', 'unsubscribed'])->default('commission');
            $table->unsignedBigInteger('package_id')->nullable();
            $table->longText('pickup_zone_id')->nullable();
            $table->text('comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
