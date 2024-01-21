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
        Schema::create('categories_products', function (Blueprint $table) {
            // $table->id();
            $table->foreignId('Category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('Product_id')->constrained('products')->cascadeOnDelete();
            $table->primary(['Category_id', 'Product_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories_products');
    }
};
