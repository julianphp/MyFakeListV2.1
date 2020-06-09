<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('setlocale/{locale}',function($lang){ // añade el idioma a la variable de sesion
    Session::put('locale',$lang);
    return redirect()->back();
});
Route::fallback(function(){
    return response()->view('error404',['user' => \Illuminate\Support\Facades\Auth::user()]);
});
Route::get("test_mail", function(Request $r){
    $destinatario = "julianwindows8@hotmail.es";
    $nombre = "Luis Cabrera Benito";
    // Armar correo y pasarle datos para el constructor
    $correo = new \App\Http\Controllers\ServicioCorreo($nombre);
    # ¡Enviarlo!
    \Mail::to($destinatario)->send($correo);
});
Route::group(['middleware'=>'language'],function (){ // middleware change language
    Route::get('inicio', 'indexController@index')->name('inicio');
    Route::view('error404','error404',['user' => \Illuminate\Support\Facades\Auth::user()]);
    //Route::match(['get','post'],'busqueda1', 'SerieController@busqueda');
    Route::post('busqueda1', 'SerieController@busqueda')->name('busqueda');
    Route::get('UsoDeApi','InfoAPI@info')->name('UsoDeApi');
    // Para los idiomas
    //Route::get('{url}','LanguageController@idioma')->where('url','(es|en)');
    Route::get('administracion', 'Administracion@admin')->name('administracion');
    Route::post('borrarUsu','Administracion@borrar');
    Route::post('recuperarUsu','Administracion@recuperar');
    Route::prefix('registro')->group(function (){
        Route::match(['get','post'],'registro','RegistroController@registro')->name('registro') ;
        Route::post('alias','RegistroController@alias')->name('alias');
    });
    Route::match(['get','post'],'registro','RegistroController@registro')->name('registro') ;
    Route::match(['get','post'],'login','SesionController@login')->name('login') ;
    Route::match(['get','post'],'olvidemicontrasenia','ResetPassword@sendMail')->name('olvidemicontrasenia');
    Route::match(['get','post'],'nuevacontrasenia/{token}','ResetPassword@nueva')->name('nuevacontrasenia');

    Route::get('logout','SesionController@logout')->name('logout') ;
    Route::prefix('serie')->group(function (){
        Route::get('ver/{idSe}/{titulo}',   'SerieController@ver')->where('titulo', '(.*)')->name('serie.ver');
        Route::post('busqueda1', 'SerieController@busqueda')->name('busqueda');
        //operaciones de la serie de la lista del usuario
        Route::post('cap', 'ListaController@capitulo');
        Route::post('score', 'ListaController@score');
        Route::post('status', 'ListaController@status');
        Route::post('borrarUsuSe', 'ListaController@borrarUsuSe');
        Route::post('modStatus', 'ListaController@modStatus');
        Route::post('favoritos', 'ListaController@favoritos');
        Route::put('editSerieUsu','ListaController@editSerieUsu')->name('editSerieUsu');
    });
    Route::prefix('perfil')->group(function (){
            Route::get('ver/{idUsu}/{alias}','UsuarioController@verPerfil')->where('alias', '(.*)')->name('perfil.ver');
            Route::post('foto','UsuarioController@subirFoto')->name('perfil.foto');
            Route::post('busqueda1', 'SerieController@busqueda')->name('busqueda');
            //Route::post('editInfoUsu', 'UsuarioController@editInfoUsu')->name('editInfoUsu');
            Route::post('infousua', 'UsuarioController@editInfoUsu')->name('perfil.infousua');
            Route::post('password', 'UsuarioController@password')->name('perfil.password');

        // Route::match(['get','post'],'ver', 'UsuarioController@verPerfil')->name('ver');
    });
    Route::prefix('lista')->group(function (){
           Route::get('ver/{idUsu}/{alias}','ListaController@lista')->where('alias', '(.*)')->name('lista.ver');
           Route::post('busqueda1', 'SerieController@busqueda')->name('busqueda');
           //Operaciones de la lista
           Route::post('score', 'ListaController@score');
           Route::post('cap', 'ListaController@capitulo');
           Route::post('review', 'ListaController@review');
    });


}); // end middleware language
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
