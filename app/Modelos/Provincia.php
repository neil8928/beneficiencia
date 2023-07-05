<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    
    protected $table = 'provincias';
    public $timestamps=false;


    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';
}
