<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class ActividadEconomica extends Model
{
   protected $table = 'actividadeseconomicas';
    public $timestamps=false;


    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';
}
