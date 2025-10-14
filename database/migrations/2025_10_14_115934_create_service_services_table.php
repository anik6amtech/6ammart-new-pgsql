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
        Schema::create('service_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('module_id')->nullable();
            $table->string('name', 191)->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('cover_image', 191)->nullable();
            $table->string('thumbnail', 191)->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->decimal('tax', 24, 3)->default(0);
            $table->unsignedInteger('order_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('rating_count')->default(0);
            $table->double('avg_rating', 8, 4)->default(0);
            $table->decimal('min_bidding_price', 24, 3)->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_services');
    }
};
