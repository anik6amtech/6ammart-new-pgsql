<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRideTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ride_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->nullable();
            $table->string('attribute')->nullable();
            $table->decimal('debit',24)->default(0);
            $table->decimal('credit',24)->default(0);
            $table->decimal('balance',24)->default(0);
            $table->foreignId('user_id')->nullable();
            $table->string('user_type')->comment(CUSTOMER .','. DRIVER.','. 'admin');
            $table->string('account')->nullable();
            $table->string('transaction_type')->nullable();
            $table->mediumText('reference')->nullable();
            $table->uuid('trx_ref_id')->nullable();
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
        Schema::dropIfExists('ride_transactions');
    }
}
