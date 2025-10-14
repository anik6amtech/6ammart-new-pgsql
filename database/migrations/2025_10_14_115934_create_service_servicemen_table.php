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
        Schema::create('service_servicemen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('module_id')->nullable();
            $table->unsignedBigInteger('service_provider_id')->nullable();
            $table->string('first_name', 191)->nullable();
            $table->string('last_name', 191)->nullable();
            $table->string('phone', 25)->nullable();
            $table->string('email', 191)->nullable();
            $table->string('password')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('identification_number', 191)->nullable();
            $table->string('identification_type', 191)->nullable();
            $table->string('identification_image')->nullable();
            $table->string('fcm_token', 191)->nullable();
            $table->string('auth_token')->nullable();
            $table->boolean('is_phone_verified')->default(false);
            $table->boolean('is_email_verified')->default(false);
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->decimal('wallet_balance', 24, 3)->default(0);
            $table->decimal('loyalty_point', 24, 3)->default(0);
            $table->unsignedInteger('rating_count')->default(0);
            $table->double('avg_rating', 8, 4)->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_approved')->default(false);
            $table->softDeletes();
            $table->timestamps();
            $table->string('current_language_key')->nullable()->default('en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_servicemen');
    }
};
