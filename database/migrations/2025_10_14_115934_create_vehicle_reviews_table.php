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
        Schema::create('vehicle_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('module_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('trip_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('vehicle_identity_id')->nullable();
            $table->integer('rating')->nullable();
            $table->mediumText('comment')->nullable();
            $table->text('attachment')->nullable();
            $table->boolean('status')->default(true);
            $table->mediumText('reply')->nullable();
            $table->string('review_id', 100)->nullable();
            $table->dateTime('replied_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_reviews');
    }
};
