<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToColServiceRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_service_requests', function (Blueprint $table) {
            $table->string('type')->default('provider')->comment('Type of service request, e.g., provider, customer.');
            $table->integer('module_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_service_requests', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('module_id');
        });
    }
}
