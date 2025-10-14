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
        Schema::create('user_levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sequence');
            $table->string('name', 191);
            $table->string('reward_type', 20);
            $table->decimal('reward_amount', 24)->nullable();
            $table->string('image', 191)->nullable();
            $table->integer('targeted_ride');
            $table->integer('targeted_ride_point');
            $table->double('targeted_amount', null, 0);
            $table->integer('targeted_amount_point');
            $table->integer('targeted_cancel');
            $table->integer('targeted_cancel_point');
            $table->integer('targeted_review');
            $table->integer('targeted_review_point');
            $table->string('user_type', 20);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_levels');
    }
};
