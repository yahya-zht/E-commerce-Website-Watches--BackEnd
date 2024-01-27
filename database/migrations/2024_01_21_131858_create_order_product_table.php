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
        Schema::create('order_product', function (Blueprint $table) {
            // $table->id();
            $table->foreignId('Product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('Order_id')->constrained('orders')->cascadeOnDelete();
            $table->primary(['Product_id', 'Order_id']);
            $table->integer('Quantity');
            $table->integer('Total_Price');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_products');
    }
};
