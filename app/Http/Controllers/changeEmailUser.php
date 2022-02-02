<?php

namespace App\Http\Controllers;


use App\Mail\ChangeEmailUser;
use App\Models\EmailChange;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class changeEmailUser extends Controller
{
    /** Send an email for verify the change of the new email. Check if the new email is in use or not, and create a new entry in the table email_change.
     * @param Request $req
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function changeEmailUser(Request $req){
        if (Auth::id()) {

            $validator = Validator::make($req->all(),[
                'email' => 'email|unique:usuario,email'
            ],[
                'email.email' => trans('messages.email_format_incorrect'),
                'email.unique' => trans('messages.email_taken')
            ]);
            if ($validator->fails()){
                return redirect()->back()->with('validation_email',$validator->messages()->messages()['email']);
            }

            $newEmail = $req->input('email');
            $token = Str::random(69);

            $newChange = new EmailChange();

            $newChange->idUsu = Auth::id();
            $newChange->newEmail = $newEmail;
            $newChange->token = $token;
            $newChange->created = Carbon::now();

            $newChange->save();

            try {
                Mail::to($newEmail)->send(new ChangeEmailUser($token));
                return redirect()->back()->with('successEmail', $newEmail);
            } catch (\Exception $e) {
                Log::channel('daily')->debug($e);
                return redirect()->back()->with('errorEmailSend', trans('profile.errorEmailSend'));
            }
        } else {
            return response()->view('error404', ['user' => Auth::user()]);
        }


    }

    /** Verify the email with the token and update the new email of the users.
     * @param Request $req
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function verifyNewEmailUser(Request $req){
        $token = $req->token;

        if ($usuReq = EmailChange::where('token', $token)->first()) {
            $dateToken = Carbon::parse($usuReq->created);
            $dateToken = $dateToken->diffInRealMinutes(Carbon::now());
            if ($usuReq->idUsu === Auth::id()){
                if ((int)$usuReq->used !== 1 && $dateToken < 10) {
                    try {
                        DB::beginTransaction();
                        $usu = Usuario::find($usuReq->idUsu);
                        $usu->email = $usuReq->newEmail;
                        $usu->save();
                        EmailChange::where('token', $token)->update(['used' => 1]);
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollBack();
                        Log::channel('daily')->debug($e);
                        return view('verifyEmail')->with('error', true);
                    }
                    return view('verifyEmail')->with('success', true);
                } else {
                    return view('verifyEmail')->with('errorToken', true);
                }
            } else {
                return view('verifyEmail')->with('userMustLogin',trans('changeEmail.user_must_login'));
            }
        } else {
            return view('verifyEmail')->with('errorToken', true);
        }


    }
}
