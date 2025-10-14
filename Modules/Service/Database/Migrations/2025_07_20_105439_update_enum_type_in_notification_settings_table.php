<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEnumTypeInNotificationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE notification_settings
            MODIFY `type` ENUM('admin', 'store', 'provider', 'deliveryman', 'serviceman', 'customer', 'user')
            NOT NULL
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DB::statement("
        //     ALTER TABLE notification_settings
        //     MODIFY `type` ENUM('user', 'provider', 'serviceman')
        //     NOT NULL
        // ");
    }
}
