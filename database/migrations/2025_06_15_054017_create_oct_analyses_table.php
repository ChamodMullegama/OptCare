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
        Schema::create('oct_analyses', function (Blueprint $table) {
            $table->id();
               $table->string('doctor_id');
            $table->string('doctor_name');
               $table->string('patient_id');
            $table->string('patient_name');
            $table->string('patient_email')->nullable();
            $table->string('patient_phone')->nullable();
            $table->integer('patient_age')->nullable();
            $table->string('eye_side');
            $table->text('clinical_notes')->nullable();
            $table->string('image_path');
            $table->string('prediction');
            $table->text('recommendation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oct_analyses');
    }
};
