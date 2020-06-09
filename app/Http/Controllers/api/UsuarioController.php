<?php


namespace App\Http\Controllers\api;


use App\Models\Usuario;

class UsuarioController
{
    public function find(int $idUsu){
        if (!Usuario::find($idUsu)){
            return response()->json([
                'error'   => true,
                'status' => 'No se encuentra el usuario.'
            ],404);
        } else {
            return response()->json(Usuario::find($idUsu));
        }
    }
    public function usuario(string $usuario){
        $usu = Usuario::usuario($usuario);
        if ($usu->isEmpty()){
            return response()->json([
                'error'   => true,
                'status' => 'No se encuentra ningun usuario.'
            ],404);
        } else {
            return response()->json($usu);
        }
    }
}
