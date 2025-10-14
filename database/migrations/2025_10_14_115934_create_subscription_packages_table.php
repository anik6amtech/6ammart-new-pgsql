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
        Schema::create('subscription_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('package_name', 191);
            $table->double('price', 24, 3);
            $table->integer('validity');
            $table->string('max_order')->default('unlimited');
            $table->string('max_product')->default('unlimited');
            $table->boolean('pos')->default(false);
            $table->boolean('mobile_app')->default(false);
            $table->boolean('chat')->default(false);
            $table->boolean('review')->default(false);
            $table->boolean('self_delivery')->default(false);
            $table->boolean('scheduled_service')->default(false);
            $table->boolean('service_request')->default(false);
            $table->boolean('advertisement')->default(false);
            $table->boolean('reports_and_analytics')->default(false);
            $table->boolean('bidding')->default(false);
            $table->boolean('status')->default(true);
            $table->boolean('default')->default(false);
            $table->string('colour', 50)->nullable();
            $table->text('text')->nullable();
            $table->timestamps();
            $table->string('module_type', 20)->default('all');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_packages');
    }
};
