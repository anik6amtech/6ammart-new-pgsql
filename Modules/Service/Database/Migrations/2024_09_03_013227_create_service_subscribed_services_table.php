<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceSubscribedServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_subscribed_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id');
            $table->foreignId('category_id');
            $table->foreignId('sub_category_id');
            $table->boolean('is_subscribed')->default(0);

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
        Schema::dropIfExists('service_subscribed_services');
    }
}
