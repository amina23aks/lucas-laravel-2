<?php

namespace App\Http\Controllers;


use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_categorie' => 'required|string|max:255',
            'description_categorie' => 'required|string',
        ]);

        $categorie = Categorie::create($request->all());
        return response()->json($categorie, 201);
    }

    public function show($id)
    {
        $categorie = Categorie::find($id);

        if (!$categorie) {
            return response()->json(['message' => 'Catégorie non trouvée'], 404);
        }

        return response()->json($categorie);
    }

    public function update(Request $request, $id)
    {
        $categorie = Categorie::find($id);

        if (!$categorie) {
            return response()->json(['message' => 'Catégorie non trouvée'], 404);
        }

        $request->validate([
            'nom_categorie' => 'required|string|max:255',
            'description_categorie' => 'required|string',
        ]);

        $categorie->update($request->all());

        return response()->json($categorie);
    }

    public function destroy($id)
    {
        $categorie = Categorie::find($id);

        if (!$categorie) {
            return response()->json(['message' => 'Catégorie non trouvée'], 404);
        }

        $categorie->delete();

        return response()->json(['message' => 'Catégorie supprimée avec succès']);
    }
}
