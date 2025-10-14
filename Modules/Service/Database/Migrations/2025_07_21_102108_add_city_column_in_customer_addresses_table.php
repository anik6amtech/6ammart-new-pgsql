<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCityColumnInCustomerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_addresses', function (Blueprint $table) {
            $table->string('city', 255)->nullable()->after('house');
            $table->string('street', 255)->nullable()->after('city');
            $table->string('zip_code', 32)->nullable()->after('street');
            $table->string('country', 255)->nullable()->after('zip_code');
            $table->string('address_label', 255)->nullable()->after('country');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_addresses', function (Blueprint $table) {
            $table->dropColumn('city');
            $table->dropColumn('street');
            $table->dropColumn('zip_code');
            $table->dropColumn('country');
            $table->dropColumn('address_label');
        });
    }
}
