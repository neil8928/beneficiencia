<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Permanencia extends Model
{
    protected $table = 'permanencia';
    public $timestamps=false;


    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';
    
    // public function ficha()
    // {
    //     return $this->belongsTo('App\Modelos\FichaSocioEconomica', 'permanencia_id', 'id');
    // }
}
