<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
   
    protected $table = 'distritos';
    public $timestamps=false;


    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    // public function provincias()
    // {
    //     return $this->hasMany('App\Modelos\Provincia', 'departamento_id', 'id');
    // }
}
