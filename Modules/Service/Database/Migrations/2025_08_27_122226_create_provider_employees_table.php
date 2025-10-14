<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('provider_role_id');
            $table->string('f_name');
            $table->string('l_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone',20)->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->boolean('status')->default(1);
            $table->string('remember_token')->nullable();
            $table->text('firebase_token')->nullable();
            $table->string('auth_token', 100)->nullable();
            $table->tinyInteger('is_logged_in')->default(1);

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
        Schema::dropIfExists('provider_employees');
    }
}
