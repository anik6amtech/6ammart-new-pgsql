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
        Schema::create('rider_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('is_online')->default('0');
            $table->string('availability_status')->default('unavailable');
            $table->time('online')->nullable();
            $table->time('offline')->nullable();
            $table->double('online_time', 23, 2)->default(0);
            $table->time('accepted')->nullable();
            $table->time('completed')->nullable();
            $table->time('start_driving')->nullable();
            $table->double('on_driving_time', 23, 2)->default(0);
            $table->double('idle_time', 23, 2)->default(0);
            $table->json('service')->nullable();
            $table->integer('ride_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rider_details');
    }
};
