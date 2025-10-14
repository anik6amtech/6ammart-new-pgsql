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
        Schema::create('disbursement_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('disbursement_id');
            $table->unsignedBigInteger('store_id')->nullable();
            $table->unsignedBigInteger('delivery_man_id')->nullable();
            $table->double('disbursement_amount', 23, 3)->default(0);
            $table->unsignedBigInteger('payment_method');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disbursement_details');
    }
};
