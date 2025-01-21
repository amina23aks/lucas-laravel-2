<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    // Récupérer tous les produits dans le panier d'un utilisateur
    public function index(Request $request)
    {
        $paniers = Panier::with('produit')->where('id_user', $request->user()->id)->get();
        return response()->json($paniers);
    }

    // Ajouter un produit au panier
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_produit' => 'required|exists:produits,id_produit',
        ]);

        $panier = Panier::create($request->all());
        return response()->json($panier, 201);
    }

    // Afficher un produit spécifique dans le panier
    public function show($id)
    {
        $panier = Panier::with('produit')->find($id);

        if (!$panier) {
            return response()->json(['message' => 'Produit non trouvé dans le panier'], 404);
        }

        return response()->json($panier);
    }

    // Supprimer un produit du panier
    public function destroy($id)
    {
        $panier = Panier::find($id);

        if (!$panier) {
            return response()->json(['message' => 'Produit non trouvé dans le panier'], 404);
        }

        $panier->delete();

        return response()->json(['message' => 'Produit supprimé du panier']);
    }
}
