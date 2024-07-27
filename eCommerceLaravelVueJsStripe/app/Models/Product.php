<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    // Utilisation du trait HasFactory pour permettre l'utilisation des factories avec ce modèle
    use HasFactory;

    /**
     * Définit la relation entre le produit et les commandes.
     *
     * Un produit peut être associé à plusieurs commandes et une commande
     * peut contenir plusieurs produits. Cette relation est de type
     * "appartient à plusieurs" (BelongsToMany).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders(): BelongsToMany
    {
        // Retourne la relation "appartient à plusieurs" (BelongsToMany) entre Product et Order
        return $this->belongsToMany(Order::class)
            // Spécifie les colonnes supplémentaires dans la table de pivot
            ->withPivot('price', 'quantity'); // Les colonnes 'price' et 'quantity' seront accessibles depuis la table de pivot
    }

    /**
     * Accesseur pour obtenir le prix formaté du produit.
     *
     * Cet accesseur calcule le prix formaté du produit en euros. Le prix est
     * divisé par 100 pour le convertir en format décimal et le résultat est
     * formaté avec une virgule comme séparateur décimal et le symbole euro.
     *
     * @return string
     */
    public function getFormattedPriceAttribute(): string
    {
        // Convertit le prix en format décimal en divisant par 100
        // Remplace le point décimal par une virgule pour le format français
        // Ajoute le symbole euro à la fin
        return str_replace('.', ',', $this->price / 100) . '€';
    }
}
