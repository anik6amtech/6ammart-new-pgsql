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
        Schema::create('service_discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('module_id')->nullable();
            $table->string('discount_title', 191)->nullable();
            $table->string('discount_type', 191)->nullable();
            $table->decimal('discount_amount', 24, 3)->default(0);
            $table->string('discount_amount_type', 191)->default('percent');
            $table->decimal('min_purchase', 24, 3)->default(0);
            $table->decimal('max_discount_amount', 24, 3)->default(0);
            $table->integer('limit_per_user')->default(0);
            $table->string('promotion_type', 191)->default('discount');
            $table->boolean('is_active')->default(false);
            $table->date('start_date')->default('2025-09-04');
            $table->date('end_date')->default('2025-09-04');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_discounts');
    }
};
