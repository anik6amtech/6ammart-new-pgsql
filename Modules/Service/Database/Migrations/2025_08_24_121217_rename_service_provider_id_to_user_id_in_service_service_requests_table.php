<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameServiceProviderIdToUserIdInServiceServiceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_service_requests', function (Blueprint $table) {
            $table->renameColumn('service_provider_id', 'user_id');
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
            $table->renameColumn('user_id', 'service_provider_id');
        });
    }
}
