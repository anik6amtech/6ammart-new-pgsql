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
        Schema::create('ride_user_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('user_type')->comment('customer,driver,admin');
            $table->decimal('payable_balance', 24)->default(0);
            $table->decimal('receivable_balance', 24)->default(0);
            $table->decimal('received_balance', 24)->default(0);
            $table->decimal('pending_balance', 24)->default(0);
            $table->decimal('wallet_balance', 24)->default(0);
            $table->decimal('total_withdrawn', 24)->default(0);
            $table->decimal('total_expense', 24)->default(0);
            $table->double('referral_earn', null, 0)->default(0);
            $table->timestamps();

            $table->index(['id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_user_accounts');
    }
};
