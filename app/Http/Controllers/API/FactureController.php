<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\EtbSante;
use App\Models\Facture;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
// use Barryvdh\DomPDF\Facade\Pdf;
// use Barryvdh\DomPDF\PDF as PDF;
// use Barryvdh\DomPDF\Facade\Pdf as PDF;
class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etbs = Facture::all();
        return response()->json($etbs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getDoc(Request $request){

        $filename=$request->nom;
        $path = storage_path('app\\public\\facture\\'.$filename);
        // dd($path);
        // return Storage::download($filename);

        return response()->download($path);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $missions = DB::table('missions')
            ->join('demande_transps', 'missions.demande', '=', 'demande_transps.id')
            ->where('demande_transps.etbSante', '=',  $request->etbsante)
            ->where('missions.estFacturer', '=',  0)
            ->get(); 
       
        $nb = $missions->count();

       if($nb!=0){
        $prixttc=0;
        $prixht =0;
        $data = $request->all();
        $etbs = EtbSante::findorfail($request->etbsante);
        $date = \Carbon\Carbon::now()->format('d/m/Y');
        $da = \Carbon\Carbon::now()->format('d-m-Y');
        $fac=Facture::all()->count();
        $name = "FactureN° ".$fac." ".$da." ".$etbs->nom.".pdf";
        $i=1;
        $pdf= PDF::loadView('mission_pdf_view', compact('missions','etbs','date','da','i','fac','prixht','prixttc'));
        Storage::put('public/facture/'.$name, $pdf->output());
        $data['nom'] = $name;

        foreach($missions as $mission){
            MissionController::traiter($mission->id);
        }

        Facture::create($data);

        return  $pdf->download($name);
    }else{
        return response()->json([
            'status' => false,
            'message' => "aucune Mission effectué"
        ]);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function show(Facture $facture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facture $facture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facture $facture)
    {
        //
    }
}
