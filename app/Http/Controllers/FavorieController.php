<?php

namespace App\Http\Controllers;

use App\Models\Favorie;
use Illuminate\Http\Request;

class FavorieController extends Controller
{
    // Récupérer tous les favoris d'un utilisateur
    public function index(Request $request)
    {
        $favoris = Favorie::with('produit')->where('id_user', $request->user()->id)->get();
        return response()->json($favoris);
    }

    // Ajouter un produit aux favoris
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_produit' => 'required|exists:produits,id_produit',
        ]);

        $favorie = Favorie::create($request->all());
        return response()->json($favorie, 201);
    }

    // Afficher un favori spécifique
    public function show($id)
    {
        $favorie = Favorie::with('produit')->find($id);

        if (!$favorie) {
            return response()->json(['message' => 'Favori non trouvé'], 404);
        }

        return response()->json($favorie);
    }

    // Supprimer un favori
    public function destroy($id)
    {
        $favorie = Favorie::find($id);

        if (!$favorie) {
            return response()->json(['message' => 'Favori non trouvé'], 404);
        }

        $favorie->delete();

        return response()->json(['message' => 'Favori supprimé avec succès']);
    }
}
