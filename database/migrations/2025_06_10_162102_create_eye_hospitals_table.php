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
        Schema::create('eye_hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('hospitalId')->unique();
            $table->string('hospital_name')->unique();
            $table->text('address');
            $table->string('location');
            $table->string('contact_number');
            $table->json('social_media_links')->nullable();
            $table->string('website_link')->nullable();
            $table->string('image')->nullable();
            $table->text('bio')->nullable();
            $table->text('description')->nullable();
            $table->json('clinic_days')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eye_hospitals');
    }
};
