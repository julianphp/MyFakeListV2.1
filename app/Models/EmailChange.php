<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailChange
 * @package App\Models
 */
class EmailChange extends Model
{
    /** The model for the emailChange table
     * @var string
     */
    protected $table = "email_change";
    protected $primaryKey = "idUsu";

    protected $fillable = [
        'idUsu', 'newEmail', 'token', 'used', 'created'
    ];
    public $timestamps = false;


}
