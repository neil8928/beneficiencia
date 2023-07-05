<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamentos';
    public $timestamps=false;


    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    public function provincias()
    {
        return $this->hasMany('App\Modelos\Provincia', 'departamento_id', 'id');
    }

}
