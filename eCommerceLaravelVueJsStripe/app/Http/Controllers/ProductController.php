<?php

namespace App\Http\Controllers;

use App\Models\Product; // Importation du modèle Product
use App\Http\Requests\StoreProductRequest; // Importation de la requête de validation pour la création de produit
use App\Http\Requests\UpdateProductRequest; // Importation de la requête de validation pour la mise à jour de produit

/**
 * Contrôleur pour gérer les opérations CRUD sur les produits
 */
class ProductController extends Controller
{
    /**
     * Affiche la liste des ressources.
     *
     * @return \Illuminate\Http\Response La réponse HTTP avec la liste des produits
     */
    public function index()
    {
        // Récupère 16 produits aléatoires qui sont actifs
        $products = Product::inRandomOrder()
            ->whereActive(true) // Filtre les produits actifs
            ->take(16) // Limite le nombre de produits à 16
            ->get(); // Exécute la requête et récupère les produits

        // Retourne la vue 'products.index' avec les produits
        return view('products.index', compact('products'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle ressource.
     *
     * @return \Illuminate\Http\Response La réponse HTTP pour afficher le formulaire de création
     */
    public function create()
    {
        // Méthode pour afficher le formulaire de création de produit (à implémenter)
    }

    /**
     * Enregistre une nouvelle ressource dans le stockage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request La requête de validation pour la création de produit
     * @return \Illuminate\Http\Response La réponse HTTP après avoir enregistré le produit
     */
    public function store(StoreProductRequest $request)
    {
        // Méthode pour enregistrer un nouveau produit (à implémenter)
    }

    /**
     * Affiche la ressource spécifiée.
     *
     * @param  \App\Models\Product  $product L'entité Product à afficher
     * @return \Illuminate\Http\Response La réponse HTTP avec les détails du produit
     */
    public function show(Product $product)
    {
        // Méthode pour afficher les détails d'un produit spécifique (à implémenter)
    }

    /**
     * Affiche le formulaire d'édition de la ressource spécifiée.
     *
     * @param  \App\Models\Product  $product L'entité Product à modifier
     * @return \Illuminate\Http\Response La réponse HTTP pour afficher le formulaire d'édition
     */
    public function edit(Product $product)
    {
        // Méthode pour afficher le formulaire d'édition d'un produit spécifique (à implémenter)
    }

    /**
     * Met à jour la ressource spécifiée dans le stockage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request La requête de validation pour la mise à jour de produit
     * @param  \App\Models\Product  $product L'entité Product à mettre à jour
     * @return \Illuminate\Http\Response La réponse HTTP après avoir mis à jour le produit
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        // Méthode pour mettre à jour un produit existant (à implémenter)
    }

    /**
     * Supprime la ressource spécifiée du stockage.
     *
     * @param  \App\Models\Product  $product L'entité Product à supprimer
     * @return \Illuminate\Http\Response La réponse HTTP après avoir supprimé le produit
     */
    public function destroy(Product $product)
    {
        // Méthode pour supprimer un produit existant (à implémenter)
    }
}
