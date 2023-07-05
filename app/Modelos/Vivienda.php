<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use App\Modelos\Detalleconcepto;

class Vivienda extends Model
{
    
    protected $table = 'viviendas';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

}
