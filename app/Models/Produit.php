<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $table = 'produits';

    protected $primaryKey = 'id_produit';

    protected $fillable = [
        'nom_produit',
        'id_category',
        'description_produit',
        'prix_produit',
        // 'quantite_produit', // Si la colonne est ajoutée dans le futur
    ];

    // Relation avec la catégorie
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie');
    }
}
