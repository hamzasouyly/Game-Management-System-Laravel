<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NftController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ShipsController;
use App\Http\Controllers\SpecialisationController;
use App\Http\Controllers\SpellsController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('nfts', NftController::class);
Route::apiResource('classes', ClassesController::class);
Route::post('/classes/{slug}', [ClassesController::class, 'update']);
Route::apiResource('roles', RolesController::class);
Route::post('/roles/{slug}', [RolesController::class, 'update']);
Route::apiResource('spells', SpellsController::class);
Route::post('/spells/{slug}', [SpellsController::class, 'update']);
Route::apiResource('specialisations', SpecialisationController::class);
Route::post('/specialisations/{slug}', [SpecialisationController::class, 'update']);
Route::apiResource('ships', ShipsController::class);
Route::post('/ships/{slug}', [ShipsController::class, 'update']);
