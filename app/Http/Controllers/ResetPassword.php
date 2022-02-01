<?php


namespace App\Http\Controllers;

use App\Models\Usuario;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class ResetPassword extends Controller
{
    /** Send the email for change the password. Create a new token in the table password_resets
     * @param Request $req
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function RequestResetPassword(Request $req)
    {
        if (Auth::check()) {
            return redirect()->intended('inicio');
        } else {
            if (!$req->has('email')) {
                return view('resetPassword.requestResetPassword', ['user' => false]);
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
                    try {
                        Mail::to($email)->send(new \App\Mail\ResetPassword($token));
                        return view('resetPassword.requestResetPassword',['user' => false,'send' => true]);

                    } catch (\Exception $e){
                        Log::channel('daily')->debug($e);
                        return view('resetPassword.requestResetPassword',['user' => false,'errorSend' => true]);

                    }
                } else {
                    return view('resetPassword.requestResetPassword',['user' => false, 'error' => true]);
                }
            }
        }
    }

    /** Change to the new password. Check if the token is valid, or was used or expired.
     * @param Request $req
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function setNewRequestPasswordForget(Request $req){
        $token = $req->token;
        if (!Auth::check()) {
            $user = DB::table('password_resets')->where('token',$token)->first();
            if(!$user){
                return view('resetPassword.newPassword',['user' => false,'token' => false]);
            }
            $fecToken = Carbon::parse($user->created_at);
            $diff = $fecToken->diffInRealHours(Carbon::now());
            if ($diff > 1) {
                return view('resetPassword.newPassword',['user' => false,'token' => false]);
            }
            if (!$req->has('pass')){
                if ( (int)$user->used !== 1 ) {
                    return view('resetPassword.newPassword',['user' => false,'token' => $token]);
                }
                return view('resetPassword.newPassword',['user' => false,'token' => false]);
            } else {
                $pass = $req->get('pass');
                $pass1 = $req->get('pass1');
                if( ($pass !== $pass1) || (strlen($pass1) < 5)){
                    return redirect()->back()->with('errorPass',true);
                } else {
                    Usuario::email($user->email)->update(['password' => Hash::make($pass) ]);
                    DB::table('password_resets')->where('token',$token)->update(['used' => 1]);
                    return redirect()->intended('login')->with('success',true);
                }
            }


        } else {
            return redirect()->intended('inicio');
        }

    }

}
