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
        Schema::create('rider_time_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('rider_id', 36);
            $table->date('date');
            $table->time('online')->nullable();
            $table->time('offline')->nullable();
            $table->double('online_time', 23, 2)->default(0);
            $table->time('accepted')->nullable();
            $table->time('completed')->nullable();
            $table->time('start_driving')->nullable();
            $table->double('on_driving_time', 23, 2)->default(0);
            $table->double('idle_time', 23, 2)->default(0);
            $table->string('on_time_completed')->nullable()->default('0');
            $table->string('late_completed')->nullable()->default('0');
            $table->string('late_pickup')->nullable()->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rider_time_logs');
    }
};
