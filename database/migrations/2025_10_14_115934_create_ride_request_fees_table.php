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
        Schema::create('ride_request_fees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ride_request_id');
            $table->decimal('cancellation_fee', 23, 3)->default(0);
            $table->decimal('return_fee', 23, 3)->default(0);
            $table->string('cancelled_by', 20)->nullable();
            $table->decimal('waiting_fee', 23, 3)->default(0);
            $table->string('waited_by', 20)->nullable();
            $table->decimal('idle_fee', 23, 3)->default(0);
            $table->decimal('delay_fee', 23, 3)->default(0);
            $table->string('delayed_by', 20)->nullable();
            $table->decimal('vat_tax', 23, 3)->default(0);
            $table->decimal('tips', 23, 3)->default(0);
            $table->decimal('admin_commission', 23, 3)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_request_fees');
    }
};
