<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRideReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ride_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ride_request_id')->nullable();
            $table->foreignId('given_by')->nullable();
            $table->foreignId('received_by')->nullable();
            $table->string('ride_type')->nullable();
            $table->integer('rating')->default(1);
            $table->text('feedback')->nullable();
            $table->string('images')->nullable();
            $table->string('review_for')->nullable()->comment('customer,rider');
            $table->boolean('is_saved')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('ride_reviews');
    }
}
