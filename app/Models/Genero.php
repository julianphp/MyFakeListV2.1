<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $table = "genero";
    protected $primaryKey = "idGen";


    public function serie(){
        return $this->belongsToMany(Serie::class,'sergen','idGen','idSe');
    }

}
