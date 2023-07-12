<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class DocumentosFicha extends Model
{
    protected $table = 'documentosficha';
    public $timestamps=false;


    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';
}
