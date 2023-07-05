<?php

namespace App\Http\Controllers;

use App\Modelos\Grupoopcion;
use App\Modelos\Opcion;
use App\Modelos\Rol;
use App\Modelos\RolOpcion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use View;

class UserController extends Controller {


	public function actionLogin(Request $request) {

		if ($_POST) {
			/**** Validaciones laravel ****/
			$this->validate($request, [
				'name' => 'required',
				'password' => 'required',

			], [
				'name.required' => 'El campo Usuario es obligatorio',
				'password.required' => 'El campo Clave es obligatorio',
			]);

			/**********************************************************/

			$usuario = strtoupper($request['name']);
			$clave = strtoupper($request['password']);
			$local_id = $request['local_id'];

			$tusuario = User::whereRaw('UPPER(name)=?', [$usuario])
				->where('activo', '=', 1)
				->first();

			if (count($tusuario) > 0) {

				$clavedesifrada = strtoupper(Crypt::decrypt($tusuario->password));

				if ($clavedesifrada == $clave) {

					$listamenu = Grupoopcion::join('opciones', 'opciones.grupoopcion_id', '=', 'grupoopciones.id')
						->join('rolopciones', 'rolopciones.opcion_id', '=', 'opciones.id')
						->where('grupoopciones.activo', '=', 1)
						->where('rolopciones.rol_id', '=', $tusuario->rol_id)
						->where('rolopciones.ver', '=', 1)
						->groupBy('grupoopciones.id')
						->groupBy('grupoopciones.nombre')
						->groupBy('grupoopciones.icono')
						->groupBy('grupoopciones.orden')
						->select('grupoopciones.id', 'grupoopciones.nombre', 'grupoopciones.icono', 'grupoopciones.orden')
						->orderBy('grupoopciones.orden', 'asc')
						->get();

					$listaopciones = RolOpcion::where('rol_id', '=', $tusuario->rol_id)
						->where('ver', '=', 1)
						->orderBy('orden', 'asc')
						->pluck('opcion_id')
						->toArray();

					Session::put('usuario', $tusuario);
					Session::put('listamenu', $listamenu);
					Session::put('listaopciones', $listaopciones);

					return Redirect::to('bienvenido');

				} else {
					return Redirect::back()->withInput()->with('errorbd', 'Usuario o clave incorrecto');
				}
			} else {
				return Redirect::back()->withInput()->with('errorbd', 'Usuario o clave incorrecto');
			}

		} else {
			return view('usuario.login');
		}
	}

	public function actionCerrarSesion() {
		Session::forget('usuario');
		Session::forget('listamenu');
		Session::forget('listaopciones');
		return Redirect::to('/login');

	}

	public function actionBienvenido() {
		return View::make('bienvenido');
	}

	public function actionListarUsuarios($idopcion) {
		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Ver');

		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/
		$listausuarios = User::where('id', '<>', $this->prefijomaestro . '00000001')->orderBy('id', 'asc')->get();

		return View::make('usuario/listausuarios',
			[
				'listausuarios' => $listausuarios,
				'idopcion' => $idopcion,
			]);
	}

	public function actionAgregarUsuario($idopcion, Request $request) {
		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Anadir');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/

		if ($_POST) {

			/**** Validaciones laravel ****/
			$this->validate($request, [
	            'name' => 'unique:users',
			], [
            	'name.unique' => 'Usuario ya registrado',
        	]);
			/******************************/



			$idusers = $this->ge_getNuevoId('users');

			$cabecera = new User;
			$cabecera->id = $idusers;
			$cabecera->nombre = $request['nombre'];
			$cabecera->apellido = $request['apellido'];
			$cabecera->name = $request['name'];
			$cabecera->password = Crypt::encrypt($request['password']);
			$cabecera->rol_id = $request['rol_id'];
			$cabecera->created_at=$this->fechaactual;
			$cabecera->save();


			return Redirect::to('/gestion-de-usuarios/' . $idopcion)->with('bienhecho', 'Usuario ' . $request['nombre'] . ' registrado con exito');

		} else {

			$rol = DB::table('Rols')->where('id', '<>', $this->prefijomaestro . '00000001')->pluck('nombre', 'id')->toArray();
			$comborol = array('' => "Seleccione Rol") + $rol;

			return View::make('usuario/agregarusuario',
				[
					'comborol' => $comborol,
					'idopcion' => $idopcion,
				]);
		}
	}

	public function actionModificarUsuario($idopcion, $idusuario, Request $request) {

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Modificar');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/
		$idusuario = $this->funciones->decodificarmaestra($idusuario);

		if ($_POST) {

			$cabecera = User::find($idusuario);
			$cabecera->nombre 		= 	$request['nombre'];
			$cabecera->apellido 	= 	$request['apellido'];
			$cabecera->name 		= 	$request['name'];
			$cabecera->password 	= 	Crypt::encrypt($request['password']);
			$cabecera->activo 		= 	$request['activo'];
			$cabecera->rol_id 		= 	$request['rol_id'];
			$cabecera->updated_at	=	$this->fechaactual;
			$cabecera->save();

			return Redirect::to('/gestion-de-usuarios/' . $idopcion)->with('bienhecho', 'Usuario ' . $request['nombre'] . ' modificado con exito');

		} else {

			$usuario = User::where('id', $idusuario)->first();
			$rol = DB::table('Rols')->where('id', '<>', $this->prefijomaestro . '00000001')->pluck('nombre', 'id')->toArray();


			$comborol = array($usuario->rol_id => $usuario->rol->nombre) + $rol;
			$funcion = $this;

			return View::make('usuario/modificarusuario',
				[
					'usuario' => $usuario,
					'comborol' => $comborol,
					'idopcion' => $idopcion,
					'funcion' => $funcion,
				]);
		}
	}

	public function actionListarRoles($idopcion) {

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Ver');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/

		$listaroles = Rol::where('id', '<>', $this->prefijomaestro . '00000001')->orderBy('id', 'asc')->get();

		return View::make('usuario/listaroles',
			[
				'listaroles' => $listaroles,
				'idopcion' => $idopcion,
			]);

	}

	public function actionAgregarRol($idopcion, Request $request) {
		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Anadir');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/

		if ($_POST) {

			/**** Validaciones laravel ****/

			$this->validate($request, [
				'nombre' => 'unique:rols',
			], [
				'nombre.unique' => 'Rol ya registrado',
			]);

			/******************************/
			$idrol = $this->ge_getNuevoId('rols');

			$cabecera = new Rol;
			$cabecera->id = $idrol;
			$cabecera->nombre = $request['nombre'];
			$cabecera->save();

			$listaopcion = Opcion::orderBy('id', 'asc')->get();
			$count = 1;
			foreach ($listaopcion as $item) {

				$idrolopciones = $this->ge_getNuevoId('rolopciones');

				$detalle = new RolOpcion;
				$detalle->id = $idrolopciones;
				$detalle->opcion_id = $item->id;
				$detalle->rol_id = $idrol;
				$detalle->orden = $count;
				$detalle->ver = 0;
				$detalle->anadir = 0;
				$detalle->modificar = 0;
				$detalle->eliminar = 0;
				$detalle->todas = 0;
				
				$detalle->save();
				$count = $count + 1;
			}

			return Redirect::to('/gestion-de-roles/' . $idopcion)->with('bienhecho', 'Rol ' . $request['nombre'] . ' registrado con exito');
		} else {

			return View::make('usuario/agregarrol',
				[
					'idopcion' => $idopcion,
				]);

		}
	}

	public function actionModificarRol($idopcion, $idrol, Request $request) {

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Modificar');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/
		$idrol = $this->funciones->decodificarmaestra($idrol);

		if ($_POST) {

			/**** Validaciones laravel ****/
			$this->validate($request, [
	            'nombre' => 'unique:rols,nombre,'.$idrol.',id',
			], [
            	'nombre.unique' => 'Rol ya registrado',
        	]);

			/******************************/

			$cabecera = Rol::find($idrol);
			$cabecera->nombre = $request['nombre'];
			$cabecera->activo = $request['activo'];
			$cabecera->save();

			return Redirect::to('/gestion-de-roles/' . $idopcion)->with('bienhecho', 'Rol ' . $request['nombre'] . ' modificado con éxito');

		} else {
			$rol = Rol::where('id', $idrol)->first();

			return View::make('usuario/modificarrol',
				[
					'rol' => $rol,
					'idopcion' => $idopcion,
				]);
		}
	}

	public function actionListarPermisos($idopcion) {

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Ver');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/

		$listaroles = Rol::where('id', '<>', $this->prefijomaestro . '00000001')->orderBy('id', 'asc')->get();

		return View::make('usuario/listapermisos',
			[
				'listaroles' => $listaroles,
				'idopcion' => $idopcion,
			]);
	}

	public function actionAjaxListarOpciones(Request $request) {
		$idrol = $request['idrol'];
		$idrol = $this->funciones->decodificarmaestra($idrol);

		$listaopciones = RolOpcion::where('rol_id', '=', $idrol)->get();

		return View::make('usuario/ajax/listaopciones',
			[
				'listaopciones' => $listaopciones,
			]);
	}

	public function actionAjaxActivarPermisos(Request $request) {

		$idrolopcion = $request['idrolopcion'];
		$idrolopcion = $this->funciones->decodificarmaestra($idrolopcion);

		$cabecera = RolOpcion::find($idrolopcion);
		$cabecera->ver = $request['ver'];
		$cabecera->anadir = $request['anadir'];
		$cabecera->modificar = $request['modificar'];
		$cabecera->todas = $request['todas'];
		$cabecera->save();

		echo ("gmail");

	}


	
	/////////////////////////////////////////////////////////////////////////////////////////
	////	SECCION GRUPO OPCIONES
	/////////////////////////////////////////////////////////////////////////////////////////
	
	public function actionListarGrupoOpciones($idopcion) {

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Ver');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/

		View::share('titulo','Lista de Grupo Opciones');
		$listadatos = Grupoopcion::where('activo','=',1)->orderBy('orden', 'asc')->get();

		return View::make('usuario/listagrupoopciones',
			[
				'listadatos' => $listadatos,
				'idopcion' => $idopcion,
			]);

	}

	public function actionModificarGrupoOpcion($idopcion,$idregistro,Request $request)
	{

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Modificar');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/
	    $registro_id = $this->funciones->decodificar($idregistro);

	    View::share('titulo','Modificar Grupo Opcion');

		if($_POST)
		{

			/**** Validaciones laravel ****/
			$this->validate($request, [
	            'nombre' => 'unique:grupoopciones,nombre,'.$registro_id.',id',
			], [
            	'nombre.unique' => 'Grupoopcion ya registrado',
        	]);

			/******************************/

			$cabecera            	 =	Grupoopcion::find($registro_id);
			$cabecera->nombre 	     =  $request['nombre'];
			$cabecera->activo 	 	 =  $request['activo'];			
			$cabecera->icono 	 	 =  $request['icono'];			
			$cabecera->save();


 			return Redirect::to('/gestion-de-grupoopciones/'.$idopcion)->with('bienhecho', 'Rol '.$request['nombre'].' modificado con exito');

		}else{

				$registro = Grupoopcion::where('id', $registro_id)->first();
		        return View::make('usuario/modificargrupoopcion', 
		        				[
		        					'registro'  => $registro,
						  			'idopcion' => $idopcion
		        				]);
		}

	}

	public function actionAgregarGrupoOpcion($idopcion,Request $request)
	{

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Anadir');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/
		View::share('titulo','Agregar Grupo Opcion');
		if($_POST)
		{
			/**** Validaciones laravel ****/

			$this->validate($request, [
	            'nombre' => 'unique:grupoopciones',
			], [
            	'nombre.unique' => 'Grupoopcion ya registrado',
        	]);

			/******************************/
			$orden  				 =(int) Grupoopcion::count()+1;	
			$cabecera            	 =	new Grupoopcion;
			$cabecera->nombre 	     =  $request['nombre'];
			$cabecera->icono 	     =  $request['icono'];
			$cabecera->orden 	     =  $orden;
			$cabecera->save();


			// $listaopcion = Opcion::orderBy('id', 'asc')->get();
			// $count = 1;
			// foreach($listaopcion as $item){
			//     $detalle            =	new Rolopcion;
			// 	$detalle->opcion_id = 	$item->id;
			// 	$detalle->rol_id    =  	$cabecera->id;
			// 	$detalle->orden     =  	$count;
			// 	$detalle->ver       =  	0;
			// 	$detalle->anadir    =  	0;
			// 	$detalle->modificar =  	0;
			// 	$detalle->eliminar  =  	0;
			// 	$detalle->todas     = 	0;
			// 	$detalle->save();
			// 	$count 				= 	$count +1;

			// }

 			return Redirect::to('/gestion-de-grupoopciones/'.$idopcion)->with('bienhecho', 'Grupo Opcion '.$request['nombre'].' registrado con exito');

		}else{

			return View::make('usuario/agregargrupoopcion',
						[
						  	'idopcion' => $idopcion
						]);
		}
	}


	/////////////////////////////////////////////////////////////////////////////////////////
	////	SECCION OPCIONES
	/////////////////////////////////////////////////////////////////////////////////////////
	public function actionListarOpciones($idopcion) {

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Ver');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/

		View::share('titulo','Lista de Opciones');
		$listadatos = Opcion::where('activo','=','1')->orderBy('id', 'asc')->get();

		return View::make('usuario/listaopciones',
			[
				'listadatos' => $listadatos,
				'idopcion' => $idopcion,
			]);

	}
	
	public function actionAgregarOpcion($idopcion,Request $request)
	{

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Anadir');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/
	    View::share('titulo','Agregar Opcion');

		if($_POST)
		{


			/**** Validaciones laravel ****/
			$this->validate($request, [
	            'name' => 'unique:opciones',
	            'pagina' => 'unique:opciones',

			], [
            	'name.unique' => 'Opcion ya registrada',
            	'pagina.unique' => 'Pagina ya registrado',
            	
        	]);

			/******************************/

			$cabecera            	 	=	new Opcion;
			$cabecera->nombre 	     	=   $request['nombre'];
			$cabecera->descripcion 	 	=   $request['descripcion'];
			$cabecera->pagina 	 		= 	$request['pagina'];
			$cabecera->grupoopcion_id   =	$request['grupoopcion_id'];

			$listaroles 	=	Rol::get();
			// IDENT_CURRENT('nombre_tabla')

			$idgenerado = '';
			$consulta = Opcion::select('id')->orderBy('id','desc')->first();
			if(count($consulta)>0 && !empty($consulta)){
				$idgenerado = (int)$consulta->id +1;
			}

			$orden=0;
			$consultaorden = Rolopcion::selectRaw("MAX(orden) as orden")->first();
			if(count($consultaorden)>0 && !empty($consultaorden)){
				$orden = (int)$consultaorden->orden+1;
			}
			$cont= 0;
			foreach ($listaroles as $index => $rol) {
				$rolopcion 				=	new Rolopcion;
				$rolopcion->opcion_id 	= 	$idgenerado;
				$rolopcion->rol_id    	=  	$rol->id;
				$rolopcion->orden     	=  	$orden;
				if($cont==0){
					$rolopcion->ver       	=  	1;
					$rolopcion->anadir    	=  	1;
					$rolopcion->modificar 	=  	1;
					$rolopcion->eliminar  	=  	1;
					$rolopcion->todas     	= 	1;
				}
				else{

					$rolopcion->ver       	=  	0;
					$rolopcion->anadir    	=  	0;
					$rolopcion->modificar 	=  	0;
					$rolopcion->eliminar  	=  	0;
					$rolopcion->todas     	= 	0;
				}
				$cont++;
				$rolopcion->save();
			}



			$cabecera->save();

 
 			return Redirect::to('/gestion-de-opciones/'.$idopcion)->with('bienhecho', 'Opcion '.$request['nombre'].' '.$request['pagina'].' registrada con exito: Recuerde volver a iniciar sesion para ver las opciones nuevas');


		}else{


			$grupoopcion 		= DB::table('grupoopciones')->where('activo','=',1)->pluck('nombre','id')->toArray();
			$combogrupoopcion  	= array('' => "Seleccione Grupo Opcion") + $grupoopcion;

			return View::make('usuario/agregaropcion',
						[
							'combogrupoopcion' => $combogrupoopcion,
						  	'idopcion' => $idopcion
						]);
		}

	}

	public function actionModificarOpcion($idopcion,$idregistro,Request $request)
	{

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Modificar');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/

	    $registro_id = $this->funciones->decodificar($idregistro);
		if($_POST)
		{

			/**** Validaciones laravel ****/
			$this->validate($request, [
	            'name' => 'unique:opciones,name,'.$registro_id.',id',
	            // 'pagina' => 'unique:opciones,pagina,'.$registro_id.',id',

			], [
            	'name.unique' => 'Opcion ya registrada',
            	// 'pagina.unique' => 'Pagina ya registrado',
        	]);

			/******************************/

			$cabecera            	 	=	Opcion::find($registro_id);
			$cabecera->nombre 	     	=  	$request['nombre'];
			$cabecera->descripcion 	 	= 	$request['descripcion'];
			// $cabecera->name  		 =	$request['name'];
			// $cabecera->email 	 	 =  $request['email'];
			// $cabecera->password 	 = 	Crypt::encrypt($request['password']);
			$cabecera->activo 	 	 	=  	$request['activo'];			
			$cabecera->grupoopcion_id	= 	$request['grupoopcion_id'];
			$cabecera->save();


 			return Redirect::to('/gestion-de-opciones/'.$idopcion)->with('bienhecho', 'Opcion '.$request['nombre'].' modificada con exito');

		}else{

				$opcion 	= Opcion::where('id', $registro_id)->first();
				$grupoopcion 		= DB::table('grupoopciones')->where('activo','=',1)->pluck('nombre','id')->toArray();
				$combogrupoopcion  	= array($opcion->grupoopcion_id => $opcion->grupoopcion->nombre) + $grupoopcion;

		        return View::make('usuario/modificaropcion', 
		        				[
		        					'registro'  			=> $opcion,
									'combogrupoopcion' 	=> $combogrupoopcion,
						  			'idopcion' 			=> $idopcion
		        				]);
		}

	}



	/////////////////////////////////////////////////////////////////////////////////////////

}
