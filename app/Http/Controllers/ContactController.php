<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Stocker un message
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return response()->json(['message' => 'Votre message a été envoyé avec succès.'], 201);
    }

    // Afficher tous les messages (admin uniquement)
    public function index()
    {
        $messages = Contact::all();
        return response()->json($messages);
    }

    // Supprimer un message
    public function destroy($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['message' => 'Message non trouvé'], 404);
        }

        $contact->delete();
        return response()->json(['message' => 'Message supprimé avec succès']);
    }
}
