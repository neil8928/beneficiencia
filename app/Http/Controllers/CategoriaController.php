<?php

namespace App\Http\Controllers;

use App\Modelos\Grupoopcion;
use App\Modelos\Opcion;
use App\Modelos\Rol;
use App\Modelos\RolOpcion;
use App\Modelos\Detalleconcepto;
use App\Modelos\Concepto;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use View;

class CategoriaController extends Controller {



	public function actionListarCategoria($idopcion) {

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Ver');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/
		print_r("cambio");

		$concepto= DB::table('conceptos')->where('activo', '=', 1)->pluck('nombre', 'id')->toArray(); 
		$comboconcepto = array('' => 'Todos') + $concepto;
		$funcion = $this;

		$listadetalle = detalleconcepto::join('conceptos','conceptos.id','=','detalleconceptos.concepto_id')
						->select('detalleconceptos.*','conceptos.nombre as nombreconcepto')
						->orderby('conceptos.nombre','asc')
						->get();

		return View::make('categoria/listacategoria',
			[
				'comboconcepto' => $comboconcepto,
				'listadetalle' => $listadetalle,
				'idopcion' => $idopcion,
			]);


	}


	public function actionAjaxDetalleConcepto(Request $request) {

		$concepto_id = $request['concepto_id'];
		$idopcion = $request['idopcion'];

		$listadetalle = detalleconcepto::join('conceptos','conceptos.id','=','detalleconceptos.concepto_id')
						->where('conceptos.id','=',$concepto_id )
						->select('detalleconceptos.*','conceptos.nombre as nombreconcepto')
						->orderby('conceptos.nombre','asc')
						->get();

		return View::make('categoria/ajax/alistacategoria',
			[
				'listadetalle' => $listadetalle,
				'idopcion' => $idopcion,
				'ajax'     =>  true
			]);


	}



	public function actionAgregarConcepto($idopcion, Request $request) {

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Anadir');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/


		if ($_POST) {

			$cabecera = new Detalleconcepto;

			$cabecera->concepto_id = $request['concepto_id'];
			$cabecera->nombre = $request['name'];
			$cabecera->created_at=$this->fechaactual;
			$cabecera->save();


			return Redirect::to('/gestion-categorias/' . $idopcion)->with('bienhecho', 'Detalle concepto' . $request['name'] . ' registrado con exito');

		} else {


			$concepto= DB::table('conceptos')->where('activo', '=', 1)->pluck('nombre', 'id')->toArray(); 
			$comboconcepto = array('' => 'Seleccione categoria') + $concepto;
			$funcion = $this;

			$listadetalle = Detalleconcepto::join('conceptos','conceptos.id','=','detalleconceptos.concepto_id')
							->select('detalleconceptos.*','conceptos.nombre as nombreconcepto')
							->orderby('conceptos.nombre','asc')
							->get();

			return View::make('categoria/creaconcepto',
				[
					'comboconcepto' => $comboconcepto,
					'listadetalle' => $listadetalle,
					'idopcion' => $idopcion,
				]);

		}
	}


	public function actionModificarconcepto($idopcion, $iddetconcepto, Request $request) {

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Modificar');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/
		$iddetconcepto = $this->funciones->decodificarmaestra($iddetconcepto);

		if ($_POST) {

			$cabecera = Detalleconcepto::find($iddetconcepto);
			$cabecera->nombre 		= 	$request['nombre'];
			$cabecera->activo 		= 	$request['activo'];
			$cabecera->updated_at	=	$this->fechaactual;
			$cabecera->save();

			return Redirect::to('/gestion-categorias/' . $idopcion)->with('bienhecho', 'Detalle Concepto' . $request['nombre'] . ' modificado con exito');

		} else {


			$detalleconcepto 	= 	Detalleconcepto::where('id','=',$iddetconcepto)->first();
			$concepto 			= 	Concepto::where('id','=',$detalleconcepto->concepto_id)->first();

			$funcion = $this;

			return View::make('categoria/modificarconcepto',
				[
					'detalleconcepto' => $detalleconcepto,
					'concepto' => $concepto,
					'idopcion' => $idopcion,
					'funcion' => $funcion,
				]);
		}

	}
}

	
