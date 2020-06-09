<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Usuario;
use App\Models\UsuSerie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListaController extends Controller
{
    public function lista(Request $req){

        $idUsu = $req->idUsu;
        if(!$aliasUsu = Usuario::find($idUsu)){
            return response()->view('error404',['user' => \Illuminate\Support\Facades\Auth::user()]);
        }


        $listaUsu = UsuSerie::join('serie','ususer.idSe', '=','serie.idSe')
                            ->where('ususer.idUsu',$idUsu)
                            ->orderBy('ususer.status','DESC')
                            ->orderBy('serie.titulo','ASC')
                            ->get();
        //echo "<pre>".print_r($listaUsu, true)."</pre>" ;
        if ($listaUsu->isEmpty()){
            $listaUsu = false;
        }
        if (Auth::check()) {
            $user = Auth::user();
            $estados = array(
                0 => "Viendo",
                1 => "Para_Ver",
                2 => "Droppeada",
                3 => "Completada"
            );

            return view('lista.ver',['lista'=> $listaUsu,'aliasUsu' => $aliasUsu, 'user' => $user,'estados' => $estados]);

        } else {
           // echo "<pre>".print_r($listaUsu, true)."</pre>" ;
            return view('lista.ver',['lista'=> $listaUsu,'aliasUsu' => $aliasUsu, 'user' => false]);
        }



    }

    public function score(Request $req){
        if ($req->ajax()){
            if ($req->get('usu') == Auth::id())
            UsuSerie::usuario($req->get('usu'))
                ->serie($req->get('se'))
                ->update(['score' => $req->get('sc')]);
        }
    }
    public function capitulo(Request $req){
        if ($req->ajax()){
            if ($req->get('usu')== Auth::id() ){
            $serieUsu = UsuSerie::join('serie','ususer.idSe', '=','serie.idSe')
                        ->where('ususer.idUsu',$req->get('usu'))
                        ->where('ususer.idSe',$req->get('se'))->get();
            $capAct = $serieUsu[0]->capitulo;
             if ($capAct < $serieUsu[0]->episodios){
                 if ($serieUsu[0]->status != "Viendo") {
                     UsuSerie::usuario($req->get('usu'))
                         ->serie($req->get('se'))
                         ->update(['status' => 'Viendo']);
                 }
                 if (($capAct + 1) == $serieUsu[0]->episodios){
                     UsuSerie::usuario($req->get('usu'))
                         ->serie($req->get('se'))
                         ->update(['fec_end' => Carbon::now(),'status' => 'Completada']);
                 }
                    UsuSerie::usuario($req->get('usu'))
                        ->serie($req->get('se'))
                        ->update(['capitulo' => $capAct +1]);
                    return $capAct + 1;
                } else {
                 return $capAct;
             }


            }
        }
    }

    public function review(Request $req){
        if ($req->ajax()){
            if (Auth::id() == $req->get('usu')) {
                $serie = $req->get('se');
                $txt = $req->get('text');
                $this->updateReview($serie, $txt);
            }
        }
    }
    public function status(Request $req){
        if ($req->ajax()){
            if ($req->get('usu') == Auth::id()){
                $ususer = New UsuSerie();
                $ususer->idUsu = $req->get('usu');
                $ususer->idSe = $req->get('se');
                $ususer->capitulo = 0;
                $ususer->status = "Viendo";
                $ususer->score = NULL;
                $ususer->review = NULL;
                $ususer->fec_add = Carbon::now();
                $ususer->fec_end = NULL;
                $ususer->favorita = NULL;

                $ususer->save();
            }



            //   UsuSerie::create(['idUsu'=> 11,'idSe' => 32555,'capitulo' => 0,'status'=> 'Viendo','score'=>NULL,'review'=>NULL,'fec_ini' =>Carbon::now(),'fec_fin'=>NULL,'favorita'=>0]);


        }
    }
    public function borrarUsuSe(Request $req){
        if ($req->ajax()){
            if (Auth::id() == $req->get('usu')){
                UsuSerie::usuario($req->get('usu'))
                            ->serie($req->get('se'))
                            ->delete();

            }
        }
    }
    public function modStatus(Request $req){
        if ($req->ajax()){

            if (Auth::id() == $req->get('usu')){
                $sts = $req->get('est');
                $idSe = $req->get('se');
                $this->updateStatus($sts,$idSe);
            }
        }
    }
    public function favoritos(Request $req){
        if ($req->ajax()){
            if (Auth::id() == $req->get('usu')){
                if ($req->get('opeS') == 0){
                    UsuSerie::usuario(Auth::id())
                            ->serie($req->get('se'))
                            ->update(['favorita'=> 0]);
                } elseif ($req->get('opeS') ==1){
                    UsuSerie::usuario(Auth::id())
                        ->serie($req->get('se'))
                        ->update(['favorita'=> 1]);
                }
            }
        }
    }
    public function editSerieUsu(Request $req){
        $id = $req->get('idUsu');
        if (Auth::id() == $id )
            $idSe = $req->get('idSe');
            $sts = $req->get('status');
            $cap = ($req->get('cap') == "") ? NULL : $req->get('cap');

            $coment = $req->get('coment');

            if ($sts == "Para Ver") {
                $sts = "Para_Ver";
            }

            $this->updateCap($idSe,$cap);
            $this->updateStatus($sts,$idSe);
            $this->updateReview($idSe,$coment);

            return redirect()->back();
    }

    private function updateStatus($sts,$serie){
        $estados = array(
            0 => "Viendo",
            1 => "Para_Ver",
            2 => "Droppeada",
            3 => "Completada"
        );


        foreach ($estados as $item){
            if ($item == $sts){
                UsuSerie::usuario(Auth::id())
                    ->serie($serie)
                    ->update(['status'=> $sts]);
            }
        }

    }

    private function updateReview($idSe,$txt){
        UsuSerie::usuario(Auth::id())
            ->serie($idSe)
            ->update(['review' => $txt] );
    }

    private function updateCap($idSe,$cap){
        $serieUsu = UsuSerie::join('serie','ususer.idSe', '=','serie.idSe')
            ->where('ususer.idUsu',Auth::id())
            ->where('ususer.idSe',$idSe)->first();
        if ( ($cap >= 0)  && ($cap <= $serieUsu->episodios) && ($cap != NULL)){
            if ($serieUsu->status != "Viendo") {
                UsuSerie::usuario(Auth::id())
                    ->serie($idSe)
                    ->update(['status' => 'Viendo']);
            }
            if ( $cap == $serieUsu->episodios){
                UsuSerie::usuario(Auth::id())
                    ->serie($idSe)
                    ->update(['fec_end' => Carbon::now(),'status' => 'Completada']);
            }
            UsuSerie::usuario(Auth::id())
                ->serie($idSe)
                ->update(['capitulo' => $cap]);
        }
    }


}
