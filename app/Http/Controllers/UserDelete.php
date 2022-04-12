<?php


namespace App\Http\Controllers;


use App\Mail\ChangeEmailUserMail;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserDelete extends  Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
public function sendDeleteCon(){
    if (Auth::check()) {

        $user = Usuario::find(Auth::id());

        $token = Str::random(69);
        $user->token_delete_account = $token;
        $user->token_delete_account_date = Carbon::now();
        $user->save();

        try {
            Mail::to($user->email)->send(new ChangeEmailUserMail($token));
            return redirect()->back()->with('successMailDelAcc',true);
        } catch (\Exception $e){
            Log::channel('daily')->debug($e);
            return redirect()->back()->with('errorEmailSend',true);
        }
    }
}

    /**
     * @param Request $req
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
public function deleteAccount(Request $req){
    $token = $req->token;
    if ($user = Usuario::where('token_delete_account','=',$token)->first()){
        if (Auth::id() == $user->idUsu) {
            $date = Carbon::parse($user->token_delete_account_date);
            $datediff = $date->diffInHours(Carbon::now());
            if ($datediff < 1) {
                if (!$req->has('delete')) {
                    return view('deleteAccount.confirmDelete')->with('token', $token);
                } else {
                    $user =  Usuario::find(Auth::id());
                    $user->forceDelete();
                    return view('deleteAccount.confirmDelete')->with('success',true);
                }

            } else {
                return view('deleteAccount.confirmDelete')->with('errorExist',true);
            }
        } else {
            return view('deleteAccount.confirmDelete')->with('errorLog',true);
        }

    } else {
        return view('deleteAccount.confirmDelete')->with('errorExist',true);
    }
}
}
