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
        Schema::create('ride_safety_alerts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ride_request_id');
            $table->unsignedBigInteger('sent_by');
            $table->string('sent_by_type')->nullable()->comment('driver,customer');
            $table->json('reason')->nullable();
            $table->text('comment')->nullable();
            $table->text('alert_location');
            $table->text('resolved_location')->nullable();
            $table->integer('number_of_alert')->default(1);
            $table->unsignedBigInteger('resolved_by')->nullable();
            $table->string('resolved_by_type')->nullable();
            $table->string('ride_status_when_make_alert');
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->index(['id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_safety_alerts');
    }
};
