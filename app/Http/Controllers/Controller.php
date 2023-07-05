<?php

namespace App\Http\Controllers;
use App\Biblioteca\Funcion;
use DateTime;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


use App\Traits\GeneralesTraits;
	
class Controller extends BaseController {
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	use GeneralesTraits;

	public $funciones;

	public $inicio;
	public $fin;
	public $hoy;
	public $prefijomaestro;
	public $fechaactual;
	public $fechacrea;
	public $pathImg='img/secciones/';
	public $rutaurl='https://www.munilambayeque.gob.pe/';
	public $emailde='';

	//CODIGOS DE LA TABLA CONCPETOS
	public $codparentesco					=	'00001';
	public $codestadocivil					=	'00002';
	public $codniveleducativo				=	'00003';
	public $codtipodeseguro					=	'00004';
	public $coddiscapacidad					=	'00005';
	public $codniveldediscapacidad			=	'00006';
	public $codtipodiscapacidad				=	'00019';
	public $codocupacion					=	'00007';
	public $codfrecuenciaactividad			=	'00008';
	public $codbienes						=	'00009';
	public $codprogramabeneficiario			=	'00010';
	public $codtenenciadevivienda			=	'00011';
	public $coddocumentaciondevivienda		=	'00012';
	public $codmaterialdelavivienda			=	'00013';
	public $codserviciospublicos			=	'00014';
	public $codabastecimientoagua			=	'00015';
	public $codservicioshigienicos			=	'00016';
	public $codtipodeviolenciafamiliar		=	'00017';
	public $codinstitucionapoyoviolencia	=	'00018';


	public function __construct() {
		$this->funciones = new Funcion();

		$fecha = new DateTime();
		$fecha->modify('first day of this month');
		$this->inicio = date_format(date_create($fecha->format('Y-m-d')), 'd-m-Y');
		$this->fin = date_format(date_create(date('Y-m-d')), 'd-m-Y');

		$this->prefijomaestro = $this->funciones->prefijomaestra();
		// $this->fechaactual = date('Y-m-d h:i:s');
		$this->fechaactual = date('Y-m-d h:i:s');
		$this->hoy = date_format(date_create(date('Ymd h:i:s')), 'Ymd h:i:s');
		// $this->fecha_sin_hora 	= date('d-m-Y');
		$this->fecha_sin_hora 			= date('Y-m-d');
		$this->fechacrea = date('Ymd');
		$this->emailde = 'puca.cix.peru@gmail.com';
	}

}
