<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens,Notifiable, SoftDeletes;

    protected $table = "usuario";
    protected $primaryKey = "idUsu";
    protected $fillable = [
        'idUsu', 'alias', 'email', 'password', 'avatar','about','location','is_admin'
    ];


    protected $hidden = [
        'email','updated_at','password', 'remember_token','is_admin'
    ];

    /** Scope seach for ususuario
     * @param $query
     * @param $usuario
     * @return mixed
     */
    public function scopeUsuario($query,$usuario){
        if ($usuario){
            return $query->where('alias','LIKE',"%$usuario%")->orderBy('alias')->get();
        }
    }

    /** Scope search for email
     * @param $query
     * @param $email
     * @return mixed
     */
    public function scopeEmail($query,$email){
        if ($email){
            return $query->where('email','LIKE',"$email");
        }
    }
    //
    public function series(){
        return $this->belongsToMany(Serie::class,'ususer','idSe','idUsu');

    }


}
