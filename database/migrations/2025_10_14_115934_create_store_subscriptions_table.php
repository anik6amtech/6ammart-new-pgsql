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
        Schema::create('store_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('package_id');
            $table->string('store_type')->default('store')->comment('store, service_provider');
            $table->unsignedBigInteger('store_id');
            $table->date('expiry_date');
            $table->integer('validity')->default(0);
            $table->string('max_order');
            $table->string('max_product');
            $table->boolean('pos')->default(false);
            $table->boolean('mobile_app')->default(false);
            $table->boolean('chat')->default(false);
            $table->boolean('review')->default(false);
            $table->boolean('self_delivery')->default(false);
            $table->boolean('scheduled_service')->default(false);
            $table->boolean('service_request')->default(false);
            $table->boolean('advertisement')->default(false);
            $table->boolean('reports_and_analytics')->default(false);
            $table->boolean('bidding')->default(false);
            $table->boolean('status')->default(true);
            $table->boolean('is_trial')->default(false);
            $table->tinyInteger('total_package_renewed')->default(0);
            $table->dateTime('renewed_at')->nullable();
            $table->boolean('is_canceled')->default(false);
            $table->enum('canceled_by', ['none', 'admin', 'store'])->default('none');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_subscriptions');
    }
};
