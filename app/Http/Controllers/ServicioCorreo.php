<?php

namespace App\Http\Controllers;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Session;

/**
 * Class ServicioCorreo
 * @package App\Http\Controllers
 */
class ServicioCorreo extends Mailable
{

    public $nombre;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view("correo")
            ->from("kumiko@kumiko.es")
            ->subject("Bienvenida a mi sitio");
    }

    /** Send the email to the user.
     * @param $email
     * @param $token
     * @return bool
     */
    public static function sendResetPass($email,$token){
        if (App::getLocale() == "en"){
            $subject = "Your password reset link - MyFakeList";
        } else {
            $subject = "Link Reestablecimiento de contraseña - MyFake List";
        }

        $for = $email;
        $token = ['token' => $token];
        try {
            Mail::send('email.resetPassword',$token, static function($msj) use($subject,$for){
                $msj->from("myfakelist@kumiko.es","MyFakeList");
                $msj->subject($subject);
                $msj->to($for);
            });
            return true;
        } catch (\Exception $e){
            return false;
        }

       // return redirect()->back();
    }

    /** Send the email verification email to the user
     * @param $email
     * @param $token
     * @return bool
     */
    public static function sendEmailVerification($email,$token){
        if (App::getLocale() == "en"){
            $subject = "Your link to activate the new email - MyFakeList";
        } else {
            $subject = "Tu link para activar el nuevo correo - MyFake List";
        }

        $for = $email;
        $token = ['token' => $token];
        try {
            Mail::send('email.activateEmail',$token, static function($msj) use($subject,$for){
                $msj->from("myfakelist@kumiko.es","MyFakeList");
                $msj->subject($subject);
                $msj->to($for);
            });
            return true;
        } catch (\Exception $e){
            return false;
        }
    }
    public static function sendDeleteAccountVerification($email,$token){
        if (App::getLocale() == "en"){
            $subject = "Your link for delete your account :( - MyFakeList";
        } else {
            $subject = "Este es el ultimo paso para elimitar tu cuneta :( - MyFake List";
        }

        $for = $email;
        $token = ['token' => $token];
        try {
            Mail::send('email.deleteAccount',$token, static function($msj) use($subject,$for){
                $msj->from("myfakelist@kumiko.es","MyFakeList");
                $msj->subject($subject);
                $msj->to($for);
            });
            return true;
        } catch (\Exception $e){
            return false;
        }
    }

}
