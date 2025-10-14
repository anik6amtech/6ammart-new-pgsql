<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToColSubscriptionBillingAndRefundHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscription_billing_and_refund_histories', function (Blueprint $table) {
            $table->string('module_type')->default('default');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscription_billing_and_refund_histories', function (Blueprint $table) {
            $table->dropColumn('module_type');
        });
    }
}
