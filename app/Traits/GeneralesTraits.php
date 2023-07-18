<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use App\Modelos\WEBCuentaContable;
use App\Modelos\ALMProducto;

use App\Modelos\Departamento;
use App\Modelos\Provincia;
use App\Modelos\Distrito;
use App\Modelos\Rol;
use App\Modelos\Concepto;
use App\Modelos\Detalleconcepto;
use App\Modelos\Beneficiario;
use App\Modelos\Familiar;
use App\Modelos\SaludBeneficiario;
use App\Modelos\SaludFamiliar;
use App\Modelos\SaludMortalidad;
use App\Modelos\ActividadEconomica;
use App\Modelos\DocumentosFicha;
use App\Modelos\Ilogs;
use App\Modelos\HistorialFicha;
use App\Modelos\OtroIngreso;
use App\Modelos\Estado;
use App\Modelos\FichaSocioEconomica;

use App\Modelos\Vivienda;
use App\Modelos\Observacion;

use App\User;
use App\Modelos\ConvivenciaFamiliar;
use App\Modelos\Beneficio;
use App\Modelos\Permanencia;


use stdClass;
use View;
use Session;
use Hashids;
Use Nexmo;
use Keygen;

trait GeneralesTraits
{

	public function ge_permanencia_anio($edad)
	{
		$anio = 0;
		$permanencia = 	Permanencia::where('edadmin','<=',$edad)
						->where('edadmax','>=',$edad)->first();

		if(count($permanencia)>0){
			$anio 	= $permanencia->anios;
		}
		return $anio;
	}

	public function ge_permanencia_mes($edad)
	{
		$mes = 0;
		$permanencia = 	Permanencia::where('edadmin','<=',$edad)
						->where('edadmax','>=',$edad)->first();

		if(count($permanencia)>0){
			$mes 	= $permanencia->meses;
		}
		return $mes;
	}

	public function ge_permanencia_dias($edad)
	{
		$dias = 0;
		$permanencia = 	Permanencia::where('edadmin','<=',$edad)
						->where('edadmax','>=',$edad)->first();

		if(count($permanencia)>0){
			$dias 	= $permanencia->dias;
		}
		return $dias;
	}

	public function ge_getComboBeneficiarioClonar($idregistro){
		$datos 		=	[];
		$cadena 	=	[''=>'Seleccione Opcion'];
		$datos 		= !is_null($idregistro)?Beneficiario::where('ficha_id','<>',$idregistro)
											->where('activo','=',1)
											->selectRaw("CONCAT(apellidopaterno,' ',apellidomaterno,' ',nombres) as nombrebeneficiario,id")->pluck('nombrebeneficiario','id')->toArray():NULL;
		return 	$cadena + $datos;
	}


	public function ge_textdetallecategoria($iddetalle){

		$text = '';

		$det = Detalleconcepto::where('id','=', $iddetalle)
                            ->first();
        if(count($det)>0){
			$text = $det->nombre;
        }

		return $text;
	}

	public function ge_getObservacion($tab,$idregistro){

		$observacion = '';

		$obs = Observacion::where('tab_observacion','=', $tab)
                            ->where('ficha_id','=', $idregistro)
                            ->first();
        if(count($obs)>0){
			$observacion = $obs->observacion;
        }

		return $observacion;
	}


	public function ge_getListaBeneficios($idregistro){
		$datos 		= !is_null($idregistro)?Beneficio::where('ficha_id','=',$idregistro)
						->where('activo','=',1)->orderby('nombrefamiliar','asc')->get():NULL;
		return $datos;
	}

	public function ge_guardarconvivenciafamiliar($concepto,$user_id,$registro_id,$select){
        //////////////////  Vivienda  ///////////////////
            ConvivenciaFamiliar::where('concepto','=', $concepto)
                      ->where('ficha_id','=', $registro_id)
                      ->update([
                                'activo' => 0,
                                'usermod'=>$user_id,
                                'fechamod'=>date('Ymd')
                               ]);
            $viviendas  =   ConvivenciaFamiliar::where('concepto','=', $concepto)
                                ->where('ficha_id','=', $registro_id)
                                ->pluck('conceptodetalle_id')
                                ->toArray();


            if(count($select)>0){
            foreach($select as $item=>$id)
            {

                $detalleconcepto =   Detalleconcepto::where('id','=',$id)->first();

                if (in_array($id, $viviendas)) {

                    $vivienda                   =   ConvivenciaFamiliar::where('concepto','=', $concepto)
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('conceptodetalle_id','=',$id)->first();
                    $cabecera                   =   ConvivenciaFamiliar::find($vivienda->id);            
                    $cabecera->activo           =   1;
                    $cabecera->usermod          =   $user_id;
                    $cabecera->fechamod         =   date('Ymd');          
                    $cabecera->save();

                }else{

                    $cabecera                           =   new ConvivenciaFamiliar;
                    $cabecera->ficha_id                 =   $registro_id;
                    $cabecera->concepto                 =   $concepto;
                    $cabecera->conceptodetalle_id      	=   $id;
                    $cabecera->nombreconceptodetalle   	=   $detalleconcepto->nombre;
                    $cabecera->usercrea                 =   $user_id;
                    $cabecera->fechacrea                =   date('Ymd');
                    $cabecera->save();

                }
            }            	
            }


        return true;

	}


	public function ge_getlistaConceptos($codigoconcepto){
		$consulta 	=	Concepto::where('codigo','=',$codigoconcepto)->first();
		$detalle 	=	Detalleconcepto::where('concepto_id','=',$consulta->id)->get();
		return $detalle;
	}

	public function ge_guardarvivienda($concepto,$user_id,$registro_id,$select){
        //////////////////  Vivienda  ///////////////////
            Vivienda::where('concepto','=', $concepto)
                      ->where('ficha_id','=', $registro_id)
                      ->update([
                                'activo' => 0,
                                'usermod'=>$user_id,
                                'fechamod'=>date('Ymd')
                               ]);
            $viviendas  =   Vivienda::where('concepto','=', $concepto)
                                ->where('ficha_id','=', $registro_id)
                                ->pluck('materialvivienda_id')
                                ->toArray();


            if(count($select)>0){
            foreach($select as $item=>$id)
            {

                $detalleconcepto =   Detalleconcepto::where('id','=',$id)->first();

                if (in_array($id, $viviendas)) {

                    $vivienda                   =   Vivienda::where('concepto','=', $concepto)
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('materialvivienda_id','=',$id)->first();
                    $cabecera                   =   Vivienda::find($vivienda->id);            
                    $cabecera->activo           =   1;
                    $cabecera->usermod          =   $user_id;
                    $cabecera->fechamod         =   date('Ymd');          
                    $cabecera->save();

                }else{

                    $cabecera                           =   new Vivienda;
                    $cabecera->ficha_id                 =   $registro_id;
                    $cabecera->concepto                 =   $concepto;
                    $cabecera->materialvivienda_id      =   $id;
                    $cabecera->nombrematerialvivienda   =   $detalleconcepto->nombre;
                    $cabecera->usercrea                 =   $user_id;
                    $cabecera->fechacrea                =   date('Ymd');
                    $cabecera->save();

                }
            }            	
            }


        return true;

	}

	
	private function ge_url()
	{
		$url 			=       'http://localhost:8080/puca/public/';
		return $url;
	}
	private function gn_generacion_combo_array($titulo, $todo , $array)
	{
		if($todo=='TODO'){
			$combo_anio_pc  		= 	array('' => $titulo , $todo => $todo) + $array;
		}else{
			$combo_anio_pc  		= 	array('' => $titulo) + $array;
		}
	    return $combo_anio_pc;
	}

	public function ge_existe_imagen($dni)
	{
		$foto_perfil 		= 		'foto_default1.jpg';

		$mi_imagen = public_path().'/img/fotografias/'.$dni.'.jpg';

	    if (file_exists($mi_imagen)) {
	        $foto_perfil 		= 	$dni.'.jpg';
	    } 


		return $foto_perfil;

	}
	private function gn_generacion_combo($tabla,$atributo1,$atributo2,$titulo,$todo) {
		
		$array 						= 	DB::table($tabla)
        								->where('activo','=',1)
		        						->pluck($atributo2,$atributo1)
										->toArray();

		if($todo=='TODO'){
			$combo  				= 	array('' => $titulo , $todo => $todo) + $array;
		}else{
			$combo  				= 	array('' => $titulo) + $array;
		}

	 	return  $combo;					 			
	}
	public function ge_obtener_fecha_letra($fecha){
	    $dia= $this->conocerDiaSemanaFecha($fecha);
	    $num = date("j", strtotime($fecha));
	    $anno = date("Y", strtotime($fecha));
	    $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
	    $mes = $mes[(date('m', strtotime($fecha))*1)-1];
	    return $dia.', '.$num.' de '.$mes.' del '.$anno;
	}

	public function conocerDiaSemanaFecha($fecha) {
	    $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
	    $dia = $dias[date('w', strtotime($fecha))];
	    return $dia;
	}
	
	public function ge_crearCarpetaSiNoExiste($ruta){
		$valor = false;
		
		if (!file_exists($ruta)) {
		    mkdir($ruta, 0777, true);
		    $valor=true;
		}
		return $valor;
	}

	public function ge_getNuevoId($tabla){
		$idnuevo 	=	0;
		$consulta 	=	DB::table($tabla)->select(DB::raw('max(id) as id'))->get();
        $idnuevo 	= 	(int)$consulta[0]->id + 1;
		return $idnuevo;
	}
	
	private function gn_generacion_combo_tabla_osiris($tabla,$atributo1,$atributo2,$titulo,$todo) {
		
		$array 							= 	DB::table($tabla)
        									->where('COD_ESTADO','=',1)
		        							->pluck($atributo2,$atributo1)
											->toArray();
		if($titulo==''){
			$combo  					= 	$array;
		}else{
			if($todo=='TODO'){
				$combo  				= 	array('' => $titulo , $todo => $todo) + $array;
			}else{
				$combo  				= 	array('' => $titulo) + $array;
			}
		}

	 	return  $combo;					 			
	}

	public function ge_getMensajeError($error,$sw=true)
	{
		$mensaje = ($sw==true)?'Ocurrio un error Inesperado':'';
        if($this->ge_isUsuarioAdmin()){
            if(isset($error)){
                $mensaje=$mensaje.': '.$error;
            }
        }
        return $mensaje;
	}
	private function gn_generacion_combo_categoria($txt_grupo,$titulo,$todo) {
		
		$array 						= 	DB::table('CMP.CATEGORIA')
        								->where('COD_ESTADO','=',1)
        								->where('TXT_GRUPO','=',$txt_grupo)
		        						->pluck('NOM_CATEGORIA','COD_CATEGORIA')
										->toArray();

		if($todo=='TODO'){
			$combo  				= 	array('' => $titulo , $todo => $todo) + $array;
		}else{
			$combo  				= 	array('' => $titulo) + $array;
		}

	 	return  $combo;					 			
	}

		
    public function ge_isUsuarioAdmin()
    {
        $valor=false;
        if(Session::get('usuario')->id==1){
            $valor=true;
        }
        return $valor;
    }

    public function mostrarValor($dato)
    {
        if($this->ge_isUsuarioAdmin()){
            dd($dato);
        }
    }

	public function gn_background_fila_activo($activo)
	{
		$background =	'';
		if($activo == 0){
			$background = 'fila-desactivada';
		}
	    return $background;
	}

	public function nombremes($mes){
 		setlocale(LC_TIME, 'spanish');  
		$nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
 		return $nombre;
	}

	public function gn_combo_tipo_cliente()
	{
		$combo  	= 	array('' => 'Seleccione tipo de cliente' , '0' => 'Tercero', '1' => 'Relacionada');
	    return $combo;
	}

	public function rp_generacion_combo_resultado_control($titulo)
	{
		$combo  	= 	array('' => $titulo , '1' => 'Nueva Cita', '2' => 'Resultado');
	    return $combo;
	}

	public function rp_sexo_paciente($sexo_letra)
	{
		$sexo = 'Femenino';
		if($sexo_letra == 'M'){
			$sexo = 'Maculino';
		}
	    return $sexo;
	}	

	public function rp_tipo_cita($ind_tipo_cita)
	{
		$tipo_cita = 'Nueva Cita';
		if($ind_tipo_cita == 2){
			$tipo_cita = 'Resultado';
		}
	    return $tipo_cita;
	}	
	public function rp_estado_control($ind_atendido)
	{
		$estado = 'Atendido';
		if($ind_atendido == 0){
			$estado = 'Sin atender';
		}
	    return $estado;
	}	

	public function getDatosTablas($nombretabla,$campo,$valor)
	{    
	        $tabla 	=	null;
	        $tabla 	= 	DB::table($nombretabla)->where($campo,'=',$valor)->first();
	        $rpta 	= 	!empty($tabla)?$tabla->id : 0;
	        return $rpta;   
	}


	private function gn_generacion_combo_productos($titulo,$todo)
	{


		$array 						= 	ALMProducto::where('COD_ESTADO','=',1)
										->whereIn('IND_MATERIAL_SERVICIO', ['M','S'])
		        						->pluck('NOM_PRODUCTO','COD_PRODUCTO')
		        						->take(10)
										->toArray();

		if($todo=='TODO'){
			$combo  				= 	array('' => $titulo , $todo => $todo) + $array;
		}else{
			$combo  				= 	array('' => $titulo) + $array;
		}

	 	return  $combo;	
	}


	private function gn_generacion_combo_unidad()
	{
		$combo  	= 	array('' => 'Seleccione Unidad' , 
								'0' => 'AM', 
								'1' => 'TB',
								'2' => 'FR'
								);
	 	return  $combo;	
	}

	private function gn_generacion_combo_medicamentos($titulo,$todo='')
	{
		$array 						= 	DB::table('medicamentos')->where('activo','=',1)
		        						->selectRaw("concat(descripcion,' - UND( ',unidad,' )') as descripcion,id")
		        						->pluck('descripcion','id')
										->toArray();
		if($todo=='TODO'){
			$combo  				= 	array('' => $titulo , $todo => $todo) + $array;
		}else{
			$combo  				= 	array('' => $titulo) + $array;
		}
	 	return  $combo;	
	}


	private function gn_generacion_combo_dosificacion($titulo,$todo='')
	{
		$array 		= 	array(
							'0'=>'NINGUNO',
							'1'=>'C / 8 HORAS',
							'2'=>'C / 12 HORAS',
							'3'=>'C / 24 HORAS'
						);

		$combo  	= 	array('' => $titulo) + $array;
		
		return  $combo;	
	}


	private function gn_generacion_combo_unidad_medicamentos()
	{

		$combo  	= 	array(
					'AM' => 'AM',
					'FR' => 'FR',
					'TB' => 'TB',
				);

		return  $combo;	
	}

	private function gn_generacion_combo_examenes($titulo,$todo='')
	{
		$array 						= 	DB::table('examenes')->where('activo','=',1)
		        						->pluck('descripcion','id')
										->toArray();
		if($todo=='TODO'){
			$combo  				= 	array('' => $titulo , $todo => $todo) + $array;
		}else{
			$combo  				= 	array('' => $titulo) + $array;
		}
	 	return  $combo;	
	}

	private function gn_generacion_combo_cies($titulo,$todo='')
	{
		$array 						= 	DB::table('cies')->where('activo','=',1)
		        						->selectRaw("concat(codigo,' - ',descripcion) as descripcion,id")
		        						->pluck('descripcion','id')
										->toArray();
		if($todo=='TODO'){
			$combo  				= 	array('' => $titulo , $todo => $todo) + $array;
		}else{
			$combo  				= 	array('' => $titulo) + $array;
		}
	 	return  $combo;	
	}
	
	public function is_connected($url='www.google.com',$port=80)
	{
		$connected = @fsockopen($url, $port); 
		//website, port  (try 80 or 443)
		if ($connected){
			$is_conn = true; //action when connected
			fclose($connected);
		}else{
			$is_conn = false; //action in connection failure
		}
		return $is_conn;
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function codificar($id) {
	  	return Hashids::encode($id);
	}
	public function decodificar($id) {
	  	//decodificar variable
	  	$iddeco = Hashids::decode($id);
	  	//ver si viene con letras la cadena codificada
	  	if(count($iddeco)==0){ 
	  		return ''; 
	  	}
	  	return $iddeco[0];
	}

	public function decodificarmaestra($id) {
		//decodificar variable
		$iddeco = Hashids::decode($id);
	  	if(count($iddeco)==0){ 
	  		return ''; 
	  	}
	  	return $iddeco[0];
	}

	public function ge_getComboDepartamentos($iddepartamento=NULL){
		$datos 	=	[];
		$cadena = 	[''=>'Ubicacion'];
		if(!is_null($iddepartamento)){
			$datos 	= 	Departamento::where('id','=',$iddepartamento)->pluck('descripcion','id')->toArray() + $cadena + Departamento::where('id','<>',$iddepartamento)->pluck('descripcion','id')->toArray();	
		}
		else{
			$datos 	= 	$cadena + Departamento::pluck('descripcion','id')->toArray();	
		}
		return $datos;
	}

	public function ge_getComboProvincias($idprovincia=NULL){
		$datos 	=	[];
		$cadena = 	[''=>'Ubicacion'];
		if(!is_null($idprovincia)){
			$registro 	=	Provincia::find($idprovincia);
			$datos 		= 	Provincia::where('id','=',$idprovincia)->pluck('descripcion','id')->toArray() + $cadena + Provincia::where('departamento_id','=',$registro->departamento_id)->where('id','<>',$idprovincia)->pluck('descripcion','id')->toArray();	
		}
		else{
			$datos 	= 	$cadena + $datos;	
		}
		return $datos;
	}

	public function ge_getComboProvinciasDepartamento($iddepartamento=NULL){
		$datos 	=	[];
		$cadena = 	[''=>'Ubicacion'];
		if(!is_null($iddepartamento)){
			$datos 		= 	$cadena + Provincia::where('departamento_id','=',$iddepartamento)->pluck('descripcion','id')->toArray();	
		}
		else{
			$datos 	= 	$cadena + $datos;	
		}
		return $datos;
	}

	public function ge_getComboDistritos($iddistrito=NULL){
		$datos 	=	[];
		$cadena = 	[''=>'Ubicacion'];
		if(!is_null($iddistrito)){
			$registro 	=	Distrito::find($iddistrito);
			$datos 		= 	Distrito::where('id','=',$iddistrito)->pluck('descripcion','id')->toArray() + $cadena + Distrito::where('provincia_id','=',$registro->provincia_id)->where('id','<>',$iddistrito)->pluck('descripcion','id')->toArray();	
		}
		else{
			$datos 	= 	$cadena + $datos;	
		}
		return $datos;
	}

	public function ge_getRolEncuestador(){
		$registro_id = NULL;
		$consulta 		=	Rol::where('nombre','=','Encuestador')->first();
		$registro_id	=	!empty($consulta)? $consulta->id : NULL;
		return $registro_id;
	}
	
	public function ge_getComboEncuestadores($idrol=0){
		$datos =[];
		$datos = ($idrol!==0)? User::where('rol_id','<>',1)->where('rol_id','=',$idrol)->selectRaw("concat(nombre,' ',apellido) as descripcion,id")->pluck('descripcion','id')->toArray():User::where('activo','=',1)->where('rol_id','=',2)->selectRaw("concat(nombre,' ',apellido) as descripcion,id")->pluck('descripcion','id')->toArray();
		return [''=>'Encuestador']+$datos;
	}

	public function ge_getCodigoTabla($tabla){
		// $consulta = DB::table($tabla)->selectRaw("ISNULL(max(CONVERT(float,codigo)),0) as codigo")->where('activo','=',1)->first();
		$consulta = DB::table($tabla)->select(DB::raw('max(codigo) as codigo'))->first();
		$numero = !empty($consulta)? (float) $consulta->codigo + 1: 1;
		$codigo = str_pad($numero, 12, "0", STR_PAD_LEFT);
		return $codigo;
	}

	public function ge_getComboConceptos($codigoconcepto,$iddetalle=NULL){
		$datos 		=	[];
		$cadena 	=	[''=>'Seleccione Opcion'];
		$consulta 	=	Concepto::where('codigo','=',$codigoconcepto)->first();
		if(!is_null($iddetalle)){
			$detalle 	=	 Detalleconcepto::where('id','=',$iddetalle)->where('concepto_id','=',$consulta->id)->pluck('nombre','id')->toArray() + $cadena + Detalleconcepto::where('id','<>',$iddetalle)->where('concepto_id','=',$consulta->id)->pluck('nombre','id')->toArray();
		}
		else{
			$detalle 	=	!empty($consulta)? $cadena + Detalleconcepto::where('concepto_id','=',$consulta->id)->pluck('nombre','id')->toArray(): [];
		}
		$datos 		=	 $detalle;
		
		return $datos;
	}

	public function ge_getBeneficiario($idregistro){
		$datos 		= !is_null($idregistro)?Beneficiario::where('ficha_id','=',$idregistro)->where('activo','=',1)->first():NULL;
		return $datos;
	}

	public function ge_getListaFamiliares($idregistro){
		$datos 		= !is_null($idregistro)?Familiar::where('ficha_id','=',$idregistro)->where('activo','=',1)->get():NULL;
		return $datos;
	}
	
	public function ge_getSaludBeneficiario($idregistro){
		$datos 		= !is_null($idregistro)?SaludBeneficiario::where('ficha_id','=',$idregistro)->where('activo','=',1)->first():NULL;
		return $datos;
	}

	public function ge_getListaFamiliaresSalud($idregistro){
		$datos 		= !is_null($idregistro)?SaludFamiliar::where('ficha_id','=',$idregistro)->where('activo','=',1)->get():NULL;
		return $datos;
	}
	
	public function ge_getComboFamiliares($idregistro){
		$datos 		=	[];
		$cadena 	=	[''=>'Seleccione Opcion'];
		$datos 		= !is_null($idregistro)?Familiar::where('ficha_id','=',$idregistro)->where('activo','=',1)->selectRaw("CONCAT(apellidopaterno,' ',apellidomaterno,' ',nombres) as nombrefamiliar,id")->pluck('nombrefamiliar','id')->toArray():NULL;
		return 	$cadena + $datos;
	}
	
	public function ge_getListaFamiliaresMortalidad($idregistro){
		$datos 		= !is_null($idregistro)?SaludMortalidad::where('ficha_id','=',$idregistro)->where('activo','=',1)->get():NULL;
		return $datos;
	}

	public function ge_getListaActividadesEconomicasFH($idregistro){
		$datos 		= !is_null($idregistro)?OtroIngreso::where('ficha_id','=',$idregistro)->where('activo','=',1)->get():NULL;
		return $datos;
	}

	public function ge_getListaActividadesEconomicas($idregistro){
		$datos 		= !is_null($idregistro)?ActividadEconomica::where('ficha_id','=',$idregistro)->where('activo','=',1)->get():NULL;
		return $datos;
	}

	public function ge_getListaDiscapacidadBeneficiarios($idregistro){

		$datos 	= 	!is_null($idregistro)?SaludBeneficiario::where('ficha_id','=',$idregistro)->where('activo','=',1)->get():NULL;
		return  $datos;
	}

	public function ge_getListaDocumentosFicha($idregistro){
		$datos 		= !is_null($idregistro)?DocumentosFicha::where('ficha_id','=',$idregistro)->where('activo','=',1)->get():NULL;
		return $datos;
	}

    public function isFechaIgual($fechainicio,$fechafin){
        $rpta= false;
        if(strtotime($fechainicio)==strtotime($fechafin)){
            $rpta   =true;
        }
        return $rpta;
    }

    public function isFechaMayor($fechainicio,$fechafin){
        $rpta =false;
        if(!($this->isFechaIgual($fechainicio,$fechafin))){
            if(strtotime($fechainicio)>strtotime($fechafin)){
                $rpta =true;
            }
        }
        return $rpta;
    }
   
    public function isFechaMenor($fechainicio,$fechafin){
        $rpta =false;
        if(!($this->isFechaIgual($fechainicio,$fechafin))){
            if(strtotime($fechainicio)<strtotime($fechafin)){
                $rpta =true;
            }
        }
        return $rpta;
    }
   
    public function isFechaMenorIgual($fechainicio,$fechafin){
        $rpta =false;
        if(strtotime($fechainicio)<=strtotime($fechafin)){
            $rpta =true;
        }
        return $rpta;
    }

    public function isFechaMayorIgual($fechainicio,$fechafin){
        $rpta =false;
        if(strtotime($fechainicio)>=strtotime($fechafin)){
            $rpta =true;
        }
        return $rpta;
    }

	public function setLogFichaSocioEconomica($id,$opcion,$descripcion)
	{
		$log  				= 	new Ilogs();
		$log->opcion 		=	$opcion;
		$log->ficha_id 		=	$id;
		$log->descripcion 	=	$descripcion;
		$log->user_id 		=	Session::get('usuario')->id;
		$log->fecha 		=	date('Y-m-d H:i:s');
		$log->save();
	}

	// public function ge_fnAprobarFichaSocioEconomica($ficha_id)
	// {
		
	// 	HistorialFicha::where('ficha_id','=',$ficha_id)
	// 				->update([
	// 					'vigencia'=>0,
	// 					'updated_at'=>date('Y-m-d H:i:s'),
	// 					'usermod'=>Session::get('usuario')->id,
	// 					'fechamod'=>date('Y-m-d H:i:s'),
	// 				]);
	// 	$fichafin 		= date('Y-m-d',strtotime('01-01-1901'));
	// 	$fichainicio 	= date('Y-m-d');
	// 	$idnuevo					=	$this->ge_getNuevoId('historialficha');
	// 	$historial 					= 	new HistorialFicha();
	// 	$historial->id 				= 	$idnuevo;
	// 	$historial->ficha_id		=	$ficha_id;
	// 	$historial->fechainicio		=	$fechainicio;
	// 	$historial->fechafin		=	$fechafin;
	// 	$historial->usercrea 		=	Session::get('usuario')->id;
	// 	$historial->fechacrea 		=	date('Y-m-d H:i:s');
	// 	$historial->created_at 		=	date('Y-m-d H:i:s');
	// 	$historial->save();
	// 	$this->setLogFichaSocioEconomica($ficha_id,'Aprobar-Ficha-Socioeconomica');
	// }

	public function ge_getClassColorEstado($estado_id){
		$clase = 'general';
		switch($estado_id){
			case 1: $clase='general';break;
			case 2: $clase='primary';break;
			case 5: $clase='primary';break;
			case 6: $clase='success';break;
			case 3: $clase='danger';break;
			// case 1: $clase='general';break;
		}
		return $clase;
	}

	public function ge_getComboBeneficiarioClonarTodos()
	{
		$datos 		=	[];
		$cadena 	=	[''=>'Seleccione Opcion'];
		$datos 		= 	Beneficiario::where('activo','=',1)->selectRaw("CONCAT(apellidopaterno,' ',apellidomaterno,' ',nombres) as nombrebeneficiario,id")->pluck('nombrebeneficiario','id')->toArray();
		return 	$cadena + $datos;
	}

	public function ge_getValidarBeneficiario($registro_id,$dni)
	{
		$valor =false;
		$idestados = Estado::whereIn('descripcion',['GENERADO','APROBADO','PRE-APROBADO'])->pluck('id')->toArray();
		$idfichas = FichaSocioEconomica::where('id','<>',$registro_id)->whereIn('estado_id',$idestados)->pluck('id')->toArray();
		$consulta = (Beneficiario::where('activo','=',1)->whereIn('ficha_id',$idfichas)->where('dni','=',$dni)->count()==0)? true : false;
		return $valor;
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}