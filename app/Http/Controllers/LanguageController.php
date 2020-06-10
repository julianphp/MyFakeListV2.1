<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    /** change the language in the page
     * @param Request $req
     * @return \Illuminate\Http\RedirectResponse
     */
    public function idioma(Request $req){
        $lang = $req->segments()[0];
        App::setLocale($lang);
       session(['locale' => $lang]);
        return redirect()->back();
        //return redirect()->intended('inicio');
    }
}
