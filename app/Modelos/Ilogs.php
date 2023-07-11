<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Ilogs extends Model
{
    protected $table = 'ilogs';
    public $timestamps=false;


    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';
}
