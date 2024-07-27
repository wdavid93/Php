<?php

namespace App\Http\Controllers;

use App\Models\Order; // Importation du modèle Order
use App\Http\Requests\StoreOrderRequest; // Importation de la requête de validation pour la création d'ordre
use App\Http\Requests\UpdateOrderRequest; // Importation de la requête de validation pour la mise à jour d'ordre
use App\Repositories\CartRepository; // Importation du dépôt de panier

/**
 * Contrôleur pour gérer les opérations CRUD sur les ordres
 */
class OrderController extends Controller
{
    /**
     * Affiche la liste des ressources.
     *
     * @return \Illuminate\Http\Response La réponse HTTP avec la liste des ordres
     */
    public function index()
    {
        // Méthode pour afficher la liste des ordres (à implémenter)
    }

    /**
     * Affiche le formulaire de création d'une nouvelle ressource.
     *
     * @return \Illuminate\Http\Response La réponse HTTP pour afficher le formulaire de création
     */
    public function create()
    {
        // Méthode pour afficher le formulaire de création d'ordre (à implémenter)
    }

    /**
     * Enregistre une nouvelle ressource dans le stockage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request La requête de validation pour la création d'ordre
     * @return \Illuminate\Http\Response La réponse HTTP après avoir enregistré l'ordre
     */
    public function store(StoreOrderRequest $request)
    {
        // Création d'un nouvel ordre pour l'utilisateur authentifié
        $order = auth()->user()->orders()->create([
            'order_number' => uniqid() // Génération d'un numéro de commande unique
        ]);

        // Utilisation du dépôt de panier pour traiter le contenu du panier
        (new CartRepository())
            ->content() // Récupère le contenu du panier
            ->each(function ($product) use($order) {
                // Attache chaque produit de la commande avec ses détails
                $order->products()->attach($product->id, [
                    'price' => $product->price * $product->quantity, // Prix total pour le produit
                    'quantity' => $product->quantity, // Quantité du produit
                ]);
            });
            
        // Efface le contenu du panier après la création de la commande
        (new CartRepository())->clear();
    }

    /**
     * Affiche la ressource spécifiée.
     *
     * @param  \App\Models\Order  $order L'entité Order à afficher
     * @return \Illuminate\Http\Response La réponse HTTP avec les détails de l'ordre
     */
    public function show(Order $order)
    {
        // Méthode pour afficher les détails d'un ordre spécifique (à implémenter)
    }

    /**
     * Affiche le formulaire d'édition de la ressource spécifiée.
     *
     * @param  \App\Models\Order  $order L'entité Order à modifier
     * @return \Illuminate\Http\Response La réponse HTTP pour afficher le formulaire d'édition
     */
    public function edit(Order $order)
    {
        // Méthode pour afficher le formulaire d'édition d'un ordre spécifique (à implémenter)
    }

    /**
     * Met à jour la ressource spécifiée dans le stockage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request La requête de validation pour la mise à jour d'ordre
     * @param  \App\Models\Order  $order L'entité Order à mettre à jour
     * @return \Illuminate\Http\Response La réponse HTTP après avoir mis à jour l'ordre
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        // Méthode pour mettre à jour un ordre existant (à implémenter)
    }

    /**
     * Supprime la ressource spécifiée du stockage.
     *
     * @param  \App\Models\Order  $order L'entité Order à supprimer
     * @return \Illuminate\Http\Response La réponse HTTP après avoir supprimé l'ordre
     */
    public function destroy(Order $order)
    {
        // Méthode pour supprimer un ordre existant (à implémenter)
    }
}
