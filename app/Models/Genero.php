<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    /** Model of genero table
     * @var string
     */
    protected $table = "genero";
    protected $primaryKey = "idGen";

    /** Set a relation with series
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function serie(){
        return $this->belongsToMany(Serie::class,'sergen','idGen','idSe');
    }

}
