<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class FichaSocioEconomica extends Model
{
    protected $table = 'fichasocioeconomica';
    public $timestamps=false;


    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    public function estado()
    {
        return $this->belongsTo('App\Modelos\Estado', 'estado_id', 'id');
    }

    public function encuestador()
    {
        return $this->belongsTo('App\User', 'encuestador_id', 'id');
    }


}
