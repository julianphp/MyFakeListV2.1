<?php

namespace App\Http\Controllers;

use App\Models\UsuSerie;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class RegistroController extends Controller
{
    /** Registry of the users, check if the email are in user, that the password are ok and the nick is ok
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function registro(Request $request){

        if (!Auth::check()) {
            if (!$request->has('correo')){
                return view('registro', ['user' => false]) ;
            }

            //Comprobamos si el correo esta ya en uso o no
             $email = Usuario::where('email','=', $request->get('correo'))->get();
            if (!$email->isEmpty()) {
                return redirect()->back()->with('email',true) ;

            }
            /*
            if ($request->validate(['nick'=> 'string|max:20'])){
                return "ok";
            } else {
                return "nook";
            } */

            if( ($request->get('contrasenia') != $request->get('confircontrasenia')) || (strlen($request->get('contrasenia')) < 5) || (strlen($request->get('nick')) > 20)){
                return redirect()->back()->with('error',true);
            }

            $alias = $request->input('nick');
            $email = $request->input('correo');
            $password = Hash::make($request->input('contrasenia')) ;
            $avatar = 'avatares/default.jpg';

            if (!preg_match("/^[a-zA-Z0-9_]+$/", $alias)){
                return redirect()->back()->with('nickError',true);
            }

            if ($this->inserUsu($alias,$email,$password,$avatar)) {
                return redirect()->back()->with('success',true);
            } else {
                return redirect()->back()->with('error',true);
            }



        } else {
           return redirect()->intended('inicio');
        }


    }

    /** Insert the new user in the table
     * @param $alias
     * @param $email
     * @param $password
     * @param $avatar
     * @return bool
     */
    private  function inserUsu($alias,$email,$password,$avatar){
        $usu = new Usuario();
        $usu->alias = $alias;
        $usu->email = $email;
        $usu->password = $password ;
        $usu->avatar = $avatar;
        $usu->about = NULL;
        $usu->location = NULL;
        return $usu->save();
    }

    /** check if the alias is taken or no. AJAX function
     * @param Request $req
     * @return false|string|void
     */
    public function alias(Request $req){
        if ($req->ajax()){

            $usu = Usuario::usuario($req->get('txt'));

            if (!$usu->isEmpty() && $usu[0]->alias == $req->get('txt')){
                $result = array('repe' => true);
                return json_encode($result);
            } else {
                $result = array('repe' => false);
                return json_encode($result);
            }
        }
    }
}
