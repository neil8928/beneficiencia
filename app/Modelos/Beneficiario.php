<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model
{
    protected $table = 'beneficiarios';
    public $timestamps=false;


    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    public function ficha()
    {
        return $this->hasMany('App\Modelos\FichaSocioEconomica','id','ficha_id');
    }

    // public function provincias()
    // {
    //     return $this->hasMany('App\Modelos\Provincia', 'departamento_id', 'id');
    // }
}
