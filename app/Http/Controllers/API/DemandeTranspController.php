<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DemandeTransp;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Resources\DemandeTransp as DemandeTranspRessource;

class DemandeTranspController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $demande = DemandeTransp::all();
        $demande = DB::table('demande_transps')
        ->join('etb_santes', 'demande_transps.etbSante', '=', 'etb_santes.id')
        ->get(); 
        return response()->json($demande);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function DemandeNonTraiter()
    {
        // $demande = DemandeTransp::where("estTraiter", 0)->get();
        $demande = DB::table('demande_transps')
        ->join('etb_santes', 'demande_transps.etbSante', '=', 'etb_santes.id')
        ->where("estTraiter", 0)
        ->get(); 
        return response()->json($demande);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'nom' => 'required|max:100',
        //     'prenom'=> 'required|max:100',
        //     'email' => 'required|email|unique:demande_transps',
        //     // 'adresse'=> 'required|max:100',
        //     // 'tel'=> 'required|max:12',
        //     // 'conditionTransp' => 'required',
        //     // 'adresseDep'=> 'required',
        //     // 'adresseArriv' => 'required',
        //     'etbSante'=> 'required',
        // ]);

        

        $demande = DemandeTransp::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'tel' => $request->tel,
            'conditionTransp'=> $request->conditionTransp,
            'adresseDep'=> $request->adresseDep,
            'adresseArriv'=> $request->adresseArriv,
            'estUrgent'=> $request->estUrgent,
            'estTraiter'=> 0,
            'estFacturer'=> 0,
            'etbSante'=> $request->etbSante,

        ]);

         // On retourne les informations du nouvel utilisateur en JSON
         return response()->json($demande, 201); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DemandeTransp  $demandeTransp
     * @return \Illuminate\Http\Response
     */
    public function show($demand)
    {
        $demandeTransp= DemandeTransp::findOrFail($demand);

        return  new DemandeTranspRessource($demandeTransp);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DemandeTransp  $demandeTransp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $demand, )
    { 
        $demandeTransp= DemandeTransp::findOrFail($demand);

        $this->validate($request, [
            'conditionTransp' => 'required',
            'adresseDep'=> 'required',
            'adresseArriv' => 'required',
            'etbSante'=> 'required',
            'nom' => 'required|max:100',
            'prenom'=> 'required|max:100',
            'adresse'=> 'required',
            'tel'=> 'required|max:14',
        ]);
        $demandeTransp->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'tel' => $request->tel,
            'conditionTransp'=> $request->conditionTransp,
            'adresseDep'=> $request->adresseDep,
            'adresseArriv'=> $request->adresseArriv,
            'estUrgent'=> $request->estUrgent,
            'etbSante'=> $request->etbSante,

        ]);

        // // On modifie les informations du malade
        // $malade = PersonneMalade::find($demandeTransp->id());
        // $malade->name = $request->input('nom');
        // $malade->name = $request->input('prenom');
        // $malade->email = $request->input('email');
        // $malade->course = $request->input('adresse');
        // $malade->section = $request->input('tel');
        // $malade->section = $request->input('dateN');
        // $malade->update();
        
       
        // On retourne la réponse JSON
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DemandeTransp  $demandeTransp
     * @return \Illuminate\Http\Response
     */
    public function destroy($demand)
    {
        //suppression et retour de la reponse en json
        $demandeTransp= DemandeTransp::findOrFail($demand);

        $demandeTransp->delete();
        return response()->json();

    }
}
