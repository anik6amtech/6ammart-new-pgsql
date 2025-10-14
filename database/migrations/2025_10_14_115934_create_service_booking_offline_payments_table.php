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
        Schema::create('service_booking_offline_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('booking_id');
            $table->text('method_name')->nullable();
            $table->json('customer_information');
            $table->unsignedBigInteger('offline_payment_id')->nullable();
            $table->enum('payment_status', ['pending', 'denied', 'approved'])->default('approved');
            $table->text('denied_note')->nullable();
            $table->text('customer_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_booking_offline_payments');
    }
};
