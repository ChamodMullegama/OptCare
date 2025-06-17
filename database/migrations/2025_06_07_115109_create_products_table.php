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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('productId')->unique();
            $table->string('name');
            $table->text('description');
            $table->integer('quantity');
            $table->decimal('price', 8, 2);
            $table->string('product_color');
            $table->string('brand_name');
            $table->unsignedBigInteger('category_id');
            $table->decimal('discount', 5, 2)->default(0);
            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
