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
        Schema::create('d_m_vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->double('starting_coverage_area', 16, 2);
            $table->double('maximum_coverage_area', 16, 2);
            $table->double('extra_charges', 16, 2);
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_m_vehicles');
    }
};
