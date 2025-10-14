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
        Schema::create('subscription_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('package_id');
            $table->string('store_type')->default('store')->comment('store, service_provider');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('store_subscription_id')->nullable();
            $table->double('price', 24, 3)->default(0);
            $table->double('previous_due', 24, 3)->default(0);
            $table->integer('validity')->default(0);
            $table->string('payment_method', 191);
            $table->string('payment_status', 191);
            $table->string('reference', 191)->nullable();
            $table->double('paid_amount', 24, 2);
            $table->integer('discount')->default(0);
            $table->longText('package_details');
            $table->string('created_by', 50);
            $table->boolean('is_trial')->default(false);
            $table->boolean('transaction_status')->default(true);
            $table->enum('plan_type', ['renew', 'new_plan', 'first_purchased', 'free_trial'])->default('first_purchased');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_transactions');
    }
};
