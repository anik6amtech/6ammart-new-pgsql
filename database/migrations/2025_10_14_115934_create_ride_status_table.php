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
        Schema::create('ride_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ride_request_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->timestamp('pending')->nullable();
            $table->timestamp('accepted')->nullable();
            $table->timestamp('out_for_pickup')->nullable();
            $table->timestamp('picked_up')->nullable();
            $table->timestamp('ongoing')->nullable();
            $table->timestamp('completed')->nullable();
            $table->timestamp('cancelled')->nullable();
            $table->timestamp('failed')->nullable();
            $table->text('note')->nullable();
            $table->timestamp('returning')->nullable();
            $table->timestamp('returned')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_status');
    }
};
