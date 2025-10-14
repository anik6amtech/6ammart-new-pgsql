<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToColServiceBookingRepeatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_booking_schedule_histories', function (Blueprint $table) {
            $table->foreignId('booking_repeat_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_booking_schedule_histories', function (Blueprint $table) {
            $table->dropColumn('booking_repeat_id');
        });
    }
}
