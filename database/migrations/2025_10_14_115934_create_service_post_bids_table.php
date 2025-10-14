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
        Schema::create('service_post_bids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('offered_price', 24)->default(0);
            $table->text('provider_note')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_post_bids');
    }
};
