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
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('image', 30)->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('category_ids')->nullable();
            $table->text('variations')->nullable();
            $table->string('add_ons')->nullable();
            $table->string('attributes')->nullable();
            $table->text('choice_options')->nullable();
            $table->decimal('price', 24)->default(0);
            $table->decimal('tax', 24)->default(0);
            $table->string('tax_type', 20)->default('percent');
            $table->decimal('discount', 24)->default(0);
            $table->string('discount_type', 20)->default('percent');
            $table->time('available_time_starts')->nullable();
            $table->time('available_time_ends')->nullable();
            $table->boolean('veg')->default(false);
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('store_id');
            $table->timestamps();
            $table->integer('order_count')->default(0);
            $table->double('avg_rating', 16, 14)->default(0);
            $table->integer('rating_count')->default(0);
            $table->string('rating')->nullable();
            $table->unsignedBigInteger('module_id')->index('items_module_id_foreign');
            $table->integer('stock')->nullable()->default(0);
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->longText('images')->nullable();
            $table->text('food_variations')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('recommended')->default(false);
            $table->boolean('organic')->default(false);
            $table->integer('maximum_cart_quantity')->nullable();
            $table->boolean('is_approved')->default(true);
            $table->boolean('is_halal')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
