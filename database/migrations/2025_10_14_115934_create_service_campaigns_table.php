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
        Schema::create('service_campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('campaign_name', 191)->nullable();
            $table->text('short_description')->nullable();
            $table->string('cover_image', 191)->default('def.png');
            $table->string('thumbnail', 191)->default('def.png');
            $table->char('discount_id', 36)->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_campaigns');
    }
};
