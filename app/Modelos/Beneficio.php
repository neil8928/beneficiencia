<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use App\Modelos\Detalleconcepto;

class Beneficio extends Model
{
    
    protected $table = 'beneficios';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

}
