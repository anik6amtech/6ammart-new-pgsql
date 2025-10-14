<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToColServiceBookingScheduleHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_booking_schedule_histories', function (Blueprint $table) {
            $table->string('user_type')->default('provider');
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
            $table->dropColumn('user_type');
        });
    }
}
