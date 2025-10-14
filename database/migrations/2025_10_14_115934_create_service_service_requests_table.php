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
        Schema::create('service_service_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('service_name');
            $table->text('service_description');
            $table->string('status', 20)->comment('pending,accepted,denied');
            $table->text('admin_feedback')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->string('type')->default('provider')->comment('Type of service request, e.g., provider, customer.');
            $table->integer('module_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_service_requests');
    }
};
