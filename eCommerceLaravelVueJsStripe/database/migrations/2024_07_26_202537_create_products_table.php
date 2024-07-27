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
            $table->string('name'); // Nom du produit
            $table->text('description')->nullable(); // Description du produit
            $table->string('image'); // Image du produit
            $table->boolean('active'); // Produit en ligne ou pas
            // $table->decimal('price', 8, 2); // Prix du produit
            $table->integer('price'); // Prix du produit
            $table->integer('quantity'); // Quantité en stock
            $table->string('sku')->unique(); // Référence unique du produit
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
