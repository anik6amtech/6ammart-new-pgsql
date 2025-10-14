<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimePeriodColumnsInBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->string('time_period')->nullable()->after('type');
            $table->dateTime('start_date')->nullable()->after('time_period');
            $table->dateTime('end_date')->nullable()->after('start_date');
            $table->decimal('total_redirection', 10, 2)->default(0)->after('end_date');
            $table->unsignedBigInteger('zone_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn('time_period');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            $table->dropColumn('total_redirection');
        });
    }
}
