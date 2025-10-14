<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCurrentLangKeyToServiceServicemenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_servicemen', function (Blueprint $table) {
            $table->string('current_language_key', 255)->default('en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_servicemen', function (Blueprint $table) {
            $table->dropColumn('current_language_key');
        });
    }
}
