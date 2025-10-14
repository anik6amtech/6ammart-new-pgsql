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
        Schema::create('ride_request_times', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ride_request_id');
            $table->double('estimated_time', 10, 4);
            $table->double('actual_time', 8, 2)->nullable();
            $table->double('waiting_time', 8, 2)->nullable();
            $table->double('delay_time', 8, 2)->nullable();
            $table->timestamp('idle_timestamp')->nullable();
            $table->double('idle_time', 8, 2)->nullable();
            $table->double('driver_arrival_time', 8, 2)->nullable();
            $table->timestamp('driver_arrival_timestamp')->nullable();
            $table->timestamp('driver_arrives_at')->nullable();
            $table->timestamp('customer_arrives_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_request_times');
    }
};
