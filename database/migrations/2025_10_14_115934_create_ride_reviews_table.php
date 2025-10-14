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
        Schema::create('ride_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ride_request_id')->nullable();
            $table->unsignedBigInteger('given_by')->nullable();
            $table->unsignedBigInteger('received_by')->nullable();
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
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_reviews');
    }
};
