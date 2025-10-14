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
        Schema::create('service_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ref_trx_id')->nullable();
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->string('trx_type')->nullable();
            $table->decimal('debit', 24)->default(0);
            $table->decimal('credit', 24)->default(0);
            $table->decimal('balance', 24)->default(0);
            $table->unsignedBigInteger('from_user_id')->nullable();
            $table->string('from_user_type')->nullable();
            $table->unsignedBigInteger('to_user_id')->nullable();
            $table->string('to_user_type')->nullable();
            $table->string('from_user_account')->nullable();
            $table->string('to_user_account')->nullable();
            $table->string('reference_note', 100)->nullable();
            $table->boolean('is_guest')->default(false);
            $table->unsignedBigInteger('booking_repeat_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_transactions');
    }
};
