<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\EtbSante;
use Illuminate\Http\Request;
use App\Http\Resources\EtbSante as EtbSanteRessource;
use App\Models\TypeEtb;

class EtbSanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etbs = EtbSante::all();
        return response()->json($etbs);
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
            'email' => 'required|email',
            'adresse'=> 'required|max:100',
            'tel'=> 'required',
            'typeEtb'=> 'required',
        ]);
        $etbs = EtbSante::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'tel' => $request->tel,
            'estValide' => 0,
            'typeEtb' => $request->typeEtb,

        ]);

         // On retourne les informations du nouvel utilisateur en JSON
         return response()->json($etbs); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EtbSante  $etbSante
     * @return \Illuminate\Http\Response
     */
    public function show( $etbSante)
    {
        $etb= EtbSante::findOrFail($etbSante);
        return  new EtbSanteRessource($etb);
    }

   
    public function AllType(){
        $etb=TypeEtb::All();
        return response()->json($etb); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EtbSante  $etbSante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $etb)
    {
        $etbSante= EtbSante::findOrFail($etb);
        $this->validate($request, [
            'nom' => 'required|max:100',
            'email' => 'required|email|',
            'adresse'=> 'required|max:100',
            'tel'=> 'required|max:12',
            'typeEtb'=> 'required',
        ]);

        $etbSante->update([
            'nom' => $request->nom,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'tel' => $request->tel,
            'typeEtb' => $request->typeEtb,
        ]);

         // On retourne les informations du nouvel utilisateur en JSON
         return response()->json(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EtbSante  $etbSante
     * @return \Illuminate\Http\Response
     */
    public function destroy($etb)
    {
        $etbSante= EtbSante::findOrFail($etb);
        $etbSante->delete();
        return response()->json();
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EtbSante  $etbSante
     * @return \Illuminate\Http\Response
     */
    public function valideEtb(Request $request,EtbSante $etbSante)
    {
        $etbSante->update([
            'estValide' => $request->estValide,
        ]);
        return response()->json();
    }
}
