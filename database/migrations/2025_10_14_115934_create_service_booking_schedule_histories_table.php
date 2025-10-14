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
        Schema::create('service_booking_schedule_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('booking_id');
            $table->bigInteger('changed_by');
            $table->bigInteger('is_guest')->nullable();
            $table->dateTime('schedule');
            $table->timestamps();
            $table->unsignedBigInteger('booking_repeat_id')->nullable();
            $table->string('user_type')->default('provider');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_booking_schedule_histories');
    }
};
