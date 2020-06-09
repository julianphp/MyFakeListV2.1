<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Serie extends Model

{
    protected $table = "serie";
    protected $primaryKey = "idSe";
    public $timestamps = false;
    //

    public function scopeTitulo($query,$titulo){
        if ($titulo){
            return $query->where('titulo','LIKE',"%$titulo%")->orderBy('titulo')->get();
        }
    }
    public function scopeId($query,$id){
        if ($id){
            return $query->where('idSe','LIKE',$id)->first();
        }
    }

    public function estudio(){
        return $this->belongsTo(Estudio::class,'idEst');
    }
    public function relacionados(){
        return $this->hasMany(Relacionados::class,'idSe');
    }
    public function genero(){
        return $this->belongsToMany(Genero::class,'sergen','idSe','idGen');
    }

     /*
    public function serie(){
        return $this->hasMany(UsuSerie::class,'idSe');
    }
     */

}
