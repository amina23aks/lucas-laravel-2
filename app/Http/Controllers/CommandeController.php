<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
    // Récupérer toutes les commandes
    public function index()
    {
        $commandes = Commande::with(['user', 'produit'])->get();
        return response()->json($commandes);
    }

    // Créer une nouvelle commande
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_produit' => 'required|exists:produits,id_produit',
            'quantite' => 'required|integer|min:1',
        ]);

        // Vérifier la disponibilité du produit en stock
        $produit = Produit::find($request->id_produit);

        if (!$produit) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }

        if ($produit->quantite < $request->quantite) {
            return response()->json(['message' => 'Stock insuffisant'], 400);
        }

        // Démarrer une transaction pour garantir l'intégrité des données
        DB::beginTransaction();

        try {
            // Créer la commande
            $commande = Commande::create([
                'id_user' => $request->id_user,
                'id_produit' => $request->id_produit,
                'quantite' => $request->quantite,
            ]);

            // Réduire la quantité du produit en stock
            $produit->quantite -= $request->quantite;
            $produit->save();

            // Valider la transaction
            DB::commit();

            return response()->json($commande, 201);
        } catch (\Exception $e) {
            // Annuler la transaction en cas d'erreur
            DB::rollBack();
            return response()->json(['message' => 'Erreur lors de la création de la commande'], 500);
        }
    }

    // Afficher une commande spécifique
    public function show($id)
    {
        $commande = Commande::with(['user', 'produit'])->find($id);

        if (!$commande) {
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }

        return response()->json($commande);
    }

    // Mettre à jour une commande
    public function update(Request $request, $id)
    {
        $commande = Commande::find($id);

        if (!$commande) {
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }

        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_produit' => 'required|exists:produits,id_produit',
            'quantite' => 'required|integer|min:1',
        ]);

        $commande->update($request->all());

        return response()->json($commande);
    }

    // Supprimer une commande
    public function destroy($id)
    {
        $commande = Commande::find($id);

        if (!$commande) {
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }

        $commande->delete();

        return response()->json(['message' => 'Commande supprimée avec succès']);
    }
}
