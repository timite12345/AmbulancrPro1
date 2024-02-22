<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DemandeTransp;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Mission as MissionRessource;
use App\Models\Chauffeur;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $missions = DB::table('missions')
        ->join('demande_transps', 'missions.demande', '=', 'demande_transps.id')
        ->join('etb_santes','demande_transps.etbSante', '=','etb_santes.id')
            ->get(); 
        return response()->json($missions);
    }

    public function index2($id)
    {
        $missions = DB::table('missions')
        ->join('demande_transps', 'missions.demande',
         '=', 'demande_transps.id')
        ->where('missions.heureFin', '=',  null)
        ->where('chauffeurP', '=',  $id)
        ->orderByDesc('missions.heureDeb')
        ->get(); 
        return response()->json($missions);
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
            'chauffeurP'=>'required',
            'chauffeurS'=>'required',
            'vehicule'=>'required',
            'demande'=>'required',
            'prix'=>'required',
        ]);

        $demande = DemandeTransp::findOrFail($request->demande);
        $chaufP = Chauffeur::findOrFail($request->chauffeurP);
        $chaufS = Chauffeur::findOrFail($request->chauffeurS);

        $demande->update([
            'estTraiter'=> 1,
        ]);

        $chaufP->update([
            'estDisponible'=> 0,
        ]);

        $chaufS->update([
            'estDisponible'=> 0,
        ]);


        $mission = Mission::create([
            'chauffeurP' => $request->chauffeurP,
            'chauffeurS' => $request->chauffeurS,
            'vehicule' => $request->vehicule,
            'demande' => $request->demande,
            'estFacturer' => 0,
            'prix' => $request->prix,
        ]);

        return response()->json($mission, 201); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function show( $mission)
    {
        $missions = DB::table('missions')
        ->join('demande_transps', 'missions.demande', '=', 'demande_transps.id')
        ->where('missions.id', $mission)
        ->get(); 
        // $mission = Mission::all();
        return response()->json($missions);
        // return new MissionRessource($mission);
    }

    public static function traiter($id)
    {
        $mission = Mission::findorfail($id);
         $mission->update([
            'estFacturer' => 1,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mission $mission)
    {
        $this->validate($request, [
            'chauffeurP'=>'required',
            'chauffeurS'=>'required',
            'vehicule'=>'required',
            'demande'=>'required',
            'prix'=>'required',
        ]);

        $mission->update([
            'chauffeurP' => $request->chauffeurP,
            'chauffeurS' => $request->chauffeurS,
            'vehicule' => $request->vehicule,
            'demande' => $request->demande,
            'prix' => $request->prix,
        ]);

        return response()->json();
    }

     public function updateheuredeb( Request $request, $id)
    {
        $mission= Mission::findOrFail($id);
        $timestamp = date('Y-m-d H:i:s', strtotime($request->heureDeb));
        $mission->update([
            'heureDeb' => $timestamp,
        ]);
    }

    public function updateheurefin(Request $request, $id)
    {
        $mission= Mission::findOrFail($id);
        $timestamp = date('Y-m-d H:i:s', strtotime($request->heureFin));
        $mission->update([
            'heureFin' => $timestamp,
        ]);
    }

    public function updatecomment(Request $request, $id)
    {
        $mission= Mission::findOrFail($id);
        $comm=$mission->commentaire.'\n'.$request->commentaire;
        $mission->update([
            'commentaire' => $comm,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mission $mission)
    {
        $mission->delete();
        return response()->json();
    }
}
