<?php


namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\Estudio;
use App\Models\Serie;
use Illuminate\Http\Request;


class SerieController extends Controller
{
    public function find(int $id){
        if (!Serie::find($id)){
            return response()->json([
                'error'   => true,
                'status' => 'No se encuentra la serie.'
            ],404);
        } else {
            return response()->json(Serie::find($id));
        }

    }
    public function tipo(string $tipo){
        $ser = Serie::where('tipo',$tipo)->get();
        if ($ser->isEmpty()){
            return response()->json([
                'error'   => true,
                'status' => 'No se encuentra nada con los parametros recibidos.'
            ],404);
        } else {
            return response()->json($ser);
        }
    }
    public function titulo(string $titulo){
        $ser = Serie::titulo($titulo);
        if ($ser->isEmpty()){
            return response()->json([
                'error'   => true,
                'status' => 'No se encuentra nada con los parametros recibidos.dd'
            ],404);
        } else {
            return response()->json($ser);
        }
    }
    public function random(){
        return response()->json(Serie::all()->random(8));
    }

}
