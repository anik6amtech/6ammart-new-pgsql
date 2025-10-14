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
        Schema::create('temp_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('image', 30)->nullable();
            $table->longText('images')->nullable();
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('module_id');
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('category_ids')->nullable();
            $table->string('tag_ids')->nullable();
            $table->string('slug')->nullable();
            $table->text('variations')->nullable();
            $table->text('food_variations')->nullable();
            $table->string('add_ons')->nullable();
            $table->string('attributes')->nullable();
            $table->text('choice_options')->nullable();
            $table->decimal('price', 24)->default(0);
            $table->decimal('tax', 24)->default(0);
            $table->string('tax_type', 20)->default('percent');
            $table->decimal('discount')->default(0);
            $table->string('discount_type', 20)->default('percent');
            $table->boolean('veg')->default(false);
            $table->boolean('recommended')->default(false);
            $table->boolean('organic')->default(false);
            $table->unsignedBigInteger('common_condition_id')->nullable();
            $table->boolean('basic')->default(false);
            $table->boolean('status')->default(true);
            $table->integer('stock')->nullable()->default(0);
            $table->integer('maximum_cart_quantity')->nullable();
            $table->text('note')->nullable();
            $table->boolean('is_rejected')->default(false);
            $table->time('available_time_ends')->nullable();
            $table->time('available_time_starts')->nullable();
            $table->timestamps();
            $table->boolean('is_halal')->default(false);
            $table->boolean('brand_id')->default(false);
            $table->boolean('is_prescription_required')->default(false);
            $table->string('nutrition_ids')->nullable();
            $table->string('allergy_ids')->nullable();
            $table->string('generic_ids')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_products');
    }
};
