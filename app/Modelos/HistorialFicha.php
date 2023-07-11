<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class HistorialFicha extends Model
{
   protected $table = 'historialficha';
    public $timestamps=false;


    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';
}