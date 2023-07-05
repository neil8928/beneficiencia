<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Detalleconcepto extends Model
{
    protected $table = 'detalleconceptos';
    public $timestamps=false;


    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

}
