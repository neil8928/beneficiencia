<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use App\Modelos\Detalleconcepto;

class ConvivenciaFamiliar extends Model
{
    
    protected $table = 'convivenciafamiliares';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

}
