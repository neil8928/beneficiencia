<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class OtroIngreso extends Model
{
    
    protected $table = 'otrosingresos';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

}
