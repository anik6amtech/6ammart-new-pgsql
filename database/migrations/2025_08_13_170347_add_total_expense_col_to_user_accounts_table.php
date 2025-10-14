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
        Schema::table('ride_user_accounts', function (Blueprint $table) {
            $table->decimal('total_expense',24)->default(0)->after('total_withdrawn');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ride_user_accounts', function (Blueprint $table) {
            $table->dropColumn('total_expense');
        });
    }
};
