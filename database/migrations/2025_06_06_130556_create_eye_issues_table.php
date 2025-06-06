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
        Schema::create('eye_issues', function (Blueprint $table) {
            $table->id();
            $table->string('eyeIssueId')->unique();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->string('symptoms')->nullable();;
            $table->string('causes')->nullable();;
            $table->string('treatments')->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eye_issues');
    }
};
