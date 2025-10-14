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
        Schema::create('service_booking_repeat_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->unsignedBigInteger('booking_repeat_id')->nullable();
            $table->unsignedBigInteger('booking_repeat_details_id')->nullable();
            $table->integer('old_quantity')->nullable();
            $table->integer('new_quantity')->nullable();
            $table->tinyInteger('is_multiple')->default(0);
            $table->decimal('total_booking_amount', 24, 3)->default(0);
            $table->decimal('total_tax_amount', 24, 3)->default(0);
            $table->decimal('total_discount_amount', 24, 3)->default(0);
            $table->decimal('extra_fee', 24, 3)->default(0);
            $table->decimal('total_referral_discount_amount', 24, 3)->default(0);
            $table->json('log_details')->nullable();
            $table->timestamps();
            $table->string('readable_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_booking_repeat_histories');
    }
};
