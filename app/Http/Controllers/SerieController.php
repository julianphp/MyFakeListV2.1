<?php

namespace App\Http\Controllers;


use App\Models\Estudio;
use App\Models\Serie;
use App\Models\Usuario;
use App\Models\UsuSerie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SerieController extends Controller
{

    public function ver(Request $idSe){


        //  dd($idSe->input('idSe'));
        $id = $idSe->idSe;


        if (!$dat = Serie::find($id)) {
            return response()->view('error404',['user' => \Illuminate\Support\Facades\Auth::user()]);
        }  //busca la serie
        $est = Serie::find($id)->estudio; // busca el estudio al que pertenece la serie
        $rel = Serie::find($id)->relacionados; // busca las series relacionadas
        $gen = Serie::find($id)->genero; // busca los generos de la serie

        if ($rel->first()){ // comprueba si hay series relacionadas
            foreach ($rel as $item){
                $serRel[] = Serie::whereIn('idSe',array($item->idRel))->get();

            }
        } else {
            $rel = false;
            $serRel = false;
        }


     //   echo "<pre>".print_r($rel, true)."</pre>" ;
        if (Auth::check()){
            $user = Auth::user();

            $serieUsu = UsuSerie::join('serie','ususer.idSe', '=','serie.idSe')
                ->where('ususer.idUsu',$user->idUsu)
                ->where('ususer.idSe',$id)->get();
            if ($serieUsu->isEmpty()){
               $serieUsu = false;
            }
                $estados = array(
                    0 => "Viendo",
                    1 => "Para_Ver",
                    2 => "Droppeada",
                    3 => "Completada"
                );
                return view('serie.ver',['serie' => $dat, 'estudio' => $est,'rel' => $rel,'serRel' => $serRel ,
                                                'gen' => $gen, 'user' => $user,'serieUsu'=>$serieUsu,'estados'=> $estados]);


        } else {
            $user = false;
        }

        return view('serie.ver',['serie' => $dat, 'estudio' => $est,'rel' => $rel,'serRel' => $serRel , 'gen' => $gen, 'user' => $user]);
    }

     public function busqueda(Request $req){
        if ($req->ajax()){
            $serie = Serie::titulo($req->get('texto'));
            $usuario = Usuario::usuario($req->get('texto'));
            if ($serie->isEmpty()){
                $serie = false;
            } if ($usuario->isEmpty()){
                $usuario = false;
            }
           // echo "<pre>".print_r($serie, true)."</pre>";
            return view("busqueda1",['ser' => $serie,'usu' => $usuario]);
         //   return $req->get('texto');

            //return response()->json($data);
        }
       // return view('busqueda', ['dat' => $texto]);
    }




}
