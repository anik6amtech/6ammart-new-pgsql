<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStoreTypeColumnInSubscriptionTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscription_transactions', function (Blueprint $table) {
            $table->string('store_type')->default('store')->after('package_id')->comment('store, service_provider');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscription_transactions', function (Blueprint $table) {
            $table->dropColumn('store_type');
        });
    }
}
