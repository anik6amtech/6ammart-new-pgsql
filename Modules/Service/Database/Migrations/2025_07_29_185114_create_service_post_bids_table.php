<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicePostBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_post_bids', function (Blueprint $table) {
            $table->id();
            $table->decimal('offered_price',24,2)->default(0);
            $table->text('provider_note')->nullable();
            $table->string('status');
            $table->foreignid('post_id');
            $table->foreignid('provider_id')->nullable();
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
        Schema::dropIfExists('service_post_bids');
    }
}
