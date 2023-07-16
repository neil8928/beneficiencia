<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class FichaSocioEconomica extends Model
{
    protected $table = 'fichasocioeconomica';
    public $timestamps=false;


    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    public function estado()
    {
        return $this->belongsTo('App\Modelos\Estado', 'estado_id', 'id');
    }

    public function encuestador()
    {
        return $this->belongsTo('App\User', 'encuestador_id', 'id');
    }

    public function getopciones()
    {

        $opciones = [];
        switch($this->estado_id){
            case 1: $opciones = [
                                    'MODIFICAR'=>'/modificar-ficha-socieconomica',
                                    'APROBAR'=>'/aprobar-ficha-socieconomica',
                                    'DOCUMENTOS'=>'/gestion-documentos-ficha-socioeconomica',
                                    'ELIMINAR'=>'/eliminar-ficha-socieconomica'
                                    ];
                                    break; //GENERADO
            case 2: $opciones = [
                                    'REEVALUAR'=>'/reevaluar-ficha-socieconomica',
                                    'DETALLE'=>'/detalle-ficha-socieconomica',
                                    'DOCUMENTOS'=>'/ver-detalle-documentos-ficha-socieconomica',
                                    'TERMINAR'=>'/terminar-ficha-socieconomica'
                                    ];
                                    break;//APROBADO
            case 6: $opciones = [
                                    'DETALLE'=>'/detalle-ficha-socieconomica',
                                    'DOCUMENTOS'=>'/ver-detalle-documentos-ficha-socieconomica',
                                    ];
                                    break;//TERMINADA
        }
        return $opciones; 
    }

    public function permanencia()
    {
        return $this->belongsTo('App\Modelos\Permanencia', 'permanencia_id', 'id');
    }
}
