<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_posts', function (Blueprint $table) {
            $table->id();
            $table->text('service_description')->nullable();
            $table->dateTime('booking_schedule')->nullable();
            $table->tinyInteger('is_booked')->default(0);
            $table->tinyInteger('is_checked')->default(0);
            $table->foreignId('module_id')->nullable();
            $table->foreignId('booking_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('zone_id')->nullable();
            $table->foreignId('service_id')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->foreignId('sub_category_id')->nullable();
            $table->foreignId('service_address_id')->nullable();
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
        Schema::dropIfExists('service_posts');
    }
}
