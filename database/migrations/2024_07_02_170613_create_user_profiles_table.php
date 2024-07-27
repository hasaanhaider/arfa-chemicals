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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('company_name', 255);
            $table->string('company_email', 255)->unique();
            $table->string('company_phone', 20);
            $table->text('company_address');
            $table->string('company_city', 100);
            $table->string('company_country', 100);
            $table->string('company_facebook', 255)->nullable();
            $table->string('company_twitter', 255)->nullable();
            $table->string('company_linkedin', 255)->nullable();
            $table->string('company_instagram', 255)->nullable();
            $table->string('company_industry', 100);
            $table->year('company_founded_in')->nullable();
            $table->unsignedSmallInteger('company_size')->nullable();
            $table->string('company_cover_image', 255)->nullable();
            $table->string('company_logo_image', 255)->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
