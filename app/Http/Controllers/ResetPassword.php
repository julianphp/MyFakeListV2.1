<?php


namespace App\Http\Controllers;

use App\Models\Usuario;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class ResetPassword extends Controller
{
    public static function sendMail(Request $req)
    {
        if (Auth::check()) {
            return redirect()->intended('inicio');
        } else {
            if (!$req->has('email')) {
                return view('resetPassword.olvidemicontrasenia', ['user' => false]);
            } else {
                $user = Usuario::email($req->get('email'))->get();

                if (!$user->isEmpty()) {
                    $email = $user[0]->email;
                    $token = Str::random(69);
                    DB::table('password_resets')->insert([
                        'email' => $email,
                        'token' => $token,
                        'created_at' => Carbon::now()
                    ]);

                    if (!ServicioCorreo::sendResetPass($email,$token)){
                        return view('resetPassword.olvidemicontrasenia',['user' => false,'errorSend' => true]);
                    } else {
                        return view('resetPassword.olvidemicontrasenia',['user' => false,'send' => true]);
                    }
                } else {
                    return view('resetPassword.olvidemicontrasenia',['user' => false, 'error' => true]);
                }
            }
        }
    }

    /**
     * @param Request $req
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public static function nueva(Request $req){
        $token = $req->token;
        if (!Auth::check()) {
            $user = DB::table('password_resets')->where('token',$token)->get();
            $fecToken = Carbon::parse($user[0]->created_at);
            $diff = $fecToken->diffInHours(Carbon::now());
            if ($diff > 1) {
                return view('resetPassword.newPassword',['user' => false,'token' => false]);
            }
            if (!$req->has('pass')){
                if ( (!$user->isEmpty()) && ($user[0]->used != 1 ) ) {
                    return view('resetPassword.newPassword',['user' => false,'token' => $token]);
                } else {
                    return view('resetPassword.newPassword',['user' => false,'token' => false]);
                }
            } else {
                $pass = $req->get('pass');
                $pass1 = $req->get('pass1');
                if( ($pass != $pass1) || (strlen($pass1) < 5)){
                    return redirect()->back()->with('errorPass',true);
                } else {
                    Usuario::email($user[0]->email)->update(['password' => Hash::make($pass) ]);
                    DB::table('password_resets')->where('token',$token)->update(['used' => 1]);
                    return redirect()->intended('login')->with('success',true);
                }
            }


        } else {
            return redirect()->intended('inicio');
        }
        }

}
