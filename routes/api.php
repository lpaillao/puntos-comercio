<?php

use App\Http\Controllers\AnularController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VentasController;
use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\ComercioController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//muestra las ventas ingresadas
Route::get('/ventas',[VentasController::class,'index']);
//guardamos la venta
Route::post('/ventas',[VentasController::class,'store']);

Route::post('/dispositivos',[DispositivoController::class,'store']);
Route::get('/dispositivos/{id}',[DispositivoController::class,'show']);

Route::get('/comercio',[ComercioController::class,'index']);
Route::post('/comercio',[ComercioController::class,'store']);

Route::post('/anular',[AnularController::class,'store']);