<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class SesionController extends Controller
{


    public function login(Request $request){
        if (!Auth::check()) {
            if (!$request->has('email')){
                return view('login', ['user' => false, 'error' => false]) ;
            }

            // $password = Hash::make($request->input('password'));
            $credentials = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];
            if($request->get('recordar') == 'on') {
                $remember = true;
            } else {
                $remember = false;
            }

            if (Auth::attempt($credentials,$remember)) {

                return redirect()->intended('inicio');
            } else {
                return view('login', ['user' => false, 'error' => true]);
            }
        } else {
            return redirect()->intended('inicio');
        }


    }
    public function logout(){
        if (Auth::check()){
            Auth::logout();
            return redirect()->intended('inicio');
        }
        return redirect()->intended('inicio');

    }

}
