<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceBookingOfflinePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_booking_offline_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id');
            $table->text('method_name')->nullable();
            $table->json('customer_information');
            $table->foreignId('offline_payment_id')->nullable();
            $table->enum('payment_status', ['pending', 'denied', 'approved'])->default('approved');
            $table->text('denied_note')->nullable();
            $table->text('customer_note')->nullable();
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
        Schema::dropIfExists('service_booking_offline_payments');
    }
}
