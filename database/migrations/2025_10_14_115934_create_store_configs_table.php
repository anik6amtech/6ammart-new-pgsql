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
        Schema::create('store_configs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->boolean('is_recommended')->default(false);
            $table->boolean('is_recommended_deleted')->default(false);
            $table->timestamps();
            $table->boolean('halal_tag_status')->default(false);
            $table->boolean('extra_packaging_status')->default(false);
            $table->double('extra_packaging_amount', 23, 3)->default(0);
            $table->integer('minimum_stock_for_warning')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_configs');
    }
};
