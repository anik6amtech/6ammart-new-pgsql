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
        Schema::create('ride_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('attribute_id')->nullable();
            $table->string('attribute')->nullable();
            $table->decimal('debit', 24)->default(0);
            $table->decimal('credit', 24)->default(0);
            $table->decimal('balance', 24)->default(0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('user_type')->comment('customer,driver,admin');
            $table->string('account')->nullable();
            $table->string('transaction_type')->nullable();
            $table->mediumText('reference')->nullable();
            $table->char('trx_ref_id', 36)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_transactions');
    }
};
