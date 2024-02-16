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
            $table->string('Ref')->unique();
            $table->string('Name');
            $table->longText('Description');
            $table->string('Image_Product');
            $table->integer('Price_Purchase');
            $table->integer('Price_First');
            $table->integer('Price_Sale');
            $table->integer('Quantity');
            $table->integer('Sales');
            $table->foreignId('provider_id')->constrained('providers')->cascadeOnDelete();

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
