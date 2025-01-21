<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;

    protected $table = 'paniers';

    protected $primaryKey = 'id_panier';

    protected $fillable = [
        'id_user',
        'id_produit',
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
