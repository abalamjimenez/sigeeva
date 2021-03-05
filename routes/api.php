<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/historial-detalle-expediente/', 'API\HistorialController@expediente');
Route::get('/grupos-x-asignatura/', 'API\GrupoController@index');
Route::get('/registros-x-perfil/', 'API\GroupController@index');
