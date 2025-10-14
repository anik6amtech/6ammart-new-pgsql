<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id')->nullable();
            $table->foreignId('booking_id')->nullable();
            $table->foreignId('service_id')->nullable();
            $table->foreignId('provider_id')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->integer('review_rating')->default(1);
            $table->text('review_comment')->nullable();
            $table->text('review_images')->nullable();
            $table->dateTime('booking_date')->nullable();
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('service_reviews');
    }
}
