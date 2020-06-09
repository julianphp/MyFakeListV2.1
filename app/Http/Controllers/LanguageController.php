<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function idioma(Request $req){
        $lang = $req->segments()[0];
        App::setLocale($lang);
       session(['locale' => $lang]);
        return redirect()->back();
        //return redirect()->intended('inicio');
    }
}
