<?php

namespace App\Models;

use App\Models\Order;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // Utilisation des traits pour ajouter des fonctionnalités au modèle User
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * Ces attributs peuvent être définis lors de la création ou de la mise à jour
     * d'un utilisateur en utilisant la méthode `fill` ou `create`.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',     // Nom de l'utilisateur
        'email',    // Adresse email de l'utilisateur
        'password', // Mot de passe de l'utilisateur
    ];

    /**
     * Les attributs qui devraient être cachés lors de la sérialisation.
     *
     * Ces attributs ne seront pas inclus dans les réponses JSON lorsque le modèle
     * sera converti en une représentation JSON (par exemple, lors d'une API).
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',      // Mot de passe de l'utilisateur, ne sera pas inclus dans les réponses JSON
        'remember_token', // Token de rappel pour la connexion persistante, ne sera pas inclus dans les réponses JSON
    ];

    /**
     * Les attributs qui devraient être castés à un type spécifique.
     *
     * Cela permet de convertir automatiquement les attributs à un format spécifique lorsque
     * le modèle est accédé. Par exemple, convertir des dates en objets DateTime.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime', // Convertit l'attribut 'email_verified_at' en une instance de DateTime
    ];

    /**
     * Décrit la relation entre l'utilisateur et les commandes.
     *
     * Un utilisateur peut avoir plusieurs commandes. Cette méthode retourne une relation
     * "a plusieurs" (HasMany) avec le modèle Order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(): HasMany
    {
        // Retourne la relation "a plusieurs" (HasMany) entre User et Order
        return $this->hasMany(Order::class);
    }
}
