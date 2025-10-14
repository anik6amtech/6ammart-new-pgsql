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
        Schema::create('ride_discount_setups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->mediumText('short_description');
            $table->mediumText('terms_conditions');
            $table->longText('image');
            $table->string('zone_discount_type')->default('custom');
            $table->string('customer_discount_type')->default('custom');
            $table->text('module_discount_type');
            $table->string('discount_amount_type');
            $table->integer('limit_per_user')->default(0);
            $table->double('discount_amount', null, 0);
            $table->double('max_discount_amount', null, 0)->default(0);
            $table->double('min_trip_amount', null, 0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('total_used')->default(0);
            $table->double('total_amount', null, 0)->default(0);
            $table->boolean('is_active')->default(true);
            $table->integer('module_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_discount_setups');
    }
};
