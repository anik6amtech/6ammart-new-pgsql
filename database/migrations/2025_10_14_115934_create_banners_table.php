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
        Schema::create('banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('type');
            $table->string('time_period')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->decimal('total_redirection', 10)->default(0);
            $table->string('image')->nullable();
            $table->boolean('status')->default(true);
            $table->string('data');
            $table->timestamps();
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->unsignedBigInteger('module_id')->index('banners_module_id_foreign');
            $table->boolean('featured')->default(false);
            $table->string('default_link')->nullable();
            $table->string('created_by')->default('admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
