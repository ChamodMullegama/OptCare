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
        Schema::create('eye_issue_images', function (Blueprint $table) {
            $table->id();
            $table->string('eyeIssueImageId')->unique();
            $table->string('eyeIssueId');
            $table->string('image');
            $table->boolean('isPrimary')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eye_issue_images');
    }
};
