<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class InfoAPI extends Controller
{

public function info(){
    if (Auth::check()){
        return view('UsoDeApi',['user' => Auth::user()]);
    } else {
        return redirect()->intended('inicio');
    }
}
}
