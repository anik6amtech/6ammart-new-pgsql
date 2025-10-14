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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('f_name', 100)->nullable();
            $table->string('l_name', 100)->nullable();
            $table->string('phone')->nullable()->unique();
            $table->string('email', 100)->nullable();
            $table->string('image', 100)->nullable();
            $table->boolean('is_phone_verified')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 100)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('interest')->nullable();
            $table->string('cm_firebase_token')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('order_count')->default(0);
            $table->string('login_medium')->nullable();
            $table->string('social_id')->nullable();
            $table->unsignedBigInteger('zone_id')->nullable()->index();
            $table->decimal('wallet_balance', 24, 3)->default(0);
            $table->decimal('loyalty_point', 24, 3)->default(0);
            $table->string('ref_code', 10)->nullable()->unique();
            $table->string('current_language_key')->nullable()->default('en');
            $table->unsignedBigInteger('ref_by')->nullable();
            $table->string('temp_token')->nullable();
            $table->string('module_ids')->nullable();
            $table->boolean('is_email_verified')->default(false);
            $table->boolean('is_from_pos')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
