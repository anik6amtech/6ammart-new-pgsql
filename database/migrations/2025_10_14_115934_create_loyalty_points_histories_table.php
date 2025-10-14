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
        Schema::create('loyalty_points_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_type')->default('driver');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('model');
            $table->unsignedBigInteger('model_id')->nullable();
            $table->double('points', null, 0);
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loyalty_points_histories');
    }
};
