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
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('address_type', 100);
            $table->string('contact_person_number', 20);
            $table->text('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('contact_person_name', 100)->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('zone_id');
            $table->string('floor')->nullable();
            $table->string('road')->nullable();
            $table->string('house')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('zip_code', 32)->nullable();
            $table->string('country')->nullable();
            $table->string('address_label')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_addresses');
    }
};
