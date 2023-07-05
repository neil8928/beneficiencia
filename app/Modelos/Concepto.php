<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    protected $table = 'conceptos';
    public $timestamps=false;


    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    public function detalle()
    {
        return $this->hasMany('App\Modelos\Detalleconcepto', 'concepto_id', 'id');
    }
}
