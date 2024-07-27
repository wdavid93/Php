<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Cette méthode est appelée pour remplir la base de données avec des données de test
     * lors de l'exécution de la commande `php artisan db:seed`.
     *
     * @return void
     */
    public function run()
    {
        // Crée 10 utilisateurs
        User::factory()
            ->count(10) // Spécifie que nous voulons créer 10 utilisateurs
            ->has(
                // Pour chaque utilisateur créé, crée 3 commandes
                Order::factory()
                    ->count(3) // Spécifie que nous voulons créer 3 commandes par utilisateur
                    ->hasAttached(
                        // Pour chaque commande créée, attache 5 produits
                        Product::factory()->count(5), // Spécifie que nous voulons créer 5 produits
                        [
                            // Les informations supplémentaires à ajouter lors de l'attachement des produits
                            'price' => rand(100, 500), // Prix aléatoire pour chaque produit attaché, entre 100 et 500
                            'quantity' => rand(1, 3) // Quantité aléatoire pour chaque produit attaché, entre 1 et 3
                        ]
                    )
            )
            ->create(); // Exécute la création des utilisateurs, commandes et produits
    }
}
