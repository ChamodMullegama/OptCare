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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
             $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->decimal('total', 10, 2);
            $table->string('status')->default('pending'); // e.g., pending, completed, failed
            $table->string('payment_status')->default('pending'); // e.g., pending, completed, failed
            $table->string('payment_confirmation')->nullable(); // e.g., Stripe payment ID
            $table->string('first_name');
            $table->string('email');
            $table->string('phone');
            $table->string('country');
            $table->string('address');
            $table->string('town_city');
            $table->string('state');
            $table->string('zip');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
