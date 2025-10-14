<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceProviderNotificationSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_provider_notification_setups', function (Blueprint $table) {
            $table->id();
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
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_provider_notification_setups');
    }
}
