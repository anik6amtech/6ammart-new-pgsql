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
        Schema::create('user_level_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_level_id');
            $table->unsignedBigInteger('user_id');
            $table->string('user_type');
            $table->integer('completed_ride')->default(0);
            $table->boolean('ride_reward_status')->default(false);
            $table->decimal('total_amount')->default(0);
            $table->boolean('amount_reward_status')->default(false);
            $table->decimal('cancellation_rate')->default(0);
            $table->boolean('cancellation_reward_status')->default(false);
            $table->integer('reviews')->default(0);
            $table->boolean('reviews_reward_status')->default(false);
            $table->boolean('is_level_reward_granted')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_level_histories');
    }
};
