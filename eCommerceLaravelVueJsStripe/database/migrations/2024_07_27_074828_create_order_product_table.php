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
            $table->id();
            // $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Référence à la commande
            // $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Référence au produit
            // $table->integer('quantity'); // Quantité de ce produit dans cette commande
            // $table->decimal('price', 10, 2); // Prix du produit au moment de la commande
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('price'); // Quantité de ce produit dans cette commande
            $table->integer('quantity');  // Prix du produit au moment de la commande
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};
