<?php


namespace App\Http\Controllers;


use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class Error404 extends Controller
{
    public function error404(){
        $array = [1, 2, 3];

        $random = Arr::random($array);
        return response()->view('error404',['user' => Auth::user(),'error' => $random]);
    }

}
