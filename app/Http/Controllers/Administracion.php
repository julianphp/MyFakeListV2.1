<?php


namespace App\Http\Controllers;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Administracion extends Controller
{
    /** Check if the user is an admin, and show the admin center for manage users or return to the inicio if is not admin
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function admin(){
        if (Auth::check()){
            $user = Auth::user();
            if ($user->is_admin == 1) {
                $listUsu = Usuario::all()->sortByDesc('is_admin',1);
                $listUsuBorrados = Usuario::onlyTrashed()->get();
                if ($listUsuBorrados->isEmpty()) {
                    $listUsuBorrados = false;
                }
                return view('admin.admin',['user' => $user,'listUsu' => $listUsu,'listDel' => $listUsuBorrados]);
            } else {
                return redirect()->intended('inicio');
            }

        } else {
            return redirect()->intended('inicio');
        }
    }

    /** Soft Delete an user and check that is not an admin
     * @param Request $req
     */
    public function borrar(Request $req){
        if ($req->ajax()){
            if ( !($req->get('usu') == Auth::id())){
                $user = Usuario::find($req->get('usu'));
                if ($user->is_admin != 1) {
                    Usuario::find($req->get('usu'))->delete();
                }

                return;
            }

        }
    }

    /** recovers the user that has been softdelete
     * @param Request $req
     */
    public function recuperar(Request $req){
        if ($req->ajax()){
            Usuario::onlyTrashed()->find($req->get('usu'))->restore();
            return;
        }
    }
}
