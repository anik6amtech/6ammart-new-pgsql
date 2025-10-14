<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id')->nullable();
            $table->string('name',191)->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('cover_image',191)->nullable();
            $table->string('thumbnail',191)->nullable();
            $table->foreignId('category_id')->nullable();
            $table->foreignId('sub_category_id')->nullable();
            $table->decimal('tax',24,3)->default(0);
            $table->integer('order_count')->unsigned()->default(0);
            $table->boolean('is_active')->default(1);
            $table->integer('rating_count')->unsigned()->default(0);
            $table->float('avg_rating',8,4)->default(0);
            $table->decimal('min_bidding_price', 24, 3)->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_services');
    }
}
