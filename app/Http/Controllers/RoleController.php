<?php

namespace App\Http\Controllers;


use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Récupérer tous les rôles
    public function index()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    // Créer un nouveau rôle
    public function store(Request $request)
    {
        $request->validate([
            'nom_role' => 'required|string|max:255',
            'description_role' => 'required|string',
        ]);

        $role = Role::create($request->all());
        return response()->json($role, 201);
    }

    // Afficher un rôle spécifique
    public function show($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Rôle non trouvé'], 404);
        }

        return response()->json($role);
    }

    // Mettre à jour un rôle
    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Rôle non trouvé'], 404);
        }

        $request->validate([
            'nom_role' => 'required|string|max:255',
            'description_role' => 'required|string',
        ]);

        $role->update($request->all());

        return response()->json($role);
    }

    // Supprimer un rôle
    public function destroy($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Rôle non trouvé'], 404);
        }

        $role->delete();

        return response()->json(['message' => 'Rôle supprimé avec succès']);
    }
}
