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
        Schema::create('zones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->polygon('coordinates');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->string('store_wise_topic')->nullable();
            $table->string('customer_wise_topic')->nullable();
            $table->string('deliveryman_wise_topic')->nullable();
            $table->boolean('cash_on_delivery')->default(false);
            $table->boolean('digital_payment')->default(false);
            $table->double('increased_delivery_fee', 8, 2)->default(0);
            $table->boolean('increased_delivery_fee_status')->default(false);
            $table->string('increase_delivery_charge_message')->nullable();
            $table->boolean('offline_payment')->default(false);
            $table->string('display_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zones');
    }
};
