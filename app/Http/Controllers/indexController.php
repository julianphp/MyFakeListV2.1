<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Serie;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class indexController extends Controller
{
    //
    public function __construct()
    {
    }

    /** Show some series in the index
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $romance = Genero::find(22)->serie->random(8);
        $slice = Genero::find(36)->serie->random(8);

        //$romance = $this->GenRandom();
        //$slice = $this->GenRandom();
        $users = Usuario::all()->sortByDesc('created_at')->take(8);
        if (count($users) < 4) {
            $users = false;
        }
       // echo "<pre>".print_r($romance, true)."</pre>" ;
        return view('inicio', ['user' => Auth::user(),'romance' => $romance,'slice' => $slice,'users' => $users]);
    }
    private function GenRandom(){
        $gen1 = Genero::all()->random(1);
        try {
            $serRandom =  Genero::find($gen1[0]->idGen)->serie->random(8);
                if ($serRandom->first()) {
                    return $serRandom;
                }
        } catch (\Throwable $e) {
            echo "SIII";
            $this->GenRandom();
        }
    }

}
