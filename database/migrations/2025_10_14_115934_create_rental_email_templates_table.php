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
        Schema::create('rental_email_templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 100)->nullable();
            $table->text('body')->nullable();
            $table->text('body_2')->nullable();
            $table->string('background_image', 100)->nullable();
            $table->string('image', 100)->nullable();
            $table->string('logo', 100)->nullable();
            $table->string('icon', 100)->nullable();
            $table->string('button_name', 100)->nullable();
            $table->string('button_url')->nullable();
            $table->string('footer_text')->nullable();
            $table->string('copyright_text')->nullable();
            $table->string('type')->nullable();
            $table->string('email_type')->nullable();
            $table->string('email_template')->nullable();
            $table->boolean('privacy')->default(false);
            $table->boolean('refund')->default(false);
            $table->boolean('cancelation')->default(false);
            $table->boolean('contact')->default(false);
            $table->boolean('facebook')->default(false);
            $table->boolean('instagram')->default(false);
            $table->boolean('twitter')->default(false);
            $table->boolean('linkedin')->default(false);
            $table->boolean('pinterest')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_email_templates');
    }
};
