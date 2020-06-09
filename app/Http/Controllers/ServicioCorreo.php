<?php

namespace App\Http\Controllers;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Session;

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

    /**
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

}
