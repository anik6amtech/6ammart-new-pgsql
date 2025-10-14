<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFareBiddingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fare_biddings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ride_request_id');
            $table->foreignId('driver_id');
            $table->foreignId('customer_id');
            $table->decimal('bid_fare');
            $table->boolean('is_ignored')->default(0);
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
        Schema::dropIfExists('fare_biddings');
    }
}
