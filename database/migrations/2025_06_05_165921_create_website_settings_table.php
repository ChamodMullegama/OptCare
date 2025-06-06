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
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('rcode')->unique();
            $table->string('logo')->nullable();
            $table->string('websiteName');
            $table->string('email');
            $table->string('contactNo1');
            $table->string('contactNo2')->nullable();
            $table->string('addressLine1');
            $table->string('addressLine2')->nullable();
            $table->string('city');
            $table->string('whatsappLink')->nullable();
            $table->string('instagramLink')->nullable();
            $table->string('facebookLink')->nullable();
            $table->string('linkedinLink')->nullable();
            $table->string('twitterLink')->nullable();
            $table->string('footerText')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
