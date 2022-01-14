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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::fallback(function(){
    return response()->json([
        'error' => 'Url incorrecta.'], 404);
});

Route::get('series/random','api\SerieController@random'); // solo para el inicio
Route::prefix('series')->group(function (){
    Route::get('{id}','api\SerieController@find')->middleware('auth:api');
    Route::get('tipo/{tipo}','api\SerieController@tipo')->middleware('auth:api');
    Route::get('titulo/{titulo}','api\SerieController@titulo');



});


Route::prefix('usuario')->group(function (){
    Route::get('get/{id}','api\UsuarioController@find')->middleware('auth:api');
    Route::post('{id}','api\UsuarioController@find')->middleware('auth:api');
    Route::get('nick/{id}','api\UsuarioController@usuario')->middleware('auth:api');
});


Route::post('login','api\LoginController@login');
Route::post('logout','api\LoginController@logout')->middleware('auth:api');
