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
        Schema::create('patient_oct_analyses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Customer ID from session
            $table->string('image_path'); // Path to the uploaded OCT scan
            $table->string('prediction')->nullable(); // Prediction from API
            $table->text('recommendation')->nullable();
            $table->boolean('need_help')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_oct_analyses');
    }
};
