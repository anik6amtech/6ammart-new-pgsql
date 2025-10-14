<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRideUserAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ride_user_accounts', function (Blueprint $table) {
            $table->id()->index();
            $table->foreignId('user_id')->nullable();
            $table->string('user_type')->comment(CUSTOMER .','. DRIVER.','. 'admin');
            $table->decimal('payable_balance',24)->default(0);
            $table->decimal('receivable_balance',24)->default(0);
            $table->decimal('received_balance',24)->default(0);
            $table->decimal('pending_balance',24)->default(0);
            $table->decimal('wallet_balance',24)->default(0);
            $table->decimal('total_withdrawn',24)->default(0);
            $table->double('referral_earn')->default(0);
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
        Schema::dropIfExists('ride_user_accounts');
    }
}
