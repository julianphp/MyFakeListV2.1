<?php

namespace App\Http\Controllers;


use App\Models\Estudio;
use App\Models\Serie;
use App\Models\Usuario;
use App\Models\UsuSerie;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SerieController extends Controller
{
    /** REsponse with the anime id requested. Get the study, genres, related. Also check if the user has these anime in
     * their list for display add options or edits options
     * @param Request $idSe
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function ver(Request $idSe){


        //  dd($idSe->input('idSe'));
        $id = $idSe->idSe;


        if (!$dat = Serie::find($id)) {
            return redirect()->action('Error404@error404');
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

    /** AJAX SEARCH. Search anime and users
     * @param Request $req
     * @return false|string
     * @throws \JsonException
     */
     public function busqueda(Request $req){
         try {
             $txt = $req->get('texto');
             if (strlen($txt) > 2 && !(substr_count($txt, " ") === strlen($txt) )) {
                 $serie = Serie::titulo($req->get('texto'));
                 $usuario = Usuario::usuario($req->get('texto'));
                 if ($serie->isEmpty()) {
                     $serie = false;
                 }
                 if ($usuario->isEmpty()) {
                     $usuario = false;
                 }
                 return json_encode(view("busqueda1", ['ser' => $serie, 'usu' => $usuario])->render());
             }

             return json_encode(view("busqueda1", ['ser' => false, 'usu' => false])->render());
         } catch (\Exception $e) {
             \Log::channel('daily')->debug($e);
             return json_encode(view("busqueda1", ['ser' => false, 'usu' => false])->render());

         }




     }




}
