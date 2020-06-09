<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuSerie extends Model
{
    protected $table = "ususer";
    protected $primaryKey = 'idUsu';
    protected $fillable = [
        'idUsu', 'idSe', 'capitulo', 'status', 'score','review','fec_ini','fec_fin','favorita'
    ];
    public $timestamps = false;

/*
    public function serie1(){
        return $this->belongsTo(Serie::class,'idSe');
    }
  /*  public function serie(){
        return $this->hasMany(Serie::class,'idSe');
    }
  */

    public function scopeUsuario($query,$idUsu){
        if ($idUsu){
            return $query->where('idUsu','LIKE',"%$idUsu%");
        }
    }
    public function scopeSerie($query,$idSe){
        if ($idSe){
            return $query->where('idSe','LIKE',"%$idSe%");
        }
    }

}
