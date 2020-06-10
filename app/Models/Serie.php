<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Serie extends Model

{
    /** Model of the serie table
     * @var string
     */
    protected $table = "serie";
    protected $primaryKey = "idSe";
    public $timestamps = false;
    //

    /** query scope for titulo where search
     * @param $query
     * @param $titulo
     * @return mixed
     */
    public function scopeTitulo($query,$titulo){
        if ($titulo){
            return $query->where('titulo','LIKE',"%$titulo%")->orderBy('titulo')->get();
        }
    }

    /** query scope for idSe where
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeId($query,$id){
        if ($id){
            return $query->where('idSe','LIKE',$id)->first();
        }
    }

    /** Some relations
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
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
