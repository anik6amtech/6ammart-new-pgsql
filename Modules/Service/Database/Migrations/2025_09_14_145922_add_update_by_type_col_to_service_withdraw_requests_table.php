<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdateByTypeColToServiceWithdrawRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_withdraw_requests', function (Blueprint $table) {
            $table->string('updated_by_type')->default('provider');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_withdraw_requests', function (Blueprint $table) {
            $table->dropColumn('updated_by_type');
        });
    }
}
