<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contacts() {
         $contacts = Contact::all();
         return response()->json(
            [
                'contacts'=>$contacts,
                'message'=>'Contacts',
                'code'=> 200,
            ]
            );
        }
            public function addContact(Request $request)
    {
        try {
            // Validation des données
            $validated = $request->validate([
               'name' => ['required', 'string', 'between:2,255'],
                'email' => ['required', 'email', 'unique:users,email'],
                'designation' => ['required', 'string', 'between:2,255'],
                 'contact_no' => ['required', 'regex:/^[0-9]{10,15}$/'],

            ]);

            Contact::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'designation' => $validated['designation'],
                'contact_no' => $validated['contact_no'],
                
            ]);

            return response()->json([
             'message'  => 'Contact created succesfully', 
                'code' =>201
            ]);

        
     } catch (Exception $e) {
            // Retourne l'erreur en cas d'échec
            return response()->json(['error' => $e->getMessage()], 500);
        }
}
public function deleteContact($id){
  $contact = Contact::find($id);
 if (isset($contact)){
    $contact->delete();
    return response()->json([
        'message' => 'Contact deleted successfully',
        'code'=>200,
    ]);
 }
 else{
    return response()->json ([
        'message'=>'contact not found',
    ]);
 };
}
public function contactById($id){
    $contact = Contact::findOrFail($id);
    return response()->json([
        'contact' => $contact,
        'code' =>200,
    ]);
    return response()->json([
        'error' => 'Contact not found',
    ]);
}
public function updateContact(Request $request, $id)
{
    try {
        // Validation des données
        $validated = $request->validate([
            'name' => ['required', 'string', 'between:2,255'],
            'email' => ['required', 'email', 'unique:contacts,email,'.$id], // Ne pas inclure l'email de ce contact
            'designation' => ['required', 'string', 'between:2,255'],
            'contact_no' => ['required', 'between:9,20'],
        ]);

        // Recherche du contact à mettre à jour
        $contact = Contact::findOrFail($id); // Récupère le contact avec l'ID, ou échoue si non trouvé

        // Mise à jour des informations
        $contact->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'designation' => $validated['designation'],
            'contact_no' => $validated['contact_no'],
        ]);

        // Réponse de succès
        return response()->json([
            'message' => 'Contact updated successfully',
            'code' => 200
        ], 200);

    } catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    
}


