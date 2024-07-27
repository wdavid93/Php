<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    // Utilisation du trait HasFactory pour permettre l'utilisation des factories avec ce modèle
    use HasFactory;

    /**
     * Attributs qui ne sont pas mass assignables.
     *
     * Ici, le tableau est vide, ce qui signifie que tous les attributs sont
     * mass assignables. Cela peut être modifié pour définir des attributs protégés
     * si nécessaire.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Définit la relation entre la commande et l'utilisateur.
     *
     * Une commande appartient à un utilisateur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        // Retourne la relation "appartient à" (BelongsTo) entre Order et User
        return $this->belongsTo(User::class);
    }

    /**
     * Définit la relation entre la commande et les produits.
     *
     * Une commande peut avoir plusieurs produits et chaque produit peut
     * apparaître dans plusieurs commandes. Cette relation est de type 
     * "appartient à plusieurs" (BelongsToMany).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): BelongsToMany
    {
        // Retourne la relation "appartient à plusieurs" (BelongsToMany) entre Order et Product
        return $this->belongsToMany(Product::class)
            // Spécifie les colonnes supplémentaires dans la table de pivot
            ->withPivot('price', 'quantity'); // Les colonnes 'price' et 'quantity' seront accessibles depuis la table de pivot
    }
}
