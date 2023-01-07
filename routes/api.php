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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('hospital','App\Http\Controllers\hospital\HospitalController',['only'=>['index','show']]);



/**
 * RUTA DE CATALOS DEL HOSPITAL
 */

Route::resource('catalogosexo','App\Http\Controllers\Catalogos\CatalogoSexoController',['only'=> ['index','show']]);
Route::resource('users','App\Http\Controllers\User\UserController',['only'=> ['index','show','update','store','destroy']]);
Route::resource('loginapp','App\Http\Controllers\LoginApp\LoginAppController',['only'=> ['store']]);

