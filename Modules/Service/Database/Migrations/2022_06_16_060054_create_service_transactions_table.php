<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ref_trx_id')->nullable();
            $table->foreignId('booking_id')->nullable();
            $table->string('trx_type')->nullable();
            $table->decimal('debit',24,2)->default(0);
            $table->decimal('credit',24,2)->default(0);
            $table->decimal('balance',24,2)->default(0);
            $table->foreignId('from_user_id')->nullable();
            $table->string('from_user_type')->nullable();
            $table->foreignId('to_user_id')->nullable();
            $table->string('to_user_type')->nullable();
            $table->string('from_user_account')->nullable();
            $table->string('to_user_account')->nullable();
            $table->string('reference_note', 100)->nullable();
            $table->boolean('is_guest')->default(0);
            $table->foreignId('booking_repeat_id')->nullable();
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
        //
    }
}
