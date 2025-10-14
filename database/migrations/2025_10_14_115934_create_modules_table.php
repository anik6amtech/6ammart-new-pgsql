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
        Schema::create('modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('module_name', 191);
            $table->string('module_type', 191);
            $table->string('thumbnail')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('stores_count')->default(0);
            $table->timestamps();
            $table->string('icon', 191)->nullable();
            $table->integer('theme_id')->default(1);
            $table->text('description')->nullable();
            $table->boolean('all_zone_service')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
