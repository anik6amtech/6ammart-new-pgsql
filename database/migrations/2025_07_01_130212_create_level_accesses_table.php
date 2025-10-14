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
            $table->id();
            $table->foreignId('level_id');
            $table->string('user_type', 50);
            $table->boolean('bid')->default(0);
            $table->boolean('see_destination')->default(0);
            $table->boolean('see_subtotal')->default(0);
            $table->boolean('see_level')->default(0);
            $table->boolean('create_hire_request')->default(0);
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
