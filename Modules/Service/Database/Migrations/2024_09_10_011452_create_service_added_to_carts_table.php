<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceAddedToCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_added_to_carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('service_id');
            $table->integer('count')->default(0);
            $table->boolean('is_guest')->default(0);
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
        Schema::dropIfExists('service_added_to_carts');
    }
}
