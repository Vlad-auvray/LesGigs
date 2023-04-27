<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Listing;

class ListingController extends Controller
{

    // Montrer toutes les items de la liste
    public function index() {
         return view('listings.index', [
        'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
    ]);
    }

    // Montrer un item de la liste
    public function show(Listing $listing) {
 return view('listings.show', [
            'listing' => $listing
        ]);
    }

    //Montrer le formulaire de création
    public function create() {
        return view('listings.create');
    }

    //Conserver les données issues du formulaire
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos','public');
            $formFields['logo'] = 'storage/'.$formFields['logo'];
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        

        return redirect('/')->with('message', 'Annonce postée !'); 
    }

    //Afficher le formulaire d'édition 
    public function edit(Listing $listing) {
        return view('listings.edit', ['listing' => $listing]);
    }

    //MAJ données d'un item
    public function update(Request $request, Listing $listing) {

        // S'assurer que l'user connecté est celui qui a créé l'item
        if($listing->user_id != auth()->id()) {
            abort(403, 'Non autorisé');
        }


        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos','public');
            $formFields['logo'] = 'storage/'.$formFields['logo'];
        }

        $listing->update($formFields);

        

        return back()->with('message', 'Annonce mise à jour !'); 
    }

    //Supprimer un item
    public function destroy(Listing $listing) {

         // S'assurer que l'user connecté est celui qui a créé l'item
        if($listing->user_id != auth()->id()) {
            abort(403, 'Non autorisé');
        }

        $listing->delete();
        return redirect('/')->with('message','Item supprimé avec succès.');
    }

    
//Gérer un item
public function manage() {
    return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
}

}
