<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicule = Vehicule::all();
        return response()->json($vehicule);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function VehiculeDispo()
    {
        $vehicule = Vehicule::where("estLibre",1)->get();
        return response()->json($vehicule);
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
            'immatriculation'=> 'required',
            'marque'=> 'required',
            'Desc'=> 'required',
            'permis'=> 'required',
            // 'estLibre'=> 'required',
        ]);

        $vehicule=Vehicule::create([
            'immatriculation' => $request->immatriculation,
            'marque' => $request->marque,
            'Desc' => $request->Desc,
            'permis' => $request->permis,
            'estLibre' => 1,
        ]);

        return response()->json($vehicule,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicule $vehicule)
    {
        return response()->json($vehicule);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicule $vehicule)
    {
        $this->validate($request, [
            'immatriculation'=> 'required',
            'marque'=> 'required',
            'Desc'=> 'required',
            'permis'=> 'required',
        ]);

        $vehicule->update([
            'immatriculation' => $request->immatriculation,
            'marque' => $request->marque,
            'Desc' => $request->Desc,
            'permis' => $request->permis,
            'estLibre' => $request->estLibre,
        ]);
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicule $vehicule)
    {
        $vehicule->delete();
        return response()->json();
    }
}
