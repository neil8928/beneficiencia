<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class SaludBeneficiario extends Model
{
    protected $table = 'saludbeneficiarios';
    public $timestamps=false;


    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';
}
