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
        Schema::create('service_withdraw_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('request_updated_by')->nullable();
            $table->decimal('amount', 24)->default(0);
            $table->string('request_status')->default('pending');
            $table->boolean('is_paid')->default(false);
            $table->string('note')->nullable();
            $table->string('admin_note')->nullable();
            $table->char('withdrawal_method_id', 36)->nullable();
            $table->text('withdrawal_method_fields')->nullable();
            $table->timestamps();
            $table->string('updated_by_type')->default('provider');

            $table->index(['id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_withdraw_requests');
    }
};
