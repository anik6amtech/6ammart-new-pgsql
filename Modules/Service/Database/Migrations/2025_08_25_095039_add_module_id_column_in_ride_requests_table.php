<?php

use App\Models\Module;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddModuleIdColumnInRideRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ride_requests', function (Blueprint $table) {
            if(!Schema::hasColumn('ride_requests', 'module_id')) {
                $table->unsignedBigInteger('module_id')->nullable()->after('ref_id');
            }
        });
        $rideShareModule = Module::where('module_type', 'ride-share')->first();
        if(!empty($rideShareModule)) {
            DB::table('ride_requests')->whereNull('module_id')->update(['module_id' => $rideShareModule->id]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ride_requests', function (Blueprint $table) {

        });
    }
}
