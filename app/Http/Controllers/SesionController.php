<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class SesionController
 * @package App\Http\Controllers
 */
class SesionController extends Controller
{

    /** Login for the user. If is actually login is redirect to the inicio.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
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

    /** Close the session ㄟ( ▔, ▔ )ㄏ
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(){
        if (Auth::check()){
            Auth::logout();
            return redirect()->intended('inicio')->with('success',true);
        }
        return redirect()->intended('inicio');

    }

}
