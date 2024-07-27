<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array    {
        
        return [
            'order_number' => uniqid(), // 'ORD-' . rand(10000, 99999), // Génère un numéro de commande aléatoire
            'shipped_at' => now()->addDays(rand(1, 30)), // Définit une date d'expédition dans les 30 jours suivants
            'status' => 'pending', // Définit un statut par défaut
        ];
    }
}
