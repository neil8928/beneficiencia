<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use App\Modelos\Detalleconcepto;

class Familiar extends Model
{
    protected $table = 'familiares';
    public $timestamps=false;


    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';


    public function estadocivil()
    {
        $detalle    = (!is_null($this->estadocivil_id)) ? Detalleconcepto::where('id','=',$this->estadocivil_id)->first() : NULL;
        $concepto_id= (!is_null($detalle)) ? $detalle->concepto_id:NULL;
        return $this->belongsTo('App\Modelos\Concepto', $concepto_id, 'id');
    }

    public function encuestador()
    {
        return $this->belongsTo('App\User', 'encuestador_id', 'id');
    }
}
