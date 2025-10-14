<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('subscription_packages', function (Blueprint $table) {
            $table->boolean('scheduled_service')->default(0)->after('self_delivery');
            $table->boolean('service_request')->default(0)->after('scheduled_service');
            $table->boolean('advertisement')->default(0)->after('service_request');
            $table->boolean('reports_and_analytics')->default(0)->after('advertisement');
            $table->boolean('bidding')->default(0)->after('reports_and_analytics');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscription_packages', function (Blueprint $table) {
            $table->dropColumn('scheduled_service');
            $table->dropColumn('service_request');
            $table->dropColumn('advertisement');
            $table->dropColumn('reports_and_analytics');
            $table->dropColumn('bidding');
        });
    }
};
