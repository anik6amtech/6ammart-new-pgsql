<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceWithdrawRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_withdraw_requests', function (Blueprint $table) {
            $table->id()->index();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('request_updated_by')->nullable();
            $table->decimal('amount',24,2)->default(0);
            $table->string('request_status')->default('pending');
            $table->boolean('is_paid')->default(0);
            $table->string('note')->nullable();
            $table->string('admin_note')->nullable();
            $table->foreignUuid('withdrawal_method_id')->nullable();
            $table->text('withdrawal_method_fields')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_withdraw_requests');
    }
}
