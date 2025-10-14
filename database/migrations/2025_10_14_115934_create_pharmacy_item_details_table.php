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
        Schema::create('pharmacy_item_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('common_condition_id')->nullable();
            $table->boolean('is_basic')->default(false);
            $table->unsignedBigInteger('temp_product_id')->nullable();
            $table->timestamps();
            $table->boolean('is_prescription_required')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacy_item_details');
    }
};
