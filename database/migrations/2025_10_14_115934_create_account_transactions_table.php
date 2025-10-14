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
        Schema::create('account_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('from_type');
            $table->bigInteger('from_id');
            $table->decimal('current_balance', 24);
            $table->decimal('amount', 24);
            $table->string('method');
            $table->string('ref')->nullable();
            $table->timestamps();
            $table->string('type', 20)->default('collected');
            $table->string('created_by', 20)->default('admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_transactions');
    }
};
