<?php
namespace App\Biblioteca;

use Illuminate\Support\Facades\DB;
use Hashids,Session,Redirect,table;
use App\Modelos\Grupoopcion;
use App\Modelos\Opcion;
use App\Modelos\Rol;
use App\Modelos\Rolopcion;
use App\User;
use Keygen;
use PDO;

class Funcion {

	public function getUrl($idopcion, $accion) {

		//decodificar variable
		$decidopcion = Hashids::decode($idopcion);
		//ver si viene con letras la cadena codificada
		if (count((array)$decidopcion) == 0) {
			return Redirect::back()->withInput()->with('errorurl', 'Indices de la url con errores');
		}

		// ver si la opcion existe
	  	$opcion =  RolOpcion::where('opcion_id', '=',$decidopcion)
			->where('rol_id', '=', Session::get('usuario')->rol_id)
			->where($accion, '=', 1)
			->first();

		if (count((array)$opcion) <= 0) {

			return Redirect::back()->withInput()->with('errorurl', 'No tiene autorización para ' . $accion . ' aquí');
		}
		return 'true';

	}

	public function getCreateIdMaestra($tabla) {

		$id = "";
		// maximo valor de la tabla referente
		$id = DB::table($tabla)
			->select(DB::raw('max(SUBSTRING(id,5,8)) as id'))
			->first();
		//conversion a string y suma uno para el siguiente id
		$idsuma = (int) $id->id + 1;
		//concatenar con ceros
		$idopcioncompleta = str_pad($idsuma, 8, "0", STR_PAD_LEFT);
		//concatenar prefijo
		$prefijo = $this->prefijomaestra();
		$idopcioncompleta = $prefijo . $idopcioncompleta;
		return $idopcioncompleta;

	}

	public function prefijomaestra() {

		$prefijo = '1CIX';
		return $prefijo;
	}


	public function decodificar($id) {

	  	//decodificar variable
	  	$iddeco = Hashids::decode($id);
	  	//ver si viene con letras la cadena codificada
	  	if(count((array)$iddeco)==0){ 
	  		return ''; 
	  	}
	  	return $iddeco[0];

	}

	public function decodificarmaestra($id) {

		//decodificar variable
		$iddeco = Hashids::decode($id);
	  	if(count((array)$iddeco)==0){ 
	  		return ''; 
	  	}
	  	return $iddeco[0];

	}
	
}
