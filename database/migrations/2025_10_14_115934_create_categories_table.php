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
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191);
            $table->string('image')->default('def.png');
            $table->integer('parent_id');
            $table->integer('position');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->integer('priority')->default(0);
            $table->unsignedBigInteger('module_id')->index('categories_module_id_foreign');
            $table->string('slug')->nullable();
            $table->boolean('featured')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
