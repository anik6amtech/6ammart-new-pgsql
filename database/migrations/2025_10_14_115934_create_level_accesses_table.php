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
        Schema::create('level_accesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('level_id');
            $table->string('user_type', 50);
            $table->boolean('bid')->default(false);
            $table->boolean('see_destination')->default(false);
            $table->boolean('see_subtotal')->default(false);
            $table->boolean('see_level')->default(false);
            $table->boolean('create_hire_request')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_accesses');
    }
};
