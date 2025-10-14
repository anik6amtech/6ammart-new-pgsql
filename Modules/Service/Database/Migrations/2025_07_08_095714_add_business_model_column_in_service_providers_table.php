<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBusinessModelColumnInServiceProvidersTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::table('service_providers', function (Blueprint $table) {
            $table->enum('business_model', ['none', 'commission', 'subscription', 'unsubscribed'])->default('none')->after('service_availability');
            $table->foreignId('package_id')->nullable()->after('business_model');
            $table->string('commission_type')->default('default')->after('package_id')->comment('default, custom');
            $table->decimal('commission', 12, 2)->default(0.00)->after('commission_type')->comment('custom commission percentage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_providers', function (Blueprint $table) {
            $table->dropColumn('business_model');
            $table->dropColumn('package_id');
            $table->dropColumn('commission_type');
            $table->dropColumn('commission');
        });
    }
}
