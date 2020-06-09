<?php

namespace App\Http\Controllers;

use App\Models\UsuSerie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    public function verPerfil(Request $idUsu){
        $idUsu = $idUsu->idUsu;
         $serFav = UsuSerie::join('serie','ususer.idSe', '=','serie.idSe')->where('ususer.idUsu',$idUsu)->where('ususer.favorita','1')->get();
       //  $serFav1 = Usuario::find(11);
       //  $serFav1 = $serFav1->series->all();
       // echo "<pre>".print_r($serFav1, true)."</pre>" ;
        //   $serFav = UsuSerie::join('serie','ususer.idSe', '=','serie.idSe')->where('ususer.idUsu',$idUsu)->where('ususer.favorita','1')->select('ususer.*', 'serie.*')->get();
       // $serFav = UsuSerie::join('serie','ususer.idSe', '=','serie.idSe')->where('ususer.idUsu',$idUsu)->where('ususer.favorita','1')->select('serie.*')->get();
           //$serFav = UsuSerie::
         //dd($serFav->first()->titulo);
       //  $serFav = json_decode(json_encode($serFav), true);
       // $serFav = UsuSerie::with('serie')->where('favorita','LIKE','1') ;
       // echo $serFav[0]->titulo;
       // echo "<pre>".print_r($serFav, true)."</pre>" ;
        if ($serFav->isEmpty()){
            $serFav = false;
        }
        if (Auth::check()){
            $user = Auth::user();
            if ($idUsu == $user['idUsu']) {
                $usuVis = Usuario::find($idUsu);


                return view('perfil.ver', ['user' => $user,'edit' => true,'usuario' => $usuVis, 'seriesFav' => $serFav]);

            } else {
                if ( !$usuVis = Usuario::find($idUsu)){
                    return response()->view('error404',['user' => \Illuminate\Support\Facades\Auth::user()]);
                }
                return view('perfil.ver', ['user' => $user, 'edit' => false,'usuario' => $usuVis, 'seriesFav' => $serFav]);

            }
        } else {


            if ( !$usuVis = Usuario::find($idUsu)){
                return redirect()->intended('inicio');
            }

            return view('perfil.ver', ['user' => false,'edit' =>false ,'usuario' => $usuVis, 'seriesFav' => $serFav]);

        }
    }
    public static function subirFoto(Request $req){
        $user = Usuario::find(Auth::id());
        if ( (($req->file('img')->getMimeType() == "image/png") || ($req->file('img')->getMimeType() == "image/jpeg"))
                && ($req->file('img')->getSize() < '4194304') ) {
            $url = $req->file('img')->storeAs('/public/avatares',Auth::id().'.jpg');
            //Usuario::where('idUsu',Auth::id())->update()

            $url = Str::after($url,'public/');
            $user->avatar = $url;
            $user->save();
            return redirect()->back()->with('successPhoto',true);
        } else {
            return redirect()->back()->with('errorPhoto',true);
           // return redirect()->route('perfil.ver', ['idUsu' => Auth::id(),'alias' => $user->alias,'errorPhoto' => true]);
        }


    }
    public static function editInfoUsu(Request $req){
        if (Auth::id() == $req->get('idUsu')){
            Usuario::find(Auth::id())
                     ->update(['location'=> $req->get('location'),
                               'about' => $req->get('about')]);
        }
        return redirect()->back();

    }
    public static function password(Request $req){
        if (Auth::id() == $req->get('idUsu')){
            $pass = $req->get('pass');
            $pass1 = $req->get('pass1');
            if( ($pass != $pass1) || (strlen($pass1) < 5)){
                return redirect()->back()->with('pass','no');
            } else {
                Usuario::find(Auth::id())->update(['password' => Hash::make($pass) ]);
                return redirect()->back()->with('pass','ok');
            }
        }

    }
}
