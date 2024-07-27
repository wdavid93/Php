<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->sentence(); // Génère le nom du produit

        return [
            'name' => $name, // Nom par défaut du produit
            'description' => $this->faker->sentence(rand(1,3), true), // Description par défaut du produit
            'price' => rand(500, 10000), // Prix par défaut du produit
            'quantity' => 1, // Quantité par défaut en stock
            'sku' => 'SKU-' . strtoupper(bin2hex(random_bytes(4))), // SKU unique généré
            'image' => $this->faker->imageUrl(), // URL d'image par défaut
            'slug' => Str::slug($name), // Slug généré à partir du nom
            'active' => $this->faker->boolean(80), // Actif par défaut avec une probabilité de 80%
        ];
    }
}
