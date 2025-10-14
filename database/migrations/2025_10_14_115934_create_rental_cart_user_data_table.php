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
        Schema::create('rental_cart_user_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->text('pickup_location')->nullable();
            $table->text('destination_location')->nullable();
            $table->dateTime('pickup_time')->nullable();
            $table->enum('rental_type', ['hourly', 'distance_wise'])->default('hourly');
            $table->double('estimated_hours', 23, 8)->default(0);
            $table->double('distance', 23, 8)->default(0);
            $table->double('total_cart_price', 23, 8)->default(0);
            $table->double('destination_time', 23, 8)->default(0);
            $table->boolean('is_guest')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_cart_user_data');
    }
};
