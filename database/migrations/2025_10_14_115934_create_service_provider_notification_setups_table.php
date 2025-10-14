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
        Schema::create('service_provider_notification_setups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('key')->nullable();
            $table->string('type')->nullable();
            $table->bigInteger('provider_id')->nullable();
            $table->string('mail_status')->default('active')->comment('active, inactive, disable');
            $table->string('sms_status')->default('active')->comment('active, inactive, disable');
            $table->string('push_notification_status')->default('active')->comment('active, inactive, disable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_provider_notification_setups');
    }
};
