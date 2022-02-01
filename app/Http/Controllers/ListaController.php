<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Usuario;
use App\Models\UsuSerie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laminas\Diactoros\Response\JsonResponse;

class ListaController extends Controller
{
    /** Show the anime list of the user Request. If the list request is the same that de user logged, they can modificy the status
     * @param Request $req
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function lista(Request $req){

        $idUsu = $req->idUsu;
        if(!$aliasUsu = Usuario::find($idUsu)){
            return redirect()->action('Error404@error404');
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

    /** Change the score of the anime
     * @param Request $req
     */
    public function score(Request $req) : \Illuminate\Http\JsonResponse
    {
        if ($req->get('usu') == Auth::id()){
            try {
                UsuSerie::usuario($req->get('usu'))
                    ->serie($req->get('ser'))
                    ->update(['score' => $req->get('sc')]);

                return response()->json([
                    'error' => false,
                ]);
            } catch (\Exception $e){
                Log::channel('daily')->debug($e);
                return response()->json([
                    'error' => true,
                ]);
            }

        }
        return response()->json([
            'error' => true,
        ]);
    }


    /** Change the episode view of the user
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function capitulo(Request $req){
       // if ($req->ajax()){ FIXME check this
        \Log::channel('daily')->info($req->all());
        try {
            if ((int)$req->get('usu') === Auth::id() ){
                $serieUsu = UsuSerie::join('serie','ususer.idSe', '=','serie.idSe')
                    ->where('ususer.idUsu',$req->get('usu'))
                    ->where('ususer.idSe',$req->get('ser'))->get();
                $capAct = $serieUsu[0]->capitulo;
                if ($capAct < $serieUsu[0]->episodios){
                    if ($serieUsu[0]->status !== "Viendo") {
                        UsuSerie::usuario($req->get('usu'))
                            ->serie($req->get('ser'))
                            ->update(['status' => 'Viendo']);
                    }
                    if (($capAct + 1) == $serieUsu[0]->episodios){
                        UsuSerie::usuario($req->get('usu'))
                            ->serie($req->get('ser'))
                            ->update(['fec_end' => Carbon::now(),'status' => 'Completada']);
                    }
                    UsuSerie::usuario($req->get('usu'))
                        ->serie($req->get('ser'))
                        ->update(['capitulo' => $capAct +1]);
                    return response()->json([
                        'error' => false,
                        'cap' => $capAct + 1
                    ]);
                } else {
                    return response()->json([
                        'error' => false,
                        'cap' => $capAct
                    ]);
                }

            }
        } catch (\Exception $e){
            Log::channel('daily')->debug($e);
            return response()->json([
                'error' => true,
            ]);
        }

       // }
    }

    /** Change the review of the anime that have the user
     * @param Request $req
     */
    public function review(Request $req) : \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($req->all(),[
            'text' => 'string|max:254'
        ],[
            'text.string' => trans('list.validation_string'),
            'text.max' => trans('list.validation_max_254'),
        ]);
        if ($validator->fails()){
            $customReturn = ['error' => true];
            $customReturn += ['msg' => $validator->errors()];
            return response()->json($customReturn);
        }
        if (Auth::id() === (int)$req->get('usu')) {
            try {
                $serie = $req->get('ser');
                $txt = $req->get('text');
                $this->updateReview($serie, $txt);

                return response()->json([
                    'error' => false
                ]);
            } catch (\Exception $e){
                Log::channel('daily')->debug($e);
                return response()->json([
                    'error' => true,
                ]);
            }

        }
        return response()->json([
            'error' => true,
        ]);
    }

    /** Add a new anime to the list of the user.
     * @param Request $req
     */
    public function addSeriesToUserList(Request $req): \Illuminate\Http\JsonResponse
    {
        if ((int)$req->get('usu') === Auth::id()) {
            try {
                $ususer = new UsuSerie();
                $ususer->idUsu = Auth::id();
                $ususer->idSe = $req->get('ser');
                $ususer->capitulo = 0;
                $ususer->status = "Viendo";
                $ususer->score = null;
                $ususer->review = null;
                $ususer->fec_add = Carbon::now();
                $ususer->fec_end = null;
                $ususer->favorita = null;

                $ususer->save();
                return response()->json([
                    'error' => false,
                ]);
            } catch (\Exception $e){
                Log::channel('daily')->debug($e);
                return response()->json([
                    'error' => true,
                ]);
            }

        }
        return response()->json([
            'error' => true,
        ]);

    }

    /** Delete an anime of the user list
     * @param Request $req
     */
    public function borrarUsuSe(Request $req) : \Symfony\Component\HttpFoundation\JsonResponse
    {
        if (Auth::id() === (int)$req->get('usu')) {
            try {
                UsuSerie::usuario(Auth::id())
                    ->serie($req->get('ser'))
                    ->delete();
                return response()->json([
                    'error' => false
                ]);
            } catch (\Exception $e) {
                Log::channel('daily')->debug($e);
                return response()->json([
                    'error' => true
                ]);
            }
        }

        return response()->json([
                'error' => true
            ]);
    }

    /** Change the status of an anime that are seing the user
     * @param Request $req
     */
    public function modStatus(Request $req){
        if (Auth::id() === (int)$req->get('usu')) {
            try {
                $sts = $req->get('sts');
                $idSe = $req->get('ser');

                $this->updateStatus($sts, $idSe);
                return response()->json([
                    'error' => false,
                ]);
            } catch (\Exception $e) {
                Log::channel('daily')->debug($e);
                return response()->json([
                    'error' => true,
                ]);
            }
        }
        return response()->json([
            'error' => true,
        ]);

    }

    /** add an anime to favorites user list
     * @param Request $req
     */
    public function favoritos(Request $req) : \Illuminate\Http\JsonResponse
    {
        try {
            if (Auth::id() == $req->get('usu')){
                if ((int)$req->get('ope') === 0){
                    UsuSerie::usuario(Auth::id())
                        ->serie($req->get('ser'))
                        ->update(['favorita'=> 0]);
                } elseif ((int)$req->get('ope') === 1){
                    UsuSerie::usuario(Auth::id())
                        ->serie($req->get('ser'))
                        ->update(['favorita'=> 1]);
                }
            }
            return response()->json([
                'error' => false
            ]);
        } catch (\Exception $e){
            Log::channel('daily')->debug($e);
            return response()->json([
                'error' => true,
            ]);
        }

    }

    /** Edit options of the Modal in anime list
     * @param Request $req
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /** Update the status of the anime
     * @param $sts
     * @param $serie
     */
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

    /** Update the review of the user
     * @param $idSe
     * @param $txt
     */
    private function updateReview($idSe,$txt){
        UsuSerie::usuario(Auth::id())
            ->serie($idSe)
            ->update(['review' => $txt] );
    }

    /** Update the eps seeing of the user
     * @param $idSe
     * @param $cap
     */
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
