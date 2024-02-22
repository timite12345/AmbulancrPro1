<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ChauffeurController;
use App\Http\Controllers\API\DemandeTranspController;
use App\Http\Controllers\API\EtbSanteController;
use App\Http\Controllers\API\FactureController;
use App\Http\Controllers\API\MissionController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VehiculeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('user', UserController::class);
Route::apiResource('demande', DemandeTranspController::class);
Route::apiResource('mission', MissionController::class);
Route::apiResource('etbsante', EtbSanteController::class);
Route::apiResource('chauffeur', ChauffeurController::class);
Route::apiResource('facture', FactureController::class);
Route::apiResource('vehicule', VehiculeController::class);

Route::get('/chaufmission/{id}', [MissionController::class, 'index2']);
// Route::get('/mission2/{id}', [MissionController::class, 'index2']);
Route::get('/typeuser', [UserController::class, 'typeuser']);
Route::post('/getdoc', [FactureController::class, 'getDoc']);
Route::get('/alltype', [EtbSanteController::class, 'AllType']);
Route::get('/chauffeurDispo', [ChauffeurController::class, 'ChauffeurDispo']);
Route::get('/vehiculeDispo', [VehiculeController::class, 'VehiculeDispo']);
Route::get('/demandeNonT', [DemandeTranspController::class, 'DemandeNonTraiter']);
Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::get('/auth/logout', [AuthController::class, 'logout']);
Route::post('/updateheuredeb/{id}', [MissionController::class, 'updateheuredeb']);
Route::put('/updateheurefin/{id}', [MissionController::class, 'updateheurefin']);
