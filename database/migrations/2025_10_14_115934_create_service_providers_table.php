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
        Schema::create('service_providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('module_id')->nullable();
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->json('coordinates')->nullable();
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
            $table->string('ref_code', 50)->nullable();
            $table->unsignedBigInteger('referred_by')->nullable();
            $table->unsignedTinyInteger('login_hit_count')->default(0);
            $table->boolean('is_temp_blocked')->default(false);
            $table->timestamp('temp_block_time')->nullable();
            $table->string('current_language_key')->nullable()->default('en');
            $table->string('company_name', 191)->nullable();
            $table->string('company_phone', 25)->nullable();
            $table->string('company_address', 191)->nullable();
            $table->string('company_email', 191)->nullable();
            $table->string('logo', 191)->nullable();
            $table->string('cover_image', 191)->nullable();
            $table->unsignedInteger('minimum_service_time')->default(0);
            $table->unsignedInteger('maximum_service_time')->default(0);
            $table->string('service_time_type', 191)->default('min')->comment('min, hour, day');
            $table->unsignedInteger('order_count')->default(0);
            $table->unsignedInteger('service_man_count')->default(0);
            $table->unsignedInteger('service_capacity_per_day')->default(0);
            $table->unsignedInteger('rating_count')->default(0);
            $table->double('avg_rating', 8, 4)->default(0);
            $table->boolean('commission_status')->default(false);
            $table->double('commission_percentage', 8, 4)->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_suspended')->default(false);
            $table->boolean('service_availability')->default(true);
            $table->enum('business_model', ['none', 'commission', 'subscription', 'unsubscribed'])->default('none');
            $table->unsignedBigInteger('package_id')->nullable();
            $table->string('commission_type')->default('default')->comment('default, custom');
            $table->decimal('commission', 12)->default(0)->comment('custom commission percentage');
            $table->string('meta_title', 191)->nullable();
            $table->string('meta_description', 191)->nullable();
            $table->string('meta_image')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_providers');
    }
};
