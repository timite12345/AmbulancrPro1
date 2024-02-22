<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Chauffeur;
use Illuminate\Http\Request;

class ChauffeurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chauffeur = Chauffeur::all();
        return response()->json($chauffeur);
    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ChauffeurDispo()
    {
        $chauffeur = Chauffeur::where('estDisponible', 1)->get();
        return response()->json($chauffeur);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|max:100',
            'prenom'=> 'required|max:100',
            'email' => 'required|email|unique:personne_malades',
            'adresse'=> 'required|max:100',
            'tel'=> 'required|max:12',
            'permis'=> 'required',
        ]);

        $chauffeur=Chauffeur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'tel' => $request->tel,
            'permis' => $request->permis,
        ]);

        return response()->json($chauffeur, 201); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chauffeur  $chauffeur
     * @return \Illuminate\Http\Response
     */
    public function show($chauffeur)
    {
        return response()->json($chauffeur);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chauffeur  $chauffeur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chauffeur $chauffeur)
    {
        $this->validate($request, [
            'nom' => 'required|max:100',
            'prenom'=> 'required|max:100',
            'email' => 'required|email|unique:personne_malades',
            'adresse'=> 'required|max:100',
            'tel'=> 'required|max:12',
            'permis'=> 'required',
        ]);

        $chauffeur->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'tel' => $request->tel,
            'permis' => $request->permis,
            'estDisponible' => $request->estDisponible,
        ]);
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chauffeur  $chauffeur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chauffeur $chauffeur)
    {
        $chauffeur->delete();
        return response()->json();
    }
}
