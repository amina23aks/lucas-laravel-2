<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commandes';

    protected $primaryKey = 'num_commande';

    protected $fillable = [
        'id_user',
        'id_produit',
        'quantite',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit');
    }
}
