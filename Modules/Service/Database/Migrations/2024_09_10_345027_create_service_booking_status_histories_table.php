<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceBookingStatusHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_booking_status_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id');
            $table->foreignId('changed_by');
            $table->string('booking_status');
            $table->foreignId('booking_repeat_id')->nullable();
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
        Schema::dropIfExists('service_booking_status_histories');
    }
}
