<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class SaludFamiliar extends Model
{
    protected $table = 'saludfamiliares';
    public $timestamps=false;


    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    public function familiar(){
        return $this->hasMany('App\Modelos\Familiar', 'familiar_id', 'id');
    }
}
