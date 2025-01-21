<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Nom de la table associée au modèle (facultatif si le nom est pluriel de celui du modèle)
    protected $table = 'contacts';

    // Nom de la clé primaire personnalisée (si différente de `id`)
    protected $primaryKey = 'id_contact';

    // Désactiver les auto-incréments si ce n'est pas un entier (facultatif ici)
    // public $incrementing = true;

    // Type de la clé primaire
    protected $keyType = 'int';

    // Activer ou désactiver les colonnes `created_at` et `updated_at` (activées par défaut)
    public $timestamps = true;

    // Attributs qui peuvent être assignés en masse
    protected $fillable = [
        'name',
        'email',
        'message',
    ];

    // Attributs masqués dans les tableaux ou JSON
    protected $hidden = [];

    // Attributs castés (si besoin)
    protected $casts = [];
}
