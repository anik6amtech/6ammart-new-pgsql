<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoyaltyPointsHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyalty_points_histories', function (Blueprint $table) {
            $table->id();
            $table->string('user_type')->default('driver');
            $table->foreignId('user_id')->nullable();
            $table->string('model');
            $table->foreignId('model_id')->nullable();
            $table->double('points');
            $table->string('type');
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
        Schema::dropIfExists('loyalty_points_histories');
    }
}
