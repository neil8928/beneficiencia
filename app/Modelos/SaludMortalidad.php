<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class SaludMortalidad extends Model
{
    protected $table = 'saludmortalidad';
    public $timestamps=false;


    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';
}
