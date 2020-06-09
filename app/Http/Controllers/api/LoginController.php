<?php


namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function login(Request $req){

        if (!Auth::attempt(request(['email', 'password']))){
            return response()->json([
                'error'   => true,
                'status' => "Credenciales Incorrectas."
            ], 401);
        }

        $token = Auth::user()->createToken(Auth::user()->email) ;


        return response()->json([
            'error'   => false,
            'status' => 'Todo bien, todo correcto',
            'token'   => $token->accessToken,
        ], 200);
    }
    public function logout(){
        Auth::user()->token()->revoke();
        return response()->json([
           'error' =>false,
            'status' => "Desconectado correctamente"
        ],200);
    }
}
