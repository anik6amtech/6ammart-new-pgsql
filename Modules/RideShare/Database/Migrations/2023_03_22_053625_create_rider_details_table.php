<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rider_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('is_online')->default(false);
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
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rider_details');
    }
}
