<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        // Récupérer tous les produits avec leurs quantités
        $produits = Produit::all();
        return response()->json($produits);
    }

    public function store(Request $request)
    {
        // Validation des données reçues
        $request->validate([
            'nom_produit' => 'required|string|max:255',
            'id_category' => 'required|exists:categories,id',
            'description_produit' => 'required|string',
            'prix_produit' => 'required|integer',
            'quantite' => 'required|integer|min:0',  // Ajout de la validation pour la quantité
        ]);

        // Création du produit avec la quantité
        $produit = Produit::create($request->all());

        return response()->json($produit, 201);
    }

    public function show($id)
    {
        // Afficher un produit spécifique avec la quantité
        $produit = Produit::find($id);

        if (!$produit) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }

        return response()->json($produit);
    }

    public function update(Request $request, $id)
    {
        // Récupérer le produit à mettre à jour
        $produit = Produit::find($id);

        if (!$produit) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }

        // Validation des données
        $request->validate([
            'nom_produit' => 'required|string|max:255',
            'id_category' => 'required|exists:categories,id',
            'description_produit' => 'required|string',
            'prix_produit' => 'required|integer',
            'quantite' => 'nullable|integer|min:0',  // Quantité peut être null si non modifiée
        ]);

        // Mise à jour du produit avec la nouvelle quantité si elle est fournie
        $produit->update($request->only(['nom_produit', 'id_category', 'description_produit', 'prix_produit', 'quantite']));

        return response()->json($produit);
    }

    public function destroy($id)
    {
        // Supprimer un produit
        $produit = Produit::find($id);

        if (!$produit) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }

        $produit->delete();

        return response()->json(['message' => 'Produit supprimé avec succès']);
    }
}
