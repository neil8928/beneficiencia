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

use App\Modelos\Vivienda;
use App\Modelos\Observacion;
use App\Modelos\FichaSocioEconomica;
use App\Modelos\OtroIngreso;

use App\User;
use App\Modelos\ConvivenciaFamiliar;
use App\Modelos\Beneficio;

use stdClass;
use View;
use Session;
use Hashids;
Use Nexmo;
use Keygen;

trait ClonarTraits
{

	public function clonarconvivenciafamiliar($ficha_id,$beneficiario,$user_id){

        ConvivenciaFamiliar::where('ficha_id','=',$ficha_id)
                    ->update(
                        [
                            'activo'=>0,
                            'updated_at'=>date('Y-m-d h:i:s')
                        ]
                    );

        $vivienda 	= 	ConvivenciaFamiliar::where('ficha_id','=',$beneficiario->ficha_id)
        				->where('activo','=','1')
        				->get();

        foreach ($vivienda as $index=>$item) {

	        $viviendaclonacion      	=   ConvivenciaFamiliar::where('id','=',$item->id)
	                                        ->first();

	     	if(count((array)$viviendaclonacion)>0){

	        	$viviendaactual      			=   ConvivenciaFamiliar::where('ficha_id','=',$ficha_id)
	                                        		->where('conceptodetalle_id','=',$item->conceptodetalle_id)
	                                        		->first();
	            if(count((array)$viviendaactual)>0){
		            $viviendaactual->activo                 =   1;
		            $viviendaactual->fechamod               =   date('Ymd');
		        	$viviendaactual->usermod                =   $user_id;
		            $viviendaactual->updated_at           	=   date('Y-m-d h:i:s');
		            $viviendaactual->save();
	            }else{
		            $beneficio                          =   new ConvivenciaFamiliar();
		            $beneficio->ficha_id                =   $ficha_id;
		            $beneficio->concepto         		=   $item->concepto;
		            $beneficio->conceptodetalle_id     	=   $item->conceptodetalle_id;
		            $beneficio->nombreconceptodetalle   =   $item->nombreconceptodetalle;
		            $beneficio->usercrea                =   $user_id;
		            $beneficio->fechacrea               =   date('Ymd');
		            $beneficio->created_at           	=   date('Y-m-d h:i:s');
		            $beneficio->save();
	            }
	     	}
        }
		return 	1;
	}



	public function clonarvivienda($ficha_id,$beneficiario,$user_id){

        Vivienda::where('ficha_id','=',$ficha_id)->where('concepto','<>','bienes')
                    ->update(
                        [
                            'activo'=>0,
                            'updated_at'=>date('Y-m-d h:i:s')
                        ]
                    );

        $vivienda 	= 	Vivienda::where('ficha_id','=',$beneficiario->ficha_id)
        				->where('concepto','<>','bienes')
        				->where('activo','=','1')
        				->get();

        foreach ($vivienda as $index=>$item) {

	        $viviendaclonacion      	=   Vivienda::where('id','=',$item->id)
	                                        ->first();

	     	if(count((array)$viviendaclonacion)>0){

	        	$viviendaactual      			=   Vivienda::where('ficha_id','=',$ficha_id)
	                                        		->where('concepto','<>','bienes')
	                                        		->where('materialvivienda_id','=',$item->materialvivienda_id)
	                                        		->first();
	            if(count((array)$viviendaactual)>0){
		            $viviendaactual->activo                 =   1;
		            $viviendaactual->fechamod               =   date('Ymd');
		        	$viviendaactual->usermod                =   $user_id;
		            $viviendaactual->updated_at           	=   date('Y-m-d h:i:s');
		            $viviendaactual->save();
	            }else{
		            $beneficio                          =   new Vivienda();
		            $beneficio->ficha_id                =   $ficha_id;
		            $beneficio->concepto         		=   $item->concepto;
		            $beneficio->materialvivienda_id     =   $item->materialvivienda_id;
		            $beneficio->nombrematerialvivienda  =   $item->nombrematerialvivienda;
		            $beneficio->usercrea                =   $user_id;
		            $beneficio->fechacrea               =   date('Ymd');
		            $beneficio->created_at           	=   date('Y-m-d h:i:s');
		            $beneficio->save();
	            }
	     	}
        }
		return 	1;
	}


	public function clonarsituacioneconomica($ficha_id,$beneficiario,$user_id){

        Vivienda::where('ficha_id','=',$ficha_id)->where('concepto','=','bienes')
                    ->update(
                        [
                            'activo'=>0,
                            'updated_at'=>date('Y-m-d h:i:s')
                        ]
                    );

        $vivienda 	= 	Vivienda::where('ficha_id','=',$beneficiario->ficha_id)
        				->where('concepto','=','bienes')
        				->where('activo','=','1')
        				->get();

        foreach ($vivienda as $index=>$item) {

	        $viviendaclonacion      	=   Vivienda::where('id','=',$item->id)
	                                        ->first();

	     	if(count((array)$viviendaclonacion)>0){

	        	$viviendaactual      			=   Vivienda::where('ficha_id','=',$ficha_id)
	                                        		->where('concepto','=','bienes')
	                                        		->where('materialvivienda_id','=',$item->materialvivienda_id)
	                                        		->first();
	            if(count((array)$viviendaactual)>0){
		            $viviendaactual->activo                 =   1;
		            $viviendaactual->fechamod               =   date('Ymd');
		        	$viviendaactual->usermod                =   $user_id;
		            $viviendaactual->updated_at           	=   date('Y-m-d h:i:s');
		            $viviendaactual->save();
	            }else{
		            $beneficio                          =   new Vivienda();
		            $beneficio->ficha_id                =   $ficha_id;
		            $beneficio->concepto         		=   'bienes';
		            $beneficio->materialvivienda_id     =   $item->materialvivienda_id;
		            $beneficio->nombrematerialvivienda  =   $item->nombrematerialvivienda;
		            $beneficio->usercrea                =   $user_id;
		            $beneficio->fechacrea               =   date('Ymd');
		            $beneficio->created_at           	=   date('Y-m-d h:i:s');
		            $beneficio->save();
	            }
	     	}
        }
		return 	1;
	}


	public function clonarinformacionfamiliar($ficha_id,$beneficiario,$user_id){

        Familiar::where('ficha_id','=',$ficha_id)
                    ->update(
                        [
                            'activo'=>0,
                            'updated_at'=>date('Y-m-d h:i:s'),
                            'usermod'=>Session::get('usuario')->id,
                            'fechamod'=>date('Y-m-d H:i:s'),                            
                        ]
                    );



        Beneficio::where('ficha_id','=',$ficha_id)
	                    ->update(
	                        [
	                        	'familiar_id'=>0,
	                            'activo'=>0,
	                            'updated_at'=>date('Y-m-d h:i:s')
	                        ]
	                    );





        $familiar 	= 	Familiar::where('ficha_id','=',$beneficiario->ficha_id)
        				->where('activo','=','1')
        				->get();


        foreach ($familiar as $index=>$item) {

        	//familiares
            $idnuevo                            =   $this->ge_getNuevoId('familiares');
            $familiaractual                     =   new Familiar(); 
            $familiaractual->id           		=   $idnuevo;                  	
            $familiaractual->ficha_id           =   $ficha_id;
            $familiaractual->swentrevistado     =   $item->swentrevistado;
            $familiaractual->nombres            =   $item->nombres;
            $familiaractual->apellidopaterno    =   $item->apellidopaterno;
            $familiaractual->apellidomaterno    =   $item->apellidomaterno;
            $familiaractual->dni     			=   $item->dni;
            $familiaractual->fechanacimiento    =   $item->fechanacimiento;
            $familiaractual->edad    			=   $item->edad;
            $familiaractual->sexo          		=   $item->sexo;
            $familiaractual->telefono           =   $item->telefono;
            $familiaractual->email     			=   $item->email;
            $familiaractual->parentesco_id      =   $item->parentesco_id;
            $familiaractual->parentesco    		=   $item->parentesco;
            $familiaractual->estadocivil_id     =   $item->estadocivil_id;
            $familiaractual->estadocivil        =   $item->estadocivil;
            $familiaractual->niveleducativo_id  =   $item->niveleducativo_id;
            $familiaractual->niveleducativo     =   $item->niveleducativo;
            $familiaractual->tiposeguro_id    	=   $item->tiposeguro_id;
            $familiaractual->tiposeguro         =   $item->tiposeguro;
            $familiaractual->tiposeguro         =   $item->tiposeguro;
            $familiaractual->activo             =   $item->activo;
            $familiaractual->fechacrea          =   date('Y-m-d h:i:s');
            $familiaractual->usercrea           =   Session::get('usuario')->id;
            $familiaractual->save();

			//salud 
	        $saludfamiliar 	= 	SaludFamiliar::where('ficha_id','=',$beneficiario->ficha_id)
	        					->where('familiar_id','=',$item->id)
	        					->where('activo','=','1')
	        					->get();

	        foreach ($saludfamiliar as $indexs=>$itemsf) {

				DB::insert("insert into saludfamiliares(ficha_id,familiar_id,parentesco_id,parentesco,nombrefamiliar,enfermedad,activo,fechacrea,usercrea) 
							select ".$ficha_id.",".$idnuevo.",parentesco_id,parentesco,nombrefamiliar,enfermedad,activo,fechacrea,usercrea
							from saludfamiliares where id=?",[$itemsf->id]);



	        }

	        //actividdes economicas

	        $actividadeconomica 	= 	ActividadEconomica::where('ficha_id','=',$beneficiario->ficha_id)
	        							->where('familiar_id','=',$item->id)
	        							->where('activo','=','1')
	        							->get();

	        foreach ($actividadeconomica as $indexs=>$itemac) {

				DB::insert("insert into actividadeseconomicas(ficha_id,familiar_id,parentesco_id,parentesco,nombrefamiliar,
														ocupacionprincipal,remuneracionmensual,frecuenciaactividad,frecuenciaactividad_id,actividadesextras,activo,fechacrea,usercrea) 
							select ".$ficha_id.",".$idnuevo.",parentesco_id,parentesco,nombrefamiliar,
														ocupacionprincipal,remuneracionmensual,frecuenciaactividad,frecuenciaactividad_id,actividadesextras,activo,fechacrea,usercrea
							from actividadeseconomicas where id=?",[$itemac->id]);

	        }

	        //beneficios

	        $beneficios 	= 	Beneficio::where('ficha_id','=',$beneficiario->ficha_id)
	        							->where('familiar_id','=',$item->id)
	        							->where('activo','=','1')
	        							->get();

	        foreach ($beneficios as $indexbe=>$itembe) {

				DB::insert("insert into beneficios(ficha_id,familiar_id,nombrefamiliar,programabeneficiario_id,
																nombreprogramabeneficiario,activo,usercrea,fechacrea) 
							select ".$ficha_id.",".$idnuevo.",nombrefamiliar,programabeneficiario_id,
																nombreprogramabeneficiario,activo,usercrea,fechacrea
							from beneficios where id=?",[$itembe->id]);

	        }


        }

		return 	1;
	}


	public function clonarmortalidad($ficha_id,$beneficiario,$user_id){

        SaludMortalidad::where('ficha_id','=',$ficha_id)
                    ->update(
                        [
                            'activo'=>0,
                            'updated_at'=>date('Y-m-d h:i:s'),
                            'usermod'=>Session::get('usuario')->id,
                            'fechamod'=>date('Y-m-d H:i:s'),
                        ]
                    );

        $mortalidad 	= 	SaludMortalidad::where('ficha_id','=',$beneficiario->ficha_id)
        					->where('activo','=','1')
        					->get();


	        if(count((array)$mortalidad)>0){


				DB::insert("insert into saludmortalidad(ficha_id,parentesco_id,parentesco,nombrefamiliar,enfermedad,
														lugarfallecimiento_id,lugarfallecimiento,cadlugarfallecimiento,activo,fechacrea,usercrea) 
							select ".$ficha_id.",parentesco_id,parentesco,nombrefamiliar,enfermedad,
														lugarfallecimiento_id,lugarfallecimiento,cadlugarfallecimiento,activo,fechacrea,usercrea
														from saludmortalidad where ficha_id=? and activo=1",[$beneficiario->ficha_id]);

	        }

		return 	1;
	}


	public function clonarayudafuerahogar($ficha_id,$beneficiario,$user_id){

        OtroIngreso::where('ficha_id','=',$ficha_id)
                    ->update(
                        [
                            'activo'=>0,
                            'updated_at'=>date('Y-m-d h:i:s'),
                            'usermod'=>Session::get('usuario')->id,
                            'fechamod'=>date('Y-m-d H:i:s'),
                        ]
                    );

        $mortalidad 	= 	OtroIngreso::where('ficha_id','=',$beneficiario->ficha_id)
        					->where('activo','=','1')
        					->get();


	        if(count((array)$mortalidad)>0){


				DB::insert("insert into otrosingresos(ficha_id,parentesco_id,parentesco,nombrefamiliar,ocupacionprincipal,
													  saldodeapoyo,,activo,fechacrea,usercrea) 
							select ".$ficha_id.",parentesco_id,parentesco,nombrefamiliar,ocupacionprincipal,
													  saldodeapoyo,,activo,fechacrea,usercrea
														from otrosingresos where ficha_id=? and activo=1",[$beneficiario->ficha_id]);

	        }

		return 	1;
	}



	public function clonardatosgenerales($ficha_id,$beneficiario,$user_id){

		$fichaclonacion 	= 	FichaSocioEconomica::where('id','=',$beneficiario->ficha_id)->first();
		$fichaactual 		= 	FichaSocioEconomica::where('id','=',$ficha_id)->first();



        $fichaactual->departamento_id             		=   $fichaclonacion->departamento_id;
        $fichaactual->provincia_id                		=   $fichaclonacion->provincia_id;
        $fichaactual->distrito_id         		  		=   $fichaclonacion->distrito_id;
        $fichaactual->centropoblado               		=   $fichaclonacion->centropoblado;
        $fichaactual->direccion                	  		=   $fichaclonacion->direccion;

        $fichaactual->tenenciavivienda_id             	=   $fichaclonacion->tenenciavivienda_id;
        $fichaactual->acreditepropiedadvivienda_id      =   $fichaclonacion->acreditepropiedadvivienda_id;
        $fichaactual->numeroambientevivienda         	=   $fichaclonacion->numeroambientevivienda;
        $fichaactual->numeroambientevivienda            =   $fichaclonacion->numeroambientevivienda;
        $fichaactual->materialparedesvivienda_id        =   $fichaclonacion->materialparedesvivienda_id;
        $fichaactual->materialtechosvivienda_id         =   $fichaclonacion->materialtechosvivienda_id;
        $fichaactual->materialpisosvivienda_id          =   $fichaclonacion->materialpisosvivienda_id;
        $fichaactual->alumbradopublicovivienda          =   $fichaclonacion->alumbradopublicovivienda;
        $fichaactual->cfhabandono               		=   $fichaclonacion->cfhabandono;
        $fichaactual->cfhpensionalimenticia            	=   $fichaclonacion->cfhpensionalimenticia;
        $fichaactual->cfhdenunciapension             	=   $fichaclonacion->cfhdenunciapension;
        $fichaactual->cfhdenunciamaltrato               =   $fichaclonacion->cfhdenunciamaltrato;
        $fichaactual->cfamabandono         		  		=   $fichaclonacion->cfamabandono;
        $fichaactual->cfampensionalimenticia            =   $fichaclonacion->cfampensionalimenticia;
        $fichaactual->cfamdenunciapension               =   $fichaclonacion->cfamdenunciapension;
        $fichaactual->cfamdenunciamaltrato              =   $fichaclonacion->cfamdenunciamaltrato;
        $fichaactual->otrosbienes                	  	=   $fichaclonacion->otrosbienes;

        $fichaactual->fechacrea           	  	  		=   date('Y-m-d h:i:s');
        $fichaactual->usercrea           	  	  		=   $user_id;


        $fichaactual->updated_at           	  	  =   date('Y-m-d h:i:s');
        $fichaactual->save();

		return 	1;
	}

	public function clonarobservacion($ficha_id,$beneficiario,$user_id,$tab){

        //clonar observacion
        $observacionclonacion      	=   Observacion::where('ficha_id','=',$beneficiario->ficha_id)
                                        ->where('tab_observacion','=',$tab)
                                        ->first();

     	if(count((array)$observacionclonacion)>0){

        	$observacionactual      			=   Observacion::where('ficha_id','=',$ficha_id)
                                        			->where('tab_observacion','=',$tab)
                                        			->first();

            if(count((array)$observacionactual)>0){

	            $observacionactual->observacion             =   $observacionclonacion->observacion;
	            $observacionactual->usermod                 =   $user_id;
	            $observacionactual->fechamod                =   date('Ymd');
	            $observacionactual->updated_at           	=   date('Y-m-d h:i:s');
	            $observacionactual->save();

            }else{
	            $beneficio                          =   new Observacion();
	            $beneficio->ficha_id                =   $ficha_id;
	            $beneficio->tab_observacion         =   $observacionclonacion->tab_observacion;
	            $beneficio->observacion             =   $observacionclonacion->observacion;
	            $beneficio->usercrea                =   $user_id;
	            $beneficio->fechacrea               =   date('Ymd');
	            $beneficio->created_at           	=   date('Y-m-d h:i:s');
	            $beneficio->save();
            }

     	}

		return 	1;
	}

	public function clonarbeneficiario($ficha_id,$beneficiario,$fechareg)
	{

        $idnuevobeneficiario                =   $this->ge_getNuevoId('beneficiarios');
        $cabecera                       =   new Beneficiario();
        $cabecera->id                   =   $idnuevobeneficiario;
        $cabecera->ficha_id             =   $ficha_id;
        $cabecera->nombres              =   $beneficiario->nombres;
        $cabecera->apellidopaterno      =   $beneficiario->apellidopaterno;
        $cabecera->apellidomaterno      =   $beneficiario->apellidomaterno;
        $cabecera->swentrevistado       =   $beneficiario->swentrevistado;
        $cabecera->sexo                 =   $beneficiario->sexo;
        $cabecera->dni                  =   $beneficiario->dni;
        $cabecera->fechanacimiento      =   $beneficiario->fechanacimiento;
        $edad 							=	$this->ge_calcularEdad($beneficiario->fechanacimiento,$fechareg);
        $cabecera->edad                 =   $edad;
        $cabecera->telefono             =   $beneficiario->telefono;
        $cabecera->email                =   $beneficiario->email;
        $cabecera->estadocivil          =   $beneficiario->estadocivil;
        $cabecera->estadocivil_id       =   $beneficiario->estadocivil_id;
        $cabecera->niveleducativo       =   $beneficiario->niveleducativo;
        $cabecera->niveleducativo_id    =   $beneficiario->niveleducativo_id;
        $cabecera->tiposeguro           =   $beneficiario->tiposeguro;
        $cabecera->tiposeguro_id        =   $beneficiario->tiposeguro_id;
        // $beneficio->usercrea 			=	$user_id;
        // $beneficio->fechacrea 			=	$this->fechaactual;
        $cabecera->cargafamiliar        =   $beneficiario->cargafamiliar;
        $cabecera->created_at           =   $this->fechaactual;
        $cabecera->save();
   

		return 	1;
	}

}