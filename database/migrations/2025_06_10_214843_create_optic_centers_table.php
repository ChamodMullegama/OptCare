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
        Schema::create('optic_centers', function (Blueprint $table) {
            $table->id();
           $table->string('hospitalId')->unique();
            $table->string('hospital_name')->unique();
            $table->string('address');
            $table->string('location');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 10, 8);
            $table->string('contact_number');
            $table->string('email'); // Added from the add/edit templates
            $table->json('social_media_links')->nullable();
            $table->string('website_link')->nullable();
            $table->string('image')->nullable();
            $table->text('bio')->nullable();
            $table->text('description')->nullable();
            $table->json('clinic_days')->nullable();
            $table->string('open_days')->nullable(); // Added from templates
            $table->time('open_time')->nullable();   // Added from templates
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('optic_centers');
    }
};
