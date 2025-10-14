<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRecentViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_recent_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('service_id')->nullable();
            $table->integer('total_service_view')->default(0);
            $table->foreignId('category_id')->nullable();
            $table->integer('total_category_view')->default(0);
            $table->foreignId('sub_category_id')->nullable();
            $table->integer('total_sub_category_view')->default(0);

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
        Schema::dropIfExists('service_recent_views');
    }
}
