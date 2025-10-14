<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStoreTypeColumnInStoreSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store_subscriptions', function (Blueprint $table) {
            $table->string('store_type')->default('store')->after('package_id')->comment('store, service_provider');
            
            $table->boolean('scheduled_service')->default(0)->after('self_delivery');
            $table->boolean('service_request')->default(0)->after('scheduled_service');
            $table->boolean('advertisement')->default(0)->after('service_request');
            $table->boolean('reports_and_analytics')->default(0)->after('advertisement');
            $table->boolean('bidding')->default(0)->after('reports_and_analytics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('store_subscriptions', function (Blueprint $table) {
            $table->dropColumn('store_type');
            $table->dropColumn('scheduled_service');
            $table->dropColumn('service_request');
            $table->dropColumn('advertisement');
            $table->dropColumn('reports_and_analytics');
            $table->dropColumn('bidding');
        });
    }
}
