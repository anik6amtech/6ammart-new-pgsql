<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceServicemenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_servicemen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id')->nullable();
            $table->unsignedBigInteger('service_provider_id')->nullable();

            $table->string('first_name',191)->nullable();
            $table->string('last_name',191)->nullable();
            $table->string('phone',25)->nullable();
            $table->string('email',191)->nullable();
            $table->string('password')->nullable();
            $table->string('profile_image')->nullable();

            $table->string('identification_number', 191)->nullable();
            $table->string('identification_type', 191)->nullable();
            $table->string('identification_image')->nullable();

            $table->string('fcm_token', 191)->nullable();
            $table->string('auth_token', 255)->nullable();
            $table->boolean('is_phone_verified')->default(0);
            $table->boolean('is_email_verified')->default(0);
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();

            $table->decimal('wallet_balance', 24, 3)->default(0);
            $table->decimal('loyalty_point', 24, 3)->default(0);

            $table->integer('rating_count')->unsigned()->default(0);
            $table->float('avg_rating',8,4)->default(0);

            $table->boolean('is_active')->default(1);
            $table->boolean('is_approved')->default(0);
            
            $table->softDeletes();
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
        Schema::dropIfExists('service_servicemen');
    }
}
