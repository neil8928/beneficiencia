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
use Illuminate\Support\Facades\Response;


use Session;
use View;
use PDF;
use Hashids;

use App\Modelos\FichaSocioEconomica as Registro;
use App\Modelos\Estado;
use App\Modelos\Beneficiario;
use App\Modelos\Familiar;
use App\Modelos\SaludBeneficiario;
use App\Modelos\SaludFamiliar;
use App\Modelos\SaludMortalidad;
use App\Modelos\ActividadEconomica;
use App\Modelos\DocumentosFicha;
use App\Modelos\HistorialFicha;

use App\Modelos\Vivienda;
use App\Modelos\Detalleconcepto;
use App\Modelos\ConvivenciaFamiliar;
use App\Modelos\Beneficio;
use App\Modelos\Observacion;

use GuzzleHttp\Client;
use App\Traits\GeneralesTraits;
use App\Traits\ClonarTraits;


class FichaSocioEconomicaController extends Controller
{
    //
    use GeneralesTraits;
    use ClonarTraits;    
    private   $tituloview               =   'Cosecha Productos';
    private   $ruta                     =   'fichasocioeconomica';
    private   $urlprincipal             =   'gestion-ficha-socieconomica';
    private   $urlcompleto              =   'gestion-ficha-socieconomica';
    private   $urlopciones              =   'ficha-socieconomica';
    private   $rutaview                 =   'fichasocioeconomica';

    private   $rutaviewblade            =   'productos';

    private   $rutaviewbladegeneral     =   'general';
    private   $tregistro                =   'fichasocioeconomica';
    private   $tfoto                    =   'multimedias';
    private   $idmodal                  =   'modfichasocioeconomica';

    private   $categoria_id             =   3;
    private   $pathLocal                =   'fichasocioeconomica/';
    private   $carpetaimg               =   'cp/';




    public function actionPdfFichaSocioEconomica($idopcion,$idregistro)
    {

        $ficha_id       =   $this->decodificar($idregistro);

        $ficha          =   Registro::leftJoin('beneficiarios', 'beneficiarios.ficha_id', '=', 'fichasocioeconomica.id')
                                ->leftJoin('departamentos', 'departamentos.id', '=', 'fichasocioeconomica.departamento_id')
                                ->leftJoin('provincias', 'provincias.id', '=', 'fichasocioeconomica.provincia_id')
                                ->leftJoin('distritos', 'distritos.id', '=', 'fichasocioeconomica.distrito_id')
                                ->where('fichasocioeconomica.id','=',$ficha_id)
                                ->select(
                                        'fichasocioeconomica.*',
                                        'beneficiarios.dni',
                                        'beneficiarios.telefono',
                                        'beneficiarios.apellidopaterno',
                                        'beneficiarios.apellidomaterno',
                                        'beneficiarios.nombres',
                                        'beneficiarios.fechanacimiento',
                                        'beneficiarios.edad',
                                        'beneficiarios.sexo',
                                        'beneficiarios.email',

                                        'beneficiarios.estadocivil',
                                        'beneficiarios.niveleducativo',
                                        'beneficiarios.tiposeguro',


                                        'departamentos.descripcion as departamento',
                                        'provincias.descripcion as provincia',
                                        'distritos.descripcion as distrito'
                                    )
                                ->first();


        //observacion
        $odatosgenerales                =   $this->ge_getObservacion('datosgenerales',$ficha_id);
        $oinformacionfamiliar           =   $this->ge_getObservacion('informacionfamiliar',$ficha_id);
        $osalud                         =   $this->ge_getObservacion('salud',$ficha_id);
        $osituacioneconomica            =   $this->ge_getObservacion('situacioneconomica',$ficha_id);
        $obeneficios                    =   $this->ge_getObservacion('beneficios',$ficha_id);
        $ovivienda                      =   $this->ge_getObservacion('vivienda',$ficha_id);
        $oconvivenciafamiliar           =   $this->ge_getObservacion('convivenciafamiliar',$ficha_id);
        $listafamiliares                =   $this->ge_getListaFamiliares($ficha_id);
        $listadiscapacidadbeneficiario  =   $this->ge_getListaDiscapacidadBeneficiarios($ficha_id);
        $listafamiliaressalud           =   $this->ge_getListaFamiliaresSalud($ficha_id);
        $listafamiliaresmortalidad      =   $this->ge_getListaFamiliaresMortalidad($ficha_id);

        $bienes                         =   Vivienda::where('concepto','=', 'bienes')
                                                    ->where('ficha_id','=', $ficha_id)
                                                    ->where('activo','=','1')->pluck('nombrematerialvivienda')->toArray();
        $actividadeconomicahogar        =   implode("; ", $bienes);

        $listaactividadeseconomicas     =   $this->ge_getListaActividadesEconomicas($ficha_id);
        $listabeneficios                =   $this->ge_getListaBeneficios($ficha_id);

        //vivienda
        $tenenciavivienda               =   $this->ge_textdetallecategoria($ficha->tenenciavivienda_id);
        $acreditepropiedadvivienda      =   $this->ge_textdetallecategoria($ficha->acreditepropiedadvivienda_id);
        $materialparedesvivienda        =   $this->ge_textdetallecategoria($ficha->materialparedesvivienda_id);
        $materialpisosvivienda          =   $this->ge_textdetallecategoria($ficha->materialpisosvivienda_id);
        $materialtechosvivienda         =   $this->ge_textdetallecategoria($ficha->materialtechosvivienda_id);

        $serviciopublicos               =   Vivienda::where('concepto','=', 'serviciopublicos')
                                                    ->where('ficha_id','=', $ficha_id)
                                                    ->where('activo','=','1')->pluck('nombrematerialvivienda')->toArray();
        $serviciopublicostext           =   implode("; ", $serviciopublicos);

        $abastecimientoagua             =   Vivienda::where('concepto','=', 'abastecimientoagua')
                                                    ->where('ficha_id','=', $ficha_id)
                                                    ->where('activo','=','1')->pluck('nombrematerialvivienda')->toArray();
        $abastecimientoaguatext         =   implode("; ", $abastecimientoagua);
        $servicioshigienicos            =   Vivienda::where('concepto','=', 'servicioshigienicos')
                                                    ->where('ficha_id','=', $ficha_id)
                                                    ->where('activo','=','1')->pluck('nombrematerialvivienda')->toArray();
        $servicioshigienicostext        =   implode("; ", $servicioshigienicos);

        //convivencia familiar


        $tipoviolenciageneral           =   ConvivenciaFamiliar::where('concepto','=', 'tipoviolenciageneral')
                                                    ->where('ficha_id','=', $ficha_id)
                                                    ->where('activo','=','1')->pluck('nombreconceptodetalle')->toArray();
        $tipoviolenciageneraltext       =   implode("; ", $tipoviolenciageneral);

        $tipoviolenciahijo              =   ConvivenciaFamiliar::where('concepto','=', 'tipoviolenciahijo')
                                                    ->where('ficha_id','=', $ficha_id)
                                                    ->where('activo','=','1')->pluck('nombreconceptodetalle')->toArray();
        $tipoviolenciahijotext          =   implode("; ", $tipoviolenciahijo);

        $institucionhijo                =   ConvivenciaFamiliar::where('concepto','=', 'institucionhijo')
                                                    ->where('ficha_id','=', $ficha_id)
                                                    ->where('activo','=','1')->pluck('nombreconceptodetalle')->toArray();
        $institucionhijotext            =   implode("; ", $institucionhijo);

        $tipoviolenciaabuelo            =   ConvivenciaFamiliar::where('concepto','=', 'tipoviolenciaabuelo')
                                                    ->where('ficha_id','=', $ficha_id)
                                                    ->where('activo','=','1')->pluck('nombreconceptodetalle')->toArray();
        $tipoviolenciaabuelotext        =   implode("; ", $tipoviolenciaabuelo);

        $institucionabuelo              =   ConvivenciaFamiliar::where('concepto','=', 'institucionabuelo')
                                                    ->where('ficha_id','=', $ficha_id)
                                                    ->where('activo','=','1')->pluck('nombreconceptodetalle')->toArray();
        $institucionabuelotext          =   implode("; ", $institucionabuelo);





        $pdf = PDF::loadView('pdf.ficha',   [ 
                                                'ficha'                 => $ficha,
                                                'odatosgenerales'       => $odatosgenerales,
                                                'oinformacionfamiliar'  => $oinformacionfamiliar,
                                                'osalud'                => $osalud,
                                                'osituacioneconomica'   => $osituacioneconomica,
                                                'obeneficios'           => $obeneficios,
                                                'ovivienda'             => $ovivienda,
                                                'oconvivenciafamiliar'  => $oconvivenciafamiliar,
                                                'listafamiliares'       => $listafamiliares,
                                                'listadiscapacidadbeneficiario'       => $listadiscapacidadbeneficiario,
                                                'listafamiliaressalud'                => $listafamiliaressalud,
                                                'listafamiliaresmortalidad'           => $listafamiliaresmortalidad,
                                                'actividadeconomicahogar'             => $actividadeconomicahogar,
                                                'listaactividadeseconomicas'          => $listaactividadeseconomicas,
                                                'listabeneficios'                     => $listabeneficios,
                                                'tenenciavivienda'                    => $tenenciavivienda,

                                                'acreditepropiedadvivienda'           => $acreditepropiedadvivienda,
                                                'materialparedesvivienda'             => $materialparedesvivienda,
                                                'materialpisosvivienda'               => $materialpisosvivienda,
                                                'materialtechosvivienda'              => $materialtechosvivienda,

                                                'serviciopublicostext'                => $serviciopublicostext,
                                                'abastecimientoaguatext'              => $abastecimientoaguatext,
                                                'servicioshigienicostext'             => $servicioshigienicostext,

                                                'tipoviolenciageneraltext'            => $tipoviolenciageneraltext,
                                                'tipoviolenciahijotext'               => $tipoviolenciahijotext,
                                                'institucionhijotext'                 => $institucionhijotext,
                                                'tipoviolenciaabuelotext'             => $tipoviolenciaabuelotext,
                                                'institucionabuelotext'               => $institucionabuelotext,

                                            ]);

        return $pdf->stream('download.pdf');
    }



    public function actionAjaxCargarComboFamiliarApoyo(Request $request)
    {

        $idopcion               =   $request['idopcion'];
        $ficha_id               =   $request['ficha_id'];
        $ficha_id               =   $this->decodificar($ficha_id);
        $combofamiliares        =   $this->ge_getComboFamiliares($ficha_id);

        return View::make('fichasocioeconomica/ajax/cfamiliaapoyo',
                         [          
                            'combofamiliares'       => $combofamiliares,
                            'ajax'                  => true,
                            'idopcion'              => $idopcion,
                         ]);
    }

    public function actionAjaxCargarComboFamiliarSE(Request $request)
    {

        $idopcion               =   $request['idopcion'];
        $ficha_id               =   $request['ficha_id'];
        $ficha_id               =   $this->decodificar($ficha_id);
        $combofamiliares        =   $this->ge_getComboFamiliares($ficha_id);


        return View::make('fichasocioeconomica/ajax/cfamiliase',
                         [          
                            'combofamiliares'       => $combofamiliares,
                            'ajax'                  => true,
                            'idopcion'              => $idopcion,
                         ]);
    }


    public function actionAjaxCargarComboFamiliarSalud(Request $request)
    {

        $idopcion               =   $request['idopcion'];
        $ficha_id               =   $request['ficha_id'];
        $ficha_id               =   $this->decodificar($ficha_id);
        $combofamiliares        =   $this->ge_getComboFamiliares($ficha_id);


        return View::make('fichasocioeconomica/ajax/cfamiliasalud',
                         [          
                            'combofamiliares'       => $combofamiliares,
                            'ajax'                  => true,
                            'idopcion'              => $idopcion,
                         ]);
    }




    public function actionAjaxGuardarClonar(Request $request)
    {
        $ficha_id                   =   $request['ficha_id'];
        $ficha_id                   =   $this->decodificar($ficha_id);
        $idopcion                   =   $request['idopcion'];
        $beneficiario_id            =   $request['beneficiario_id'];
        $user_id                    =   Session::get('usuario')->id;
        $beneficiario               =   Beneficiario::where('id','=',$beneficiario_id)->first();
        $sw                         =   0;
        $mensaje                    =   'Su proceso de clonacion se realizo Correctamente';  
        $error          =   true;
        try{
            DB::beginTransaction();

            $clonardatosgenerales       =   $this->clonardatosgenerales($ficha_id,$beneficiario,$user_id);
            $clonarobsdatosgenerales    =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'datosgenerales');

            $clonarinformacionfamiliar  =   $this->clonarinformacionfamiliar($ficha_id,$beneficiario,$user_id);
            $clonarobsinformacionfamiliar    =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'informacionfamiliar');

            $clonarobssalud    =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'salud');
            $clonarmortalidad  =   $this->clonarmortalidad($ficha_id,$beneficiario,$user_id);

            //situacioneconomica
            $clonarsituacioneconomica   =   $this->clonarsituacioneconomica($ficha_id,$beneficiario,$user_id);
            $clonarobssituacioneconomica   =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'situacioneconomica');
            //beneficios
            $clonarobsbeneficios   =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'beneficios');
            //vivienda
            $clonarvivienda  =   $this->clonarvivienda($ficha_id,$beneficiario,$user_id);
            $clonarobsvivienda   =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'vivienda');
            $clonarobsconvivenciafamiliar   =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'convivenciafamiliar');
            $clonarconvivenciafamiliar =   $this->clonarconvivenciafamiliar($ficha_id,$beneficiario,$user_id);


            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
        }


        if($sw == 0) {
            $mensaje = $mensaje;
            $error   =  false;
        }
                                        
        $response[] = array(
            'error'      => $error,
            'mensaje'    => $mensaje,
        );

        if($response[0]['error']){echo json_encode($response); exit();}
        echo json_encode($response);

    }


    public function actionAjaxObservacion(Request $request)
    {

        $observacion            =   $request['observacion'];
        $ficha_id               =   $request['ficha_id'];
        $tab                    =   $request['tab'];
        $idopcion               =   $request['idopcion'];
        $data_descripcion       =   $request['data_descripcion'];
        $ficha_id_de                   =   $this->decodificar($ficha_id);
   
        $observaciontext = '';
        $obs = Observacion::where('tab_observacion','=', $tab)
                            ->where('ficha_id','=', $ficha_id_de)
                            ->first();
        if(count($obs)>0){
            $observaciontext = $obs->observacion;
        }


        return View::make('fichasocioeconomica/modal/ajax/amobservacion',
                         [          
                            'observacion'       => $observaciontext,
                            'ficha_id'          => $ficha_id,
                            'tab'               => $tab,
                            'idopcion'          => $idopcion,
                            'data_descripcion'  => $data_descripcion,                       
                         ]);

    }





    public function actionAjaxClonar(Request $request)
    {

        $ficha_id               =   $request['ficha_id'];
        $idopcion               =   $request['idopcion'];
        $ficha_id_de            =   $this->decodificar($ficha_id);
        $user_id                =   Session::get('usuario')->id;


        $combobeneficiario      =   $this->ge_getComboBeneficiarioClonar($ficha_id_de);

        return View::make('fichasocioeconomica/modal/ajax/amclonar',
                         [          
                            'combobeneficiario' => $combobeneficiario,
                            'ficha_id'          => $ficha_id,
                            'idopcion'          => $idopcion, 
                            'ajax'          => true,                      
                            'swelim'   => true,
                         ]);

    }



    

    public function actionAjaxGuardarObservacion(Request $request)
    {
        $ficha_id                   =   $request['ficha_id'];
        $ficha_id                   =   $this->decodificar($ficha_id);
        
        $tab                        =   $request['tab'];
        $idopcion                   =   $request['idopcion'];
        $observaciontext            =   $request['observacion'];
        $user_id                    =   Session::get('usuario')->id;

        $observacion                =   Observacion::where('ficha_id','=',$ficha_id)
                                        ->where('tab_observacion','=',$tab)
                                        ->first();
        if(count($observacion)>0){

            $observacion->usermod              =   $user_id;
            $observacion->observacion          =   $observaciontext;
            $observacion->fechamod             =   date('Ymd');
            $observacion->save();  

        }else{

            $idnuevo                            =   $this->ge_getNuevoId('observaciones');
            $beneficio                          =   new Observacion();
            $beneficio->id                      =   $idnuevo;
            $beneficio->ficha_id                =   $ficha_id;
            $beneficio->tab_observacion         =   $tab;
            $beneficio->observacion             =   $observaciontext;
            $beneficio->usercrea                 =   $user_id;
            $beneficio->fechacrea                =   date('Ymd');
            $beneficio->created_at           =   $this->fechaactual;
            $beneficio->save(); 

        }

        echo('Registro modificada con exito');

    }


    public function actionAjaxTabBeneficiosAgregar(Request $request){

        $ficha_id                   =   $this->decodificar($request['idficha']);
        $familiar_id                =   $request['familiar_id'];
        $idopcion                   =   $request['idopcion'];

        $programabeneficiario_id    =   $request['programabeneficiario_id'];
        $user_id                    =   Session::get('usuario')->id;

        try{
            DB::beginTransaction();

            $familiar                           =   Familiar::where('ficha_id',$ficha_id)
                                                    ->where('id','=',$familiar_id)->first();
            $programabeneficiario               =   Detalleconcepto::where('id',$programabeneficiario_id)->first();

            $idnuevo                            =   $this->ge_getNuevoId('beneficios');

            $beneficio                          =   new Beneficio();
            $beneficio->id                      =   $idnuevo;
            $beneficio->ficha_id                =   $ficha_id;
            $beneficio->familiar_id             =   $familiar_id;
            $beneficio->programabeneficiario_id =   $programabeneficiario_id;
            $beneficio->nombrefamiliar             =   $familiar->apellidopaterno.' '.$familiar->apellidomaterno.' '.$familiar->nombres;
            $beneficio->nombreprogramabeneficiario =   $programabeneficiario->nombre;
            $beneficio->usercrea                 =   $user_id;
            $beneficio->fechacrea                =   date('Ymd');
            $beneficio->created_at           =   $this->fechaactual;
            $beneficio->save();  

            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
        }

        $listabeneficios      =   $this->ge_getListaBeneficios($ficha_id);
        return View::make($this->rutaview.'/tabs/beneficios/ajax/ajaxtbeneficios',
                         [                  
                            'listabeneficios'   => $listabeneficios,
                            'ajax'              => true,
                            'swelim'   => true,
                            'idopcion'          =>  $idopcion,                        
                         ]);

    }


    public function actionAjaxTabBeneficioEliminar(Request $request)
    {
        $idopcion       =   $request['idopcion'];
        $ficha_id       =   $request['idficha'];
        $registro_id    =   $request['idregistro'];
        $user_id                    =   Session::get('usuario')->id;

        try{

            DB::beginTransaction();
            Beneficio::where('id','=',$registro_id)
                        ->update(
                            [
                                'activo'=>0,
                                'usermod'=>$user_id,
                                'fechamod'=>date('Ymd'),
                                'updated_at'=>$this->fechaactual
                            ]
                        );

            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
            // dd($mensaje);
            // $mensaje  = 'Ocurrio un error al intentar Guardar la información';
        }

        $listabeneficios      =   $this->ge_getListaBeneficios($ficha_id);
        // dd($listafamiliares);
        return View::make($this->rutaview.'/tabs/beneficios/ajax/ajaxtbeneficios',
                         [                  
                            'listabeneficios'   => $listabeneficios,
                            'ajax'              => true,
                            'swelim'   => true,
                            'idopcion'          =>  $idopcion,                        
                         ]);
    }



    public function actionListarFichaSocioEconomica($idopcion) {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Ver');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        View::share('titulo','Ficha SocioEconomica');
        $generado             =   Estado::where('descripcion','=','GENERADO')->first();
        $user_id            =   Session::get('usuario')->id;
        $rol_id             =   $this->ge_getRolEncuestador();
        $comboencuestadores =   $this->ge_getComboEncuestadores($rol_id);    
        $listadatos         =   Registro::leftJoin('beneficiarios', 'beneficiarios.ficha_id', '=', 'fichasocioeconomica.id')
                                ->leftJoin('departamentos', 'departamentos.id', '=', 'fichasocioeconomica.departamento_id')
                                ->leftJoin('provincias', 'provincias.id', '=', 'fichasocioeconomica.provincia_id')
                                ->leftJoin('distritos', 'distritos.id', '=', 'fichasocioeconomica.distrito_id')
                                ->where('fichasocioeconomica.activo','=',1)
                                ->where('fichasocioeconomica.estado_id','=',$generado->id)
                                ->select(
                                        'fichasocioeconomica.*',
                                        'beneficiarios.dni',
                                        'beneficiarios.telefono',
                                        'beneficiarios.apellidopaterno',
                                        'beneficiarios.apellidomaterno',
                                        'beneficiarios.nombres',
                                        'departamentos.descripcion as departamento',
                                        'provincias.descripcion as provincia',
                                        'distritos.descripcion as distrito'
                                    )
                                ->selectRaw("'' as classcolorfila")
                                ->orderby('fichasocioeconomica.codigo','desc')
                                ->get();
        foreach($listadatos as $fila){
            // $classcolorfila = $this->ge_getClassColorEstado($fila->estado_id);
            // $fila->classcolorfila=$classcolorfila;
            $fila->classcolorfila=$this->colores[$fila->estado_id];
        }

        return View::make($this->rutaview.'/lista',
            [
                'idopcion'          =>  $idopcion,
                'view'              =>  $this->rutaviewblade,
                'url'               =>  $this->urlopciones,
                'urlcompleta'       =>  $this->urlprincipal,
                'ruta'              =>  $this->ruta,
                'idmodal'           =>  $this->idmodal,
                'listadatos'        =>  $listadatos,
                'comboencuestadores'  =>  $comboencuestadores,
            ]);
    }

    // public function actionRegistrarFichaSocioEconomica($idopcion) 
    // {
    //     /******************* validar url **********************/
    //     $validarurl = $this->funciones->getUrl($idopcion, 'Anadir');
    //     if ($validarurl != 'true') {return $validarurl;}
    //     /******************************************************/
    //     View::share('titulo','Ficha SocioEconomica');
    //     $user_id            =   Session::get('usuario')->id;
    //     $generado           =   Estado::where('descripcion','=','GENERADO')->first();
    //     $usuario            =   User::find($user_id);
    //     // $registro           =   Registro::where('activo','=',1)
    //     //                             ->where('encuestador_id','=',$usuario->id)
    //     //                             ->where('estado_id','=',$generado->id)
    //     //                             ->first();

    //     // if(empty($registro) || is_null($registro)){
    //         $fecha          =   date('Y-m-d',strtotime($this->fechaactual));
    //         $codigo         =   $this->ge_getCodigoTabla($this->tregistro);
    //         $idnuevo                    =   $this->ge_getNuevoId($this->tregistro);
    //         $modelo                     =   new Registro();
    //         $modelo->id                 =   $idnuevo;
    //         $modelo->codigo             =   $codigo;
    //         $modelo->fecha              =   $fecha;
    //         $modelo->encuestador_id     =   $usuario->id;
    //         $modelo->estado_id          =   $generado->id;
    //         $modelo->activo             =   1;
    //         $modelo->save();
    //         $registro       =   $modelo;

    //         // $idnuevoh                   =   $this->ge_getNuevoId('historialficha');
    //         // $fechafin                   =   date('Y-m-d',strtotime('01-01-1901'));
    //         // $fechainicio                =   date('Y-m-d');

    //         // $historial                  =   new HistorialFicha();
    //         // $historial->id              =   $idnuevoh;
    //         // $historial->ficha_id        =   $idnuevo;
    //         // $historial->fechainicio     =   $fechainicio;
    //         // $historial->fechafin        =   $fechafin;
    //         // $historial->usercrea        =   Session::get('usuario')->id;
    //         // $historial->fechacrea       =   date('Y-m-d H:i:s');
    //         // $historial->created_at      =   date('Y-m-d H:i:s');
    //         // $historial->save();

    //         $this->setLogFichaSocioEconomica($idnuevo,'Generar-Ficha-Socioeconomica');

    //         // $this->mostrarValor($registro.' vacio');
    //     // }

    //     $idregistro     = $this->codificar($registro->id);
    //     return Redirect::to('/modificar-ficha-socieconomica/' . $idopcion.'/'.$idregistro)
    //                     ->with('bienhecho', 'Llenado de Ficha Socio Economica');
    // }

    public function actionRegistrarFichaSocioEconomica($idopcion,Request $request) 
    {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Anadir');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        View::share('titulo','Registrar Ficha SocioEconomica');
        $user_id            =   Session::get('usuario')->id;
        $generado           =   Estado::where('descripcion','=','GENERADO')->first();
        $usuario            =   User::find($user_id);

        if ($_POST) {

            $beneficiario_id    =   (int)$request['beneficiario_id'];
            $user_id            =   Session::get('usuario')->id;
            $beneficiario       =   Beneficiario::where('id','=',$beneficiario_id)->first();
            $sw                 =   0;
            $error              =   true;
            try{
                DB::beginTransaction();
               
                $codigo='';
                $fecha                        =   date('Y-m-d',strtotime($request['fecharegistro']));
                $codigo                       =   $this->ge_getCodigoTabla($this->tregistro);
                $idnuevo                      =   $this->ge_getNuevoId($this->tregistro);
               
                $registro                     =   new Registro();
                $registro->id                 =   $idnuevo;
                $registro->codigo             =   $codigo;
                $registro->fecha              =   $fecha;
                $registro->encuestador_id     =   $usuario->id;
                $registro->estado_id          =   $generado->id;
                $registro->activo             =   1;
                $registro->save();
                $ficha_id                     = $idnuevo;

                $indclonar                  =   (int)$request['indclonar'];

                if($indclonar==1){  
                                  
                    $clonardatosgenerales       =   $this->clonardatosgenerales($ficha_id,$beneficiario,$user_id);
                    $clonarobsdatosgenerales    =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'datosgenerales');

                    $clonarinformacionfamiliar  =   $this->clonarinformacionfamiliar($ficha_id,$beneficiario,$user_id);
                    $clonarobsinformacionfamiliar    =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'informacionfamiliar');

                    $clonarobssalud    =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'salud');
                    $clonarmortalidad  =   $this->clonarmortalidad($ficha_id,$beneficiario,$user_id);
                    //situacioneconomica
                    $clonarsituacioneconomica   =   $this->clonarsituacioneconomica($ficha_id,$beneficiario,$user_id);
                    $clonarobssituacioneconomica   =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'situacioneconomica');
                    //beneficios
                    $clonarobsbeneficios   =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'beneficios');
                    //vivienda
                    $clonarvivienda  =   $this->clonarvivienda($ficha_id,$beneficiario,$user_id);
                    $clonarobsvivienda   =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'vivienda');
                    $clonarobsconvivenciafamiliar   =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'convivenciafamiliar');
                    $clonarconvivenciafamiliar =   $this->clonarconvivenciafamiliar($ficha_id,$beneficiario,$user_id);
                }

                $this->setLogFichaSocioEconomica($idnuevo,'Generar-Ficha-Socioeconomica','');
                DB::commit();

            }catch(\Exception $ex){
                DB::rollback(); 
                $sw =   1;
                $mensaje  = $this->ge_getMensajeError($ex);
                // dd($mensaje);
                // $mensaje  = 'Ocurrio un error al intentar Guardar la información';
                return Redirect::to('/gestion-ficha-socieconomica/' . $idopcion)->with('errorbd', $mensaje);

            }
            return Redirect::to('/gestion-ficha-socieconomica/' . $idopcion)->with('bienhecho', 'Ficha ' . $codigo . ' registrado con exito');
        } 
        else {
            $combobeneficiario      =   $this->ge_getComboBeneficiarioClonarTodos();
            return View::make($this->rutaview.'/agregarficha',
                                    [
                                        'idopcion'                          =>      $idopcion,
                                        'combobeneficiario'                 =>      $combobeneficiario,
                                        'view'                              =>      $this->rutaviewblade,
                                        'url'                               =>      $this->urlopciones,
                                    ]);
        }

    }

     public function actionModificarFichaSocioEconomica($idopcion,$idregistro) {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Anadir');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        View::share('titulo','Modificar Ficha SocioEconomica');
        $user_id            =   Session::get('usuario')->id;
        $registro_id    =   $this->decodificar($idregistro);

        $swmodificar =  1;

        $registro           =   Registro::find($this->decodificar($idregistro));
        // $combodepartamentos =   $this->ge_getComboDepartamentos(13);
        if(!is_null($registro->departamento_id)){
            $combodepartamentos =   $this->ge_getComboDepartamentos($registro->departamento_id);
            $comboprovincias   =   $this->ge_getComboProvincias($registro->provincia_id);
        }
        else{
            $combodepartamentos =   $this->ge_getComboDepartamentos(13);
            $comboprovincias   =   $this->ge_getComboProvinciasDepartamento(13);
        }

        $combodistritos     =   $this->ge_getComboDistritos($registro->distrito_id);
        $idregistro         =   $this->codificar($registro->id);

        //TABS INFORMACION FAMILIAR        
        $beneficiario       =   $this->ge_getBeneficiario($registro->id);
        $comboparentesco    =   $this->ge_getComboConceptos($this->codparentesco);

        if(!is_null($beneficiario)){
            $comboestadocivil       =   $this->ge_getComboConceptos($this->codestadocivil,$beneficiario->estadocivil_id);
            $comboniveleducativo    =   $this->ge_getComboConceptos($this->codniveleducativo,$beneficiario->niveleducativo_id);
            $combotipodeseguro      =   $this->ge_getComboConceptos($this->codtipodeseguro,$beneficiario->tiposeguro_id);
        }
        else{
            $comboestadocivil       =   $this->ge_getComboConceptos($this->codestadocivil);
            $comboniveleducativo    =   $this->ge_getComboConceptos($this->codniveleducativo);
            $combotipodeseguro      =   $this->ge_getComboConceptos($this->codtipodeseguro);
        }

        $comboparentescoof          =   $this->ge_getComboConceptos($this->codparentesco);
        $comboestadocivilof         =   $this->ge_getComboConceptos($this->codestadocivil);
        $comboniveleducativoof      =   $this->ge_getComboConceptos($this->codniveleducativo);
        $combotipodeseguroof        =   $this->ge_getComboConceptos($this->codtipodeseguro);

        $listafamiliares            =   $this->ge_getListaFamiliares($registro->id);

        $combofamiliares            =   $this->ge_getComboFamiliares($registro->id);


        //TABS SALUD        
        $listadiscapacidadbeneficiario= $this->ge_getListaDiscapacidadBeneficiarios($registro->id);
        $saludbeneficiario          =   $this->ge_getSaludBeneficiario($registro->id);
        $comboparentesco            =   $this->ge_getComboConceptos($this->codparentesco);
        
     

            $combodiscapacidad     =   $this->ge_getComboConceptos($this->coddiscapacidad);
            $comboniveldiscapacidad=   $this->ge_getComboConceptos($this->codniveldediscapacidad);
            $combotipodesegurobe     =   $this->ge_getComboConceptos($this->codtipodeseguro);

       

        $combodiscapacidadsaludof       =   $this->ge_getComboConceptos($this->coddiscapacidad);
        $comboniveldiscapacidadsaludof  =   $this->ge_getComboConceptos($this->codniveldediscapacidad);
        $combotipodesegurosaludof       =   $this->ge_getComboConceptos($this->codtipodeseguro);
        $comboparentescosaludof         =   $this->ge_getComboConceptos($this->codparentesco);
        
        $comboestadocivilsa             =   $this->ge_getComboConceptos($this->codestadocivil);
        $comboniveleducativosa          =   $this->ge_getComboConceptos($this->codniveleducativo);
        $listafamiliaressalud           =   $this->ge_getListaFamiliaresSalud($registro->id);


        //MORTALIDAD
        $combolugarfallecimientomo      =   $this->ge_getComboConceptos($this->codlugardefallecimiento);
        $listafamiliaresmortalidad      =   $this->ge_getListaFamiliaresMortalidad($registro->id);
        // codlugardefallecimiento

        //FICHA SOCIOECONOMICA
        $listabienes                    =   $this->ge_getlistaConceptos($this->codbienes);
        $bienes                         =   Vivienda::where('concepto','=', 'bienes')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('materialvivienda_id')->toArray();


        $listaactividadeseconomicas     =   $this->ge_getListaActividadesEconomicas($registro_id);
        $combofrecuenciaactividad       =   $this->ge_getComboConceptos($this->codfrecuenciaactividad);
        //vivienda
        $combotenenciavivienda          =   $this->ge_getComboConceptos($this->codtenenciadevivienda,$registro->tenenciavivienda_id);
        $comboacreditepropiedadvivienda =   $this->ge_getComboConceptos($this->coddocumentaciondevivienda,$registro->acreditepropiedadvivienda_id);

        $combomaterialparedesvivienda   =   $this->ge_getComboConceptos($this->codmaterialdelavivienda,$registro->materialparedesvivienda_id);
        $combomaterialtechosvivienda    =   $this->ge_getComboConceptos($this->codmaterialdelavivienda,$registro->materialtechosvivienda_id);
        $combomaterialpisosvivienda     =   $this->ge_getComboConceptos($this->codmaterialdelavivienda,$registro->materialpisosvivienda_id);
        $comboalumbradopublicovivienda  =   [''=>'Seleccione Opcion','SI'=>'SI','NO'=>'NO'];

        $listaserviciopublicos          =   $this->ge_getlistaConceptos($this->codserviciospublicos);
        $serviciopublicos               =   Vivienda::where('concepto','=', 'serviciopublicos')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('materialvivienda_id')->toArray();

        $listaabastecimientoagua        =   $this->ge_getlistaConceptos($this->codabastecimientoagua);
        $abastecimientoagua             =   Vivienda::where('concepto','=', 'abastecimientoagua')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('materialvivienda_id')->toArray();

        $listaservicioshigienicos       =   $this->ge_getlistaConceptos($this->codservicioshigienicos);
        $servicioshigienicos             =   Vivienda::where('concepto','=', 'servicioshigienicos')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('materialvivienda_id')->toArray();



        //convivenciafamiliar

        $listatipoviolenciageneral      =   $this->ge_getlistaConceptos($this->codtipodeviolenciafamiliar);
        $tipoviolenciageneral           =   ConvivenciaFamiliar::where('concepto','=', 'tipoviolenciageneral')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('conceptodetalle_id')->toArray();

        $listatipoviolenciahijo         =   $this->ge_getlistaConceptos($this->codtipodeviolenciafamiliar);
        $tipoviolenciahijo              =   ConvivenciaFamiliar::where('concepto','=', 'tipoviolenciahijo')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('conceptodetalle_id')->toArray();

        $listainstitucionhijo           =   $this->ge_getlistaConceptos($this->codinstitucionapoyoviolencia);
        $institucionhijo                =   ConvivenciaFamiliar::where('concepto','=', 'institucionhijo')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('conceptodetalle_id')->toArray();

        $listatipoviolenciaabuelo       =   $this->ge_getlistaConceptos($this->codtipodeviolenciafamiliar);
        $tipoviolenciaabuelo            =   ConvivenciaFamiliar::where('concepto','=', 'tipoviolenciaabuelo')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('conceptodetalle_id')->toArray();

        $listainstitucionabuelo         =   $this->ge_getlistaConceptos($this->codinstitucionapoyoviolencia);
        $institucionabuelo              =   ConvivenciaFamiliar::where('concepto','=', 'institucionabuelo')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('conceptodetalle_id')->toArray();
        //beneficios
        $comboprogramabeneficiario      =   $this->ge_getComboConceptos($this->codprogramabeneficiario);
        $listabeneficios                =   $this->ge_getListaBeneficios($registro->id);


        $listadocumentos           =   $this->ge_getListaDocumentosFicha($registro->id);


        //observacion
        $odatosgenerales                =   $this->ge_getObservacion('datosgenerales',$registro_id);
        $oinformacionfamiliar           =   $this->ge_getObservacion('informacionfamiliar',$registro_id);
        $osalud                         =   $this->ge_getObservacion('salud',$registro_id);
        $osituacioneconomica            =   $this->ge_getObservacion('situacioneconomica',$registro_id);
        $obeneficios                    =   $this->ge_getObservacion('beneficios',$registro_id);
        $ovivienda                      =   $this->ge_getObservacion('vivienda',$registro_id);
        $oconvivenciafamiliar           =   $this->ge_getObservacion('convivenciafamiliar',$registro_id);
        $odocumentosficha               =   $this->ge_getObservacion('documentosficha',$registro_id);



        return View::make($this->rutaview.'/ficha',
            [
                'idopcion'                          =>      $idopcion,
                'idregistro'                        =>      $idregistro,
                'view'                              =>      $this->rutaviewblade,
                'url'                               =>      $this->urlopciones,
                'urlcompleta'                       =>      $this->urlprincipal,
                'ruta'                              =>      $this->ruta,
                'idmodal'                           =>      $this->idmodal,

                'combodepartamentos'                =>      $combodepartamentos,
                'comboprovincias'                   =>      $comboprovincias,
                'combodistritos'                    =>      $combodistritos,
                
                'registro'                          =>      $registro,
                'beneficiario'                      =>      $beneficiario,

                'comboestadocivil'                  =>      $comboestadocivil,
                'comboniveleducativo'               =>      $comboniveleducativo,
                'combotipodeseguro'                 =>      $combotipodeseguro,

                'listafamiliares'                   =>      $listafamiliares,

                'comboparentescoof'                 =>      $comboparentescoof,
                'comboestadocivilof'                =>      $comboestadocivilof,
                'comboniveleducativoof'             =>      $comboniveleducativoof,
                'combotipodeseguroof'               =>      $combotipodeseguroof,
                
                //salud 
                'saludbeneficiario'                 =>      $saludbeneficiario,
                'combodiscapacidad'                 =>      $combodiscapacidad,
                'comboniveldiscapacidad'            =>      $comboniveldiscapacidad,
                'combotipodesegurobe'                 =>      $combotipodesegurobe,

                'listadiscapacidadbeneficiario'     =>      $listadiscapacidadbeneficiario,

                'combofamiliares'                   =>      $combofamiliares,
                'comboparentescosaludof'            =>      $comboparentescosaludof,
                'combodiscapacidadsaludof'          =>      $combodiscapacidadsaludof,
                'comboniveldiscapacidadsaludof'     =>      $comboniveldiscapacidadsaludof,

                'combotipodesegurosaludof'          =>      $combotipodesegurosaludof,
                
                'listafamiliaressalud'              =>      $listafamiliaressalud,

                'comboparentesco'                   =>      $comboparentesco,
                'combolugarfallecimientomo'         =>      $combolugarfallecimientomo ,
                'listafamiliaresmortalidad'         =>      $listafamiliaresmortalidad,

                //fichasocieconomica
                'listabienes'                       =>      $listabienes,
                'bienes'                            =>      $bienes,
                'listaactividadeseconomicas'        =>      $listaactividadeseconomicas,
                'combofrecuenciaactividad'          =>      $combofrecuenciaactividad,

                'listadocumentos'                   =>      $listadocumentos,

                //vivienda
                'combotenenciavivienda'             =>      $combotenenciavivienda,
                'comboacreditepropiedadvivienda'    =>      $comboacreditepropiedadvivienda,
                'combomaterialparedesvivienda'      =>      $combomaterialparedesvivienda,
                'combomaterialtechosvivienda'       =>      $combomaterialtechosvivienda,
                'combomaterialpisosvivienda'        =>      $combomaterialpisosvivienda,
                'listaserviciopublicos'             =>      $listaserviciopublicos,
                'serviciopublicos'                  =>      $serviciopublicos,
                'listaabastecimientoagua'           =>      $listaabastecimientoagua,
                'abastecimientoagua'                =>      $abastecimientoagua,
                'listaservicioshigienicos'          =>      $listaservicioshigienicos,
                'servicioshigienicos'               =>      $servicioshigienicos,
                'comboalumbradopublicovivienda'     =>      $comboalumbradopublicovivienda,

                //convivenciafamiliar
                'listatipoviolenciageneral'         =>      $listatipoviolenciageneral,
                'tipoviolenciageneral'              =>      $tipoviolenciageneral,

                'listatipoviolenciahijo'            =>      $listatipoviolenciahijo,
                'tipoviolenciahijo'                 =>      $tipoviolenciahijo,
                'listainstitucionhijo'              =>      $listainstitucionhijo,
                'institucionhijo'                   =>      $institucionhijo,


                'listatipoviolenciaabuelo'          =>      $listatipoviolenciaabuelo,
                'tipoviolenciaabuelo'               =>      $tipoviolenciaabuelo,
                'listainstitucionabuelo'            =>      $listainstitucionabuelo,
                'institucionabuelo'                 =>      $institucionabuelo,

                //beneficios
                'comboprogramabeneficiario'         =>      $comboprogramabeneficiario,
                'listabeneficios'                   =>      $listabeneficios,

                //beneficios
                'odatosgenerales'                   =>      $odatosgenerales,
                'oinformacionfamiliar'              =>      $oinformacionfamiliar,
                'osalud'                            =>      $osalud,
                'osituacioneconomica'               =>      $osituacioneconomica,
                'obeneficios'                       =>      $obeneficios,
                'ovivienda'                         =>      $ovivienda,
                'oconvivenciafamiliar'              =>      $oconvivenciafamiliar,
                'odocumentosficha'                  =>      $odocumentosficha,
                'swmodificar'                       =>      $swmodificar,

            ]);
    }



    public function actionAjaxActualizarTabDatosConvivenciaFamiliar(Request $request)
    {

        $idopcion                           =   $request['idopcion'];
        $registro_id                        =   $this->decodificar($request['idregistro']);
        $user_id                            =   Session::get('usuario')->id;

        $cfhabandono                        =   $request['cfhabandono'];
        $cfhpensionalimenticia              =   $request['cfhpensionalimenticia'];
        $cfhdenunciapension                 =   $request['cfhdenunciapension'];
        $cfhdenunciamaltrato                =   $request['cfhdenunciamaltrato'];
        $cfamabandono                       =   $request['cfamabandono'];
        $cfampensionalimenticia             =   $request['cfampensionalimenticia'];
        $cfamdenunciapension                =   $request['cfamdenunciapension'];        
        $cfamdenunciamaltrato               =   $request['cfamdenunciamaltrato'];


        $tipoviolenciageneral               =   $request['tipoviolenciageneral'];

        $tipoviolenciahijo                  =   $request['tipoviolenciahijo'];
        $institucionhijo                    =   $request['institucionhijo'];
        $tipoviolenciaabuelo                =   $request['tipoviolenciaabuelo'];
        $institucionabuelo                  =   $request['institucionabuelo'];

        $guardarvivienda                    =   $this->ge_guardarconvivenciafamiliar('tipoviolenciageneral',$user_id,$registro_id,$tipoviolenciageneral);
        $guardarvivienda                    =   $this->ge_guardarconvivenciafamiliar('tipoviolenciahijo',$user_id,$registro_id,$tipoviolenciahijo);
        $guardarvivienda                    =   $this->ge_guardarconvivenciafamiliar('institucionhijo',$user_id,$registro_id,$institucionhijo);
        $guardarvivienda                    =   $this->ge_guardarconvivenciafamiliar('tipoviolenciaabuelo',$user_id,$registro_id,$tipoviolenciaabuelo);
        $guardarvivienda                    =   $this->ge_guardarconvivenciafamiliar('institucionabuelo',$user_id,$registro_id,$institucionabuelo);

        $mensaje        =   'Ocurrio un error con los parametros';
        $error          =   true;
        $sw             =   1;

        try{
            DB::beginTransaction();
            Registro::where('id','=',$registro_id)
                ->update(
                    [
                        'updated_at'                    =>  $this->fechaactual,
                        'cfhabandono'                   =>  $cfhabandono,
                        'cfhpensionalimenticia'         =>  $cfhpensionalimenticia,
                        'cfhdenunciapension'            =>  $cfhdenunciapension,
                        'cfhdenunciamaltrato'           =>  $cfhdenunciamaltrato,
                        'cfamabandono'                  =>  $cfamabandono,
                        'cfampensionalimenticia'        =>  $cfampensionalimenticia,
                        'cfamdenunciapension'           =>  $cfamdenunciapension,
                        'cfamdenunciamaltrato'          =>  $cfamdenunciamaltrato
                    ]
                );
            $sw     =   0;
            $mensaje=   'Actualizacion Correcta';            
            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
            // $mensaje  = 'Ocurrio un error al intentar Guardar la información';
        }

        if($sw == 0) {
            $mensaje = $mensaje;
            $error   =  false;
        }
                                        
        $response[] = array(
            'error'      => $error,
            'mensaje'    => $mensaje,
        );

        if($response[0]['error']){echo json_encode($response); exit();}
        echo json_encode($response);


    }


    public function actionAjaxActualizarTabDatosVivienda(Request $request)
    {

        $idopcion       =   $request['idopcion'];
        $registro_id    =   $this->decodificar($request['idregistro']);
        $user_id            =   Session::get('usuario')->id;

        $tenenciavivienda_id                =   $request['tenenciavivienda_id'];
        $acreditepropiedadvivienda_id       =   $request['acreditepropiedadvivienda_id'];
        $numeropisosvivienda                =   $request['numeropisosvivienda'];
        $numeroambientevivienda             =   $request['numeroambientevivienda'];
        $materialparedesvivienda_id         =   $request['materialparedesvivienda_id'];
        $materialtechosvivienda_id          =   $request['materialtechosvivienda_id'];
        $materialpisosvivienda_id           =   $request['materialpisosvivienda_id'];        

        $serviciopublicos                   =   $request['serviciopublicos'];
        $abastecimientoagua                 =   $request['abastecimientoagua'];
        $servicioshigienicos                =   $request['servicioshigienicos'];
        $alumbradopublicovivienda                =   $request['alumbradopublicovivienda'];

        $guardarvivienda                    =   $this->ge_guardarvivienda('serviciopublicos',$user_id,$registro_id,$serviciopublicos);
        $guardarvivienda                    =   $this->ge_guardarvivienda('abastecimientoagua',$user_id,$registro_id,$abastecimientoagua);
        $guardarvivienda                    =   $this->ge_guardarvivienda('servicioshigienicos',$user_id,$registro_id,$servicioshigienicos);

        $mensaje        =   'Ocurrio un error con los parametros';
        $error          =   true;
        $sw             =   1;

        try{
            DB::beginTransaction();
            Registro::where('id','=',$registro_id)
                ->update(
                    [
                        'updated_at'                    =>  $this->fechaactual,
                        'alumbradopublicovivienda'      =>  $alumbradopublicovivienda,
                        'tenenciavivienda_id'           =>  $tenenciavivienda_id,
                        'acreditepropiedadvivienda_id'  =>  $acreditepropiedadvivienda_id,
                        'numeropisosvivienda'           =>  $numeropisosvivienda,
                        'numeroambientevivienda'        =>  $numeroambientevivienda,
                        'materialparedesvivienda_id'    =>  $materialparedesvivienda_id,
                        'materialtechosvivienda_id'     =>  $materialtechosvivienda_id,
                        'materialpisosvivienda_id'      =>  $materialpisosvivienda_id
                    ]
                );
            $sw     =   0;
            $mensaje=   'Actualizacion Correcta';            
            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
            // $mensaje  = 'Ocurrio un error al intentar Guardar la información';
        }

        if($sw == 0) {
            $mensaje = $mensaje;
            $error   =  false;
        }
                                        
        $response[] = array(
            'error'      => $error,
            'mensaje'    => $mensaje,
        );

        if($response[0]['error']){echo json_encode($response); exit();}
        echo json_encode($response);
    }

    public function actionAjaxActualizarTabDatosGenerales(Request $request)
    {

        $idopcion       =   $request['idopcion'];
        $registro_id    =   $this->decodificar($request['idregistro']);
        $iddepartamento =   $request['iddepartamento'];
        $idprovincia    =   $request['idprovincia'];
        $iddistrito     =   $request['iddistrito'];
        $centropoblado  =   $request['centropoblado'];
        $direccion      =   $request['direccion'];
        
        $mensaje        =   'Ocurrio un error con los parametros';
        $error          =   true;
        $sw             =   1;

        try{
            DB::beginTransaction();
            Registro::where('id','=',$registro_id)
                ->update(
                    [
                        'updated_at'        =>  $this->fechaactual,
                        'departamento_id'   =>  $iddepartamento,
                        'provincia_id'      =>  $idprovincia,
                        'distrito_id'       =>  $iddistrito,
                        'centropoblado'     =>  $centropoblado,
                        'direccion'         =>  $direccion
                    ]
                );
            $sw     =   0;
            $mensaje=   'Actualizacion Correcta';            
            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
            // $mensaje  = 'Ocurrio un error al intentar Guardar la información';
        }

        if($sw == 0) {
            $mensaje = $mensaje;
            $error   =  false;
        }
                                        
        $response[] = array(
            'error'      => $error,
            'mensaje'    => $mensaje,
        );

        if($response[0]['error']){echo json_encode($response); exit();}
        echo json_encode($response);
    }

    public function actionAjaxActualizarTabInformacionFamiliarBeneficiario(Request $request)
    {

        $idopcion       =   $request['idopcion'];
        $registro_id    =   $this->decodificar($request['idregistro']);
        $registro       =   Registro::find($registro_id);

        $nombres            =   $request['nombres'];
        $apellidopaterno    =   $request['apellidopaterno'];
        $apellidomaterno    =   $request['apellidomaterno'];
        $edad               =   (int)$request['edad'];
        $sexo               =   (int)$request['sexo'];
        $dni                =   trim($request['dni']);
        $swentrevistado     =   $request['swentrevistado'];

        $fechanacimiento    =   date('Y-m-d',strtotime($request['fechanacimiento']));
        $telefono           =   $request['telefono'];
        $email              =   $request['email'];
        $estadocivil        =   $request['estadocivil'];
        $estadocivil_id     =   $request['estadocivil_id'];
        $niveleducativo     =   $request['niveleducativo'];
        $niveleducativo_id  =   $request['niveleducativo_id'];
        $tiposeguro         =   $request['tiposeguro'];
        $tiposeguro_id      =   $request['tiposeguro_id'];
        $cargafamiliar      =   $request['cargafamiliar'];
        
        
        $mensaje        =   'Ocurrio un error con los parametros';
        $error          =   true;
        $sw             =   1;
        $swbuscabeneficiario= $this->ge_getValidarBeneficiario($registro_id,$dni);

        $valor =false;
        $idestados = Estado::whereIn('descripcion',['GENERADO','APROBADO','PRE-APROBADO'])->pluck('id')->toArray();
        $idfichas = Registro::where('id','<>',$registro_id)->whereIn('estado_id',$idestados)->pluck('id')->toArray();
        // dd($idfichas);
        $swbuscabeneficiario = (Beneficiario::where('activo','=',1)->whereIn('ficha_id',$idfichas)->where('dni','=',$dni)->count()==0)? true : false;
        // dd($swbuscabeneficiario);


        if($swbuscabeneficiario==true){
            try{
                DB::beginTransaction();
                $beneficiario_id    =   NULL;
                $beneficiario       =   Beneficiario::where('ficha_id','=',$registro_id)->where('activo','=',1)->first();
                $beneficiario_id    =   !empty($beneficiario)? $beneficiario->id:NULL;
                if(is_null($beneficiario_id)){
                    $idnuevo        =   $this->ge_getNuevoId('beneficiarios');

                    $beneficiario                       =   new Beneficiario();
                    $beneficiario->id                   =   $idnuevo;
                    $beneficiario->ficha_id             =   $registro_id;
                    $beneficiario->nombres              =   $nombres;
                    $beneficiario->apellidopaterno      =   $apellidopaterno;
                    $beneficiario->apellidomaterno      =   $apellidomaterno;
                    $beneficiario->swentrevistado       =   $swentrevistado;
                    $beneficiario->edad                 =   $edad;
                    $beneficiario->sexo                 =   $sexo;
                    $beneficiario->dni                  =   $dni;
                    $beneficiario->fechanacimiento      =   $fechanacimiento;
                    $beneficiario->telefono             =   $telefono;
                    $beneficiario->email                =   $email;
                    $beneficiario->estadocivil          =   $estadocivil;
                    $beneficiario->estadocivil_id       =   $estadocivil_id;
                    $beneficiario->niveleducativo       =   $niveleducativo;
                    $beneficiario->niveleducativo_id    =   $niveleducativo_id;
                    $beneficiario->tiposeguro           =   $tiposeguro;
                    $beneficiario->tiposeguro_id        =   $tiposeguro_id;
                    $beneficiario->cargafamiliar        =   $cargafamiliar;

                    $beneficiario->created_at   =   $this->fechaactual;
                    $beneficiario->save();
                    $sw     =   0;
                    $mensaje=   'Datos Correctos';            
                }
                else{
                    $sw     =   1;
                    $mensaje=  'LA FICHA CON CODIGO: '.$registro->codigo.' YA TIENE UN BENEFICIARIO <br> REGISTRADO:'.strtoupper($beneficiario->apellidopaterno).' '.strtoupper($beneficiario->apellidomaterno).' '.strtoupper($beneficiario->nombres).' con DNI: '.$beneficiario->dni;                  
                }

                DB::commit();
            }catch(\Exception $ex){
                DB::rollback(); 
                $sw =   1;
                $mensaje  = $this->ge_getMensajeError($ex);
                // $mensaje  = 'Ocurrio un error al intentar Guardar la información';
            }
        }
        else{
            $sw =   1;
            $mensaje  = 'EL BENEFICIARIO: '.$apellidopaterno.' '.$apellidomaterno.' '.$nombres.' CON DNI:'.$dni.'<br> YA SE ENCUENTRA REGISTRADO EN OTRA FICHA SOCIOECONOMICA';

        }


        if($sw == 0) {
            $mensaje = $mensaje;
            $error   =  false;
        }
                                        
        $response[] = array(
            'error'      => $error,
            'mensaje'    => $mensaje,
        );

        if($response[0]['error']){echo json_encode($response); exit();}
        echo json_encode($response);
    }

    public function actionAjaxTabInformacionFamiliarAgregarOtroFamiliar(Request $request){

        $idopcion       =   $request['idopcion'];

        $ficha_id       =   $this->decodificar($request['idficha']);
        $registro_id    =   $request['idregistro'];
        
        // dd('holaaa'. $registro_id);

        $nombres            =   $request['nombres'];
        $apellidopaterno    =   $request['apellidopaterno'];
        $apellidomaterno    =   $request['apellidomaterno'];
        $edad               =   (int)$request['edad'];
        $sexo               =   (int)$request['sexo'];
        $dni                =   trim($request['dni']);
        $swentrevistado     =   $request['swentrevistado'];
        $fechanacimiento    =   date('Y-m-d',strtotime($request['fechanacimiento']));
        $telefono           =   $request['telefono'];
        $email              =   $request['email'];
        $parentesco         =   $request['parentesco'];
        $parentesco_id      =   $request['parentesco_id'];
        $estadocivil        =   $request['estadocivil'];
        $estadocivil_id     =   $request['estadocivil_id'];
        $niveleducativo     =   $request['niveleducativo'];
        $niveleducativo_id  =   $request['niveleducativo_id'];
        $tiposeguro         =   $request['tiposeguro'];
        $tiposeguro_id      =   $request['tiposeguro_id'];
        $cargafamiliar      =   $request['cargafamiliar'];
        

        try{
            DB::beginTransaction();

            $idnuevo        =   $this->ge_getNuevoId('familiares');

            $familiar                       =   new Familiar();
            $familiar->id                   =   $idnuevo;
            $familiar->ficha_id             =   $ficha_id;
            $familiar->nombres              =   $nombres;
            $familiar->apellidopaterno      =   $apellidopaterno;
            $familiar->apellidomaterno      =   $apellidomaterno;
            $familiar->swentrevistado       =   $swentrevistado;
            $familiar->edad                 =   $edad;
            $familiar->sexo                 =   $sexo;
            $familiar->dni                  =   $dni;
            $familiar->fechanacimiento      =   $fechanacimiento;
            $familiar->telefono             =   $telefono;
            $familiar->email                =   $email;
            $familiar->parentesco           =   $parentesco;
            $familiar->parentesco_id        =   $parentesco_id;
            $familiar->estadocivil          =   $estadocivil;
            $familiar->estadocivil_id       =   $estadocivil_id;
            $familiar->niveleducativo       =   $niveleducativo;
            $familiar->niveleducativo_id    =   $niveleducativo_id;
            $familiar->tiposeguro           =   $tiposeguro;
            $familiar->tiposeguro_id        =   $tiposeguro_id;
            $familiar->cargafamiliar        =   $cargafamiliar;
            $familiar->created_at           =   $this->fechaactual;
            $familiar->save();  

            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
            // dd($mensaje);
            // $mensaje  = 'Ocurrio un error al intentar Guardar la información';
        }

        $listafamiliares      =   Familiar::where('ficha_id',$ficha_id)->where('activo','=','1')->get();
        // dd($listafamiliares);
        return View::make($this->rutaview.'/tabs/informacionfamiliar/ajax/ajaxtinformacionfamiliar',
                         [                  
                            'listafamiliares'   => $listafamiliares,
                            'ajax'              => true,
                            'swelim'   => true,
                            'idopcion'          =>  $idopcion,                        
                         ]);

    }

    public function actionAjaxTabInformacionFamiliarEliminarOtroFamiliar(Request $request)
    {
        $idopcion       =   $request['idopcion'];
        $ficha_id       =   $request['idficha'];
        $registro_id    =   $request['idregistro'];

        $familiar       =   Familiar::find($registro_id);
        $swenfermedad   =   ((int)SaludFamiliar::where('familiar_id','=',$registro_id)->where('activo','=',1)->count()>0)? true :false;      


        if(!$swenfermedad){
        //     $listafamiliares      =   Familiar::where('ficha_id',$ficha_id)->where('activo','=','1')->get();
        //     return View::make($this->rutaview.'/tabs/informacionfamiliar/ajax/ajaxtinformacionfamiliar',
        //                  [                  
        //                     'listafamiliares'   => $listafamiliares,
        //                     'ajax'              => true,
        //                     'swelim'            => true,
        //                     'idopcion'          =>  $idopcion,     
        //                     'errorbd'           =>  'EL FAMILIAR NO SE PUEDE ELIMINAR POR QUE TIENE REGISTROS DE SALUD ASOCIADOS'                   
        //                  ]);
        // }
        // else{
            try{
                DB::beginTransaction();

                familiar::where('id','=',$registro_id)
                            ->update(
                                [
                                    'activo'=>0,
                                    'updated_at'=>$this->fechaactual
                                ]
                            );

                DB::commit();
            }catch(\Exception $ex){
                DB::rollback(); 
                $sw =   1;
                $mensaje  = $this->ge_getMensajeError($ex);
            }
        }

        $listafamiliares      =   Familiar::where('ficha_id',$ficha_id)->where('activo','=','1')->get();
        // dd($listafamiliares);
        return View::make($this->rutaview.'/tabs/informacionfamiliar/ajax/ajaxtinformacionfamiliar',
                         [                  
                            'listafamiliares'   => $listafamiliares,
                            'ajax'              => true,
                            'swelim'            => true,
                            'idopcion'          =>  $idopcion,                        
                         ]);
    }

    public function actionAjaxGetComboInformacionFamiliar(Request $request)
    {
        $ficha_id       =   $this->decodificar($request['idficha']);
        $combofamiliares    =   $this->ge_getComboFamiliares($ficha_id);

        return View::make($this->rutaview.'/ajax/ajaxcombofamiliares',
                         [                  
                            'combofamiliares'   => $combofamiliares,
                            'ajax'              => true,
                            'swelim'   => true,
                         ]);
    }

    public function actionAjaxActualizarTabEvaluacionProfesional(Request $request)
    {

        $idopcion       =   $request['idopcion'];
        $registro_id    =   $this->decodificar($request['idregistro']);
        $diagnosticosocial  =   $request['diagnosticosocial'];
        $conclusiones       =   $request['conclusiones'];
        

        $mensaje        =   'Ocurrio un error con los parametros';
        $error          =   true;
        $sw             =   1;

        try{
            DB::beginTransaction();
            Registro::where('id','=',$registro_id)
                ->update(
                    [
                        'updated_at'        =>  $this->fechaactual,
                        'diagnostico'       =>  $diagnosticosocial,
                        'conclusiones'      =>  $conclusiones
                    ]
                );
            $sw     =   0;
            $mensaje=   'Actualizacion Correcta';            
            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
            // $mensaje  = 'Ocurrio un error al intentar Guardar la información';
        }

        if($sw == 0) {
            $mensaje = $mensaje;
            $error   =  false;
        }
                                        
        $response[] = array(
            'error'      => $error,
            'mensaje'    => $mensaje,
        );

        if($response[0]['error']){echo json_encode($response); exit();}
        echo json_encode($response);
    }

    //SALUD - BENEFICIARIO
    public function actionAjaxTabSaludAgregarDiscapacidadBeneficiario(Request $request)
    {

        $idopcion       =   $request['idopcion'];
        $registro_id    =   $this->decodificar($request['idregistro']);
        $registro       =   Registro::find($registro_id);

        $nombres                =   $request['nombres'];
        $apellidopaterno        =   $request['apellidopaterno'];
        $apellidomaterno        =   $request['apellidomaterno'];

        $discapacidad           =   $request['discapacidad'];
        $discapacidad_id        =   $request['discapacidad_id'];
        $niveldiscapacidad      =   $request['niveldiscapacidad'];
        $niveldiscapacidad_id   =   $request['niveldiscapacidad_id'];
        $tipodiscapacidad       =   $request['tipodiscapacidad'];
        
        $tiposeguro             =   $request['tiposeguro'];
        $tiposeguro_id          =   $request['tiposeguro_id'];
        $cadtiposeguro          =   $request['cadtiposeguro'];
        
        
        $mensaje        =   'Ocurrio un error con los parametros';
        $error          =   true;
        $sw             =   1;

        try{
            DB::beginTransaction();
         
            $idnuevo                        =   $this->ge_getNuevoId('saludbeneficiarios');
            $cabecera                       =   new SaludBeneficiario();
            $cabecera->id                   =   $idnuevo;
            $cabecera->ficha_id             =   $registro_id;

            $cabecera->discapacidad_id      =   $discapacidad_id;
            $cabecera->discapacidad         =   $discapacidad;
            $cabecera->niveldiscapacidad_id =   $niveldiscapacidad_id;
            $cabecera->niveldiscapacidad    =   $niveldiscapacidad;

            $cabecera->tipodiscapacidad     =   $tipodiscapacidad;

            $cabecera->tiposeguro_id        =   $tiposeguro_id;
            $cabecera->tiposeguro           =   $tiposeguro;
            $cabecera->cadtiposeguro        =   $cadtiposeguro;


            $cabecera->created_at   =   $this->fechaactual;
            $cabecera->save();
            $sw     =   0;
            $mensaje=   'Datos Correctos';            
           

            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
            dd($mensaje);
            // $mensaje  = 'Ocurrio un error al intentar Guardar la información';
        }

        $listadiscapacidad      =   SaludBeneficiario::where('ficha_id',$registro_id)->where('activo','=','1')->get();
        // dd($listadiscapacidad);
        return View::make($this->rutaview.'/tabs/salud/ajax/ajaxtsaluddiscapacidad',
                         [                  
                            'listadiscapacidad'   => $listadiscapacidad,
                            'ajax'              => true,
                            'swelim'   => true,
                            'idopcion'          =>  $idopcion,                        
                         ]);

    }
    
    public function actionAjaxTabSaludEliminarDiscapacidadBeneficiario(Request $request)
    {
        $idopcion       =   $request['idopcion'];
        $ficha_id       =   $request['idficha'];
        $registro_id    =   $request['idregistro'];
        try{
            DB::beginTransaction();
            SaludBeneficiario::where('id','=',$registro_id)
                        ->update(
                            [
                                'activo'=>0,
                                'updated_at'=>$this->fechaactual
                            ]
                        );

            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
        }

        $listadiscapacidad      =   SaludBeneficiario::where('ficha_id',$ficha_id)->where('activo','=','1')->get();
        // dd($listadiscapacidad);
        return View::make($this->rutaview.'/tabs/salud/ajax/ajaxtsaluddiscapacidad',
                         [                  
                            'listadiscapacidad'   => $listadiscapacidad,
                            'ajax'              => true,
                            'swelim'   => true,
                            'idopcion'          =>  $idopcion,                        
                         ]);
    }

    //SALUD - OTRO FAMILIAR
    public function actionAjaxTabSaludAgregarOtroFamiliar(Request $request)
    {

        $idopcion       =   $request['idopcion'];

        $ficha_id       =   $this->decodificar($request['idficha']);
        $registro_id    =   $request['idregistro'];

        $familiar_id        =   $request['familiar_id'];
        $enfermedad         =   $request['cadenfermedad'];
        $auxreg             =   Familiar::find($familiar_id);
        $nombrefamiliar     =   $auxreg->apellidopaterno.' '.$auxreg->apellidomaterno.' '.$auxreg->nombres;



        try{
            DB::beginTransaction();

            $idnuevo        =   $this->ge_getNuevoId('saludfamiliares');

            $familiar                       =   new SaludFamiliar();
            $familiar->id                   =   $idnuevo;
            $familiar->ficha_id             =   $ficha_id;

            $familiar->familiar_id          =   $familiar_id;
            $familiar->parentesco_id        =   $auxreg->parentesco_id;
            $familiar->parentesco           =   $auxreg->parentesco;
            $familiar->nombrefamiliar       =   $nombrefamiliar;
            $familiar->enfermedad           =   $enfermedad;

            $familiar->created_at           =   $this->fechaactual;
            $familiar->save();  

            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
            // dd($mensaje);
            // $mensaje  = 'Ocurrio un error al intentar Guardar la información';
        }

        $listafamiliares      =   SaludFamiliar::where('ficha_id',$ficha_id)->where('activo','=','1')->get();
        // dd($listafamiliares);
        return View::make($this->rutaview.'/tabs/salud/ajax/ajaxtsalud',
                         [                  
                            'listafamiliares'   => $listafamiliares,
                            'ajax'              => true,
                            'swelim'   => true,
                            'idopcion'          =>  $idopcion,                        
                         ]);

    }

    public function actionAjaxTabSaludEliminarOtroFamiliar(Request $request)
    {
        $idopcion       =   $request['idopcion'];
        $ficha_id       =   $request['idficha'];
        $registro_id    =   $request['idregistro'];
        try{
            DB::beginTransaction();
            SaludFamiliar::where('id','=',$registro_id)
                        ->update(
                            [
                                'activo'=>0,
                                'updated_at'=>$this->fechaactual
                            ]
                        );

            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
        }

        $listafamiliares      =   SaludFamiliar::where('ficha_id',$ficha_id)->where('activo','=','1')->get();
        // dd($listafamiliares);
        return View::make($this->rutaview.'/tabs/salud/ajax/ajaxtsalud',
                         [                  
                            'listafamiliares'   => $listafamiliares,
                            'ajax'              => true,
                            'swelim'   => true,
                            'idopcion'          =>  $idopcion,                        
                         ]);
    }

    //SALUD - MORTALIDAD
    public function actionAjaxTabSaludAgregarOtroMortalidad(Request $request)
    {

        $idopcion       =   $request['idopcion'];

        $ficha_id               =   $this->decodificar($request['idficha']);
        $registro_id            =   $request['idregistro'];

        $parentesco_id          =   $request['parentesco_id'];
        $parentesco             =   $request['parentesco'];
        $lugarfallecimiento_id  =   $request['lugarfallecimiento_id'];
        $lugarfallecimiento     =   $request['lugarfallecimiento'];
        $cadlugarfallecimiento  =   $request['cadlugarfallecimiento'];
        $enfermedad             =   $request['cadenfermedad'];
        $nombrefamiliar         =   $request['nombrefamiliar'];
        $enfermedad             =   $request['enfermedad'];

        try{
            DB::beginTransaction();

            $idnuevo        =   $this->ge_getNuevoId('saludmortalidad');

            $cabecera                       =   new SaludMortalidad();
            $cabecera->id                   =   $idnuevo;
            $cabecera->ficha_id             =   $ficha_id;
            $cabecera->parentesco_id        =   $parentesco_id;
            $cabecera->parentesco           =   $parentesco;
            $cabecera->nombrefamiliar       =   $nombrefamiliar;
            $cabecera->enfermedad           =   $enfermedad;
            $cabecera->lugarfallecimiento_id=   $lugarfallecimiento_id;
            $cabecera->lugarfallecimiento   =   $lugarfallecimiento;
            $cabecera->cadlugarfallecimiento   =   $cadlugarfallecimiento;
            $cabecera->created_at           =   $this->fechaactual;
            $cabecera->save();  

            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
            dd($mensaje);
            // $mensaje  = 'Ocurrio un error al intentar Guardar la información';
        }

        $listafamiliares      =   SaludMortalidad::where('ficha_id',$ficha_id)->where('activo','=','1')->get();
        // dd($listafamiliares);
        return View::make($this->rutaview.'/tabs/salud/ajax/ajaxtsaludmortalidad',
                         [                  
                            'listafamiliares'   => $listafamiliares,
                            'ajax'              => true,
                            'swelim'   => true,
                            'idopcion'          =>  $idopcion,                        
                         ]);

    }

    public function actionAjaxTabSaludEliminarOtroMortalidad(Request $request)
    {
        $idopcion       =   $request['idopcion'];
        $ficha_id       =   $request['idficha'];
        $registro_id    =   $request['idregistro'];
        try{
            DB::beginTransaction();
            SaludMortalidad::where('id','=',$registro_id)
                        ->update(
                            [
                                'activo'=>0,
                                'updated_at'=>$this->fechaactual
                            ]
                        );

            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
        }

        $listafamiliares      =   SaludMortalidad::where('ficha_id',$ficha_id)->where('activo','=','1')->get();
        // dd($listafamiliares);
        return View::make($this->rutaview.'/tabs/salud/ajax/ajaxtsaludmortalidad',
                         [                  
                            'listafamiliares'   => $listafamiliares,
                            'ajax'              => true,
                            'swelim'   => true,
                            'idopcion'          =>  $idopcion,                        
                         ]);
    }

    //SITUACION ECONOMICA
    public function actionAjaxTabSituacionEconomicaAgregarOtroFamiliar(Request $request)
    {

        $idopcion               =   $request['idopcion'];

        $ficha_id               =   $this->decodificar($request['idficha']);
        $registro_id            =   $request['idregistro'];
        $familiar_id            =   $request['familiar_id'];

        $auxreg                 =   Familiar::find($familiar_id);
        $nombrefamiliar         =   $auxreg->apellidopaterno.' '.$auxreg->apellidomaterno.' '.$auxreg->nombres;
        $familiar_id            =   $auxreg->id;

        $parentesco_id          =   $auxreg->parentesco_id;
        $parentesco             =   $auxreg->parentesco;
        $ocupacionprincipal     =   $request['ocupacionprincipal'];
        $remuneracionmensual    =   $request['remuneracionmensual'];
        $frecuenciaactividad    =   $request['frecuenciaactividad'];
        $frecuenciaactividad_id =   $request['frecuenciaactividad_id'];
        $actividadesextras      =   $request['actividadesextras'];
     
        try{
            DB::beginTransaction();

            $idnuevo        =   $this->ge_getNuevoId('actividadeseconomicas');

            $cabecera                           =   new ActividadEconomica();
            $cabecera->id                       =   $idnuevo;
            $cabecera->ficha_id                 =   $ficha_id;
            $cabecera->familiar_id              =   $familiar_id;
            $cabecera->parentesco_id            =   $parentesco_id;
            $cabecera->parentesco               =   $parentesco;
            $cabecera->nombrefamiliar           =   $nombrefamiliar;
            $cabecera->ocupacionprincipal       =   $ocupacionprincipal;
            $cabecera->remuneracionmensual      =   $remuneracionmensual;
            $cabecera->frecuenciaactividad      =   $frecuenciaactividad;
            $cabecera->frecuenciaactividad_id   =   $frecuenciaactividad_id;
            $cabecera->actividadesextras        =   $actividadesextras;

            $cabecera->created_at               =   $this->fechaactual;
            $cabecera->save();  

            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
            dd($mensaje);
            // $mensaje  = 'Ocurrio un error al intentar Guardar la información';
        }

        $listafamiliares      =   ActividadEconomica::where('ficha_id',$ficha_id)->where('activo','=','1')->get();
        // dd($listafamiliares);
        return View::make($this->rutaview.'/tabs/situacioneconomica/ajax/ajaxtsituacioneconomica',
                         [                  
                            'listafamiliares'   => $listafamiliares,
                            'ajax'              => true,
                            'swelim'   => true,
                            'idopcion'          =>  $idopcion,                        
                         ]);

    }

    public function actionAjaxTabSituacionEconomicaEliminarOtroFamiliar(Request $request)
    {
        $idopcion       =   $request['idopcion'];
        $ficha_id       =   $request['idficha'];
        $registro_id    =   $request['idregistro'];
        try{
            DB::beginTransaction();
            ActividadEconomica::where('id','=',$registro_id)
                        ->update(
                            [
                                'activo'=>0,
                                'updated_at'=>$this->fechaactual
                            ]
                        );

            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
        }

        $listafamiliares      =   ActividadEconomica::where('ficha_id',$ficha_id)->where('activo','=','1')->get();
        // dd($listafamiliares);
        return View::make($this->rutaview.'/tabs/situacioneconomica/ajax/ajaxtsituacioneconomica',
                         [                  
                            'listafamiliares'   => $listafamiliares,
                            'ajax'              => true,
                            'swelim'   => true,
                            'idopcion'          =>  $idopcion,                        
                         ]);
    }

    public function actionAjaxActualizarTabDatosSituacionEconomicaBienes(Request $request)
    {

        $idopcion       =   $request['idopcion'];
        $registro_id    =   $this->decodificar($request['idregistro']);
        $user_id            =   Session::get('usuario')->id;

        $otrosbienes    =   $request['otrosbienes'];
        $bienes         =   $request['bienes'];

        $guardarvivienda=   $this->ge_guardarvivienda('bienes',$user_id,$registro_id,$bienes);

        $mensaje        =   'Ocurrio un error con los parametros';
        $error          =   true;
        $sw             =   1;

        try{
            DB::beginTransaction();
            Registro::where('id','=',$registro_id)
                ->update(
                    [
                        'updated_at'        =>  $this->fechaactual,
                        'otrosbienes'       =>  $otrosbienes
                    ]
                );
            $sw     =   0;
            $mensaje=   'Actualizacion Correcta';            
            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
            // $mensaje  = 'Ocurrio un error al intentar Guardar la información';
        }

        if($sw == 0) {
            $mensaje = $mensaje;
            $error   =  false;
        }
                                        
        $response[] = array(
            'error'      => $error,
            'mensaje'    => $mensaje,
        );

        if($response[0]['error']){echo json_encode($response); exit();}
        echo json_encode($response);
    }

    
    public function actionListarDocumentosFichaSocioEconomica($idopcion,$idficha)
    {

         /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Ver');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        View::share('titulo','Documentos Ficha SocioEconomica');

        $user_id            =   Session::get('usuario')->id;
        $rol_id             =   $this->ge_getRolEncuestador();

        $ficha_id = $this->decodificar($idficha);
        $ficha  =   Registro::find($ficha_id);
        $idregistro = Hashids::encode($ficha_id);
        $listadatos         =   DocumentosFicha::where('ficha_id', '=', $ficha_id)->where('activo','=',1)
                                ->get();

        return View::make($this->rutaview.'/listadocumentos',
            [
                'idopcion'          =>  $idopcion,
                'idregistro'          =>  $idregistro,
                'view'              =>  $this->rutaviewblade,
                'url'               =>  $this->urlopciones,
                'urlcompleta'       =>  $this->urlprincipal,
                'ruta'              =>  $this->ruta,
                'idmodal'           =>  $this->idmodal,
                'listadatos'        =>  $listadatos,
                'ficha'             =>  $ficha,
                'swmodificar'            =>  1
            ]);
    }


    
    public function actionAgregarDocumentosFichaSocioEconomica($idopcion,$idregistro, Request $request) 
    {

        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Anadir');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        $ficha_id  =   $this->decodificar($idregistro);     
        if ($_POST) {
            $nombre='';
            try{
                DB::beginTransaction();
                
                $files                  =   $request['files'];   
                $ficha              =   Registro::where('id','=',$ficha_id)->first();
                $listadetalledoc    =   DocumentosFicha::where('ficha_id','=',$ficha_id)->get();
                $index              =   0;
                if(!is_null($files)){
                    foreach($files as $file)
                    {

                        $numero = count($listadetalledoc)+$index+1;
                        $nombre = $ficha->codigo.'-'.$numero.'-'.$file->getClientOriginalName();
                        \Storage::disk('local')->put($nombre,  \File::get($file));
                        $codigo                 =       $this->ge_getCodigoTabla('documentosficha');
                        $idnuevo                =   $this->ge_getNuevoId('documentosficha');
                        $cabecera               = new DocumentosFicha();

                        $cabecera->id           = $idnuevo;
                        $cabecera->descripcion  = $nombre;
                        $cabecera->codigo       = $codigo;

                        $cabecera->ficha_id     = $ficha_id;
                        $cabecera->fechacrea    = $this->fechaactual;
                        $cabecera->usercrea     = Session::get('usuario')->id;
                        $cabecera->save();
                        $index++;
                    }
                }

                DB::commit();
            }catch(\Exception $ex){
                DB::rollback(); 
                $sw =   1;
                $mensaje  = $this->ge_getMensajeError($ex);
                // dd($mensaje);
                // $mensaje  = 'Ocurrio un error al intentar Guardar la información';
            }
                
            return Redirect::to('/gestion-documentos-ficha-socioeconomica/' . $idopcion.'/'.$idregistro)->with('bienhecho', 'Documento' . $nombre . ' registrado con exito');

        } else {


            $ficha= Registro::find($ficha_id);
            
            $funcion = $this;

            $listadocumentos = DocumentosFicha::where('ficha_id','=',$ficha_id)->where('activo','=',1)->get();

            return View::make('fichasocioeconomica/agregardocumento',
                [
                    'idregistro'    =>  $idregistro,
                    'listadetalle' => $listadocumentos,
                    'idopcion' => $idopcion,
                ]);

        }
    }

    public function actionEliminarDocumentosFichaSocioEconomica($idopcion,$idficha,$idregistro,Request $request)
    {
      
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Eliminar');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        $ficha_id       = $this->decodificar($idficha);
        $registro_id    = $this->decodificar($idregistro);
        $documento = DocumentosFicha::where('id','=',$registro_id)->first();
        try{
            DB::beginTransaction();
            DocumentosFicha::where('id','=',$registro_id)
                        ->update(
                            [
                                'activo'=>0,
                                'updated_at'=>$this->fechaactual
                            ]
                        );

            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
        }

        $listadocumentos      =   DocumentosFicha::where('ficha_id',$ficha_id)->where('activo','=','1')->get();
        // dd($listadocumentos);
        return Redirect::to('/gestion-documentos-ficha-socioeconomica/' . $idopcion.'/'.$idficha)->with('bienhecho', 'Documento' . $documento->nombre . ' Eliminado con exito');

    }

    public function actionDescargarDocumentosFichaSocioEconomica($idregistro)
    {
        $registro_id   =   $this->decodificar($idregistro);
        $documento     =   DocumentosFicha::where('id','=',$registro_id)->first();
        $path = storage_path('app/'.$documento->descripcion);
        if (file_exists($path)) {
            return Response::download($path);
        }

    }

     //SITUACION ECONOMICA
    public function actionAjaxTabSituacionEconomicaAgregarDocumentosFicha(Request $request)
    {

        $idopcion           =   $request['idopcion'];

        $ficha_id           =   $this->decodificar($request['idficha']);
        $registro_id        =   $request['idregistro'];
        $ficha              =   Registro::where('id','=',$ficha_id)->first();
        $file              =   $request['files'];     
        $archivos           =   $request['archivos'];
        dd($file);
        // dd($files);
        try{
            DB::beginTransaction();

            $listadetalledoc    =   DocumentosFicha::where('ficha_id','=',$ficha_id)->get();
            $index              =   0;

            if(!is_null($file)){
                $numero = count($listadetalledoc)+$index+1;
                $nombre = $ficha->codigo.'-'.$numero.'-'.$file->getClientOriginalName();
                \Storage::disk('local')->put($nombre,  \File::get($file));

                $idnuevo                =   $this->ge_getNuevoId('actividadeseconomicas');
                $cabecera               = new DocumentosFicha();
                $cabecera->id           = $idnuevo;
                $cabecera->descripcion  = $nombre;

                $cabecera->ficha_id     = $ficha_id;
                $cabecera->fechacrea    = $this->fechaactual;
                $cabecera->usuariocrea = Session::get('usuario')->id;
                $cabecera->save();
            }

            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
            dd($mensaje);
            // $mensaje  = 'Ocurrio un error al intentar Guardar la información';
        }

        $listadocumentos      =   DocumentosFicha::where('ficha_id',$ficha_id)->where('activo','=','1')->get();
        return View::make($this->rutaview.'/tabs/situacioneconomica/ajax/ajaxtsituacioneconomica',
                         [                  
                            'listadocumentos'   => $listadocumentos,
                            'ajax'              => true,
                            'swelim'   => true,
                            'idopcion'          =>  $idopcion,       
                            'swmodificar'            =>  1                 
                         ]);

    }

   

    public function actionAjaxDocumentosFicha(Request $request)
    {

        // $observacion            =   $request['observacion'];
        $ficha_id               =   $request['ficha_id'];
        // $tab                    =   $request['tab'];
        $idopcion               =   $request['idopcion'];
        // $data_descripcion       =   $request['data_descripcion'];
        // $ficha_id_de                   =   $this->decodificar($ficha_id);
         // dd('sasdasdas');
        // $observaciontext = '';
        // $obs = Observacion::where('tab_observacion','=', $tab)
        //                     ->where('ficha_id','=', $ficha_id_de)
        //                     ->first();
        // if(count($obs)>0){
        //     $observaciontext = $obs->observacion;
        // }


        return View::make('fichasocioeconomica/tabs/documentosficha/ajax/amdocumentos',
                         [          
                            // 'observacion'       => $observaciontext,
                            'ficha_id'          => $ficha_id,
                            // 'tab'               => $tab,
                            'idopcion'          => $idopcion,
                            // 'data_descripcion'  => $data_descripcion,                       
                         ]);

    }

    //ESTADOS FICHA SOCIOECONOMICA
    
    public function actionEliminarFichaSocioEconomica($idopcion,$idregistro)
    {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Eliminar');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/

        $registro_id    = $this->decodificar($idregistro);
        $documento = Registro::where('id','=',$registro_id)->first();
        try{
            DB::beginTransaction();
            Registro::where('id','=',$registro_id)
                        ->update(
                            [
                                'activo'=>0,
                                'updated_at'=>$this->fechaactual
                            ]
                        );
            $this->setLogFichaSocioEconomica($registro_id,'Eliminar-Ficha-Socioeconomica','');
            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
        }
        return Redirect::to('/gestion-ficha-socieconomica/' . $idopcion)->with('bienhecho', 'Ficha :' . $documento->codigo . ' Eliminado con exito');
    }

    public function actionReevaluarFichaSocioEconomica($idopcion,$idregistro,Request $request)
    {
       /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Anadir');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        View::share('titulo','Reevaluar Ficha SocioEconomica');
        $user_id            =   Session::get('usuario')->id;
        $generado           =   Estado::where('descripcion','=','GENERADO')->first();
        $usuario            =   User::find($user_id);
        $registro_id        =   $this->decodificar($idregistro);
        $fichaanterior          =   Registro::find($registro_id);
        if ($_POST) {
            $terminado       =   Estado::where('descripcion','=','TERMINADO')->first();

            $indclonarbeneficiario  =  (int) $request['indclonarbeneficiario'];
            $indclonardatos         =  (int) $request['indclonardatos'];
            // $indclonartpif          =  (int) $request['indclonartpif'];
            $indclonartpsa          =  (int) $request['indclonartpsa'];
            $indclonartpse          =  (int) $request['indclonartpse'];
            $indclonartpbe          =  (int) $request['indclonartpbe'];
            $indclonartpvi          =  (int) $request['indclonartpvi'];
            $indclonartpcf          =  (int) $request['indclonartpcf'];
            $datos = compact('indclonartpsa','indclonartpse','indclonartpbe','indclonartpvi','indclonartpcf');
            // dd($datos);
            $beneficiario           =   $this->ge_getBeneficiario($registro_id);
            // $beneficiario_id    =   (int)$request['beneficiario_id'];
            $user_id            =   Session::get('usuario')->id;

            $sw                 =   0;
            $error              =   true;

            try{
                DB::beginTransaction();
               

              


                $codigo='';
                $fecha                        =   date('Y-m-d',strtotime($request['fecharegistro']));
                $codigo                       =   $this->ge_getCodigoTabla($this->tregistro);
                $idnuevo                      =   $this->ge_getNuevoId($this->tregistro);
               
                $registro                     =   new Registro();
                $registro->id                 =   $idnuevo;
                $registro->codigo             =   $codigo;
                $registro->fecha              =   $fecha;
                $registro->encuestador_id     =   $usuario->id;
                $registro->estado_id          =   $generado->id;
                $registro->activo             =   1;
                $registro->save();
                $ficha_id                     =    $idnuevo;

                Registro::where('id','=',$registro_id)
                            ->update(
                                [
                                    'estado_id'=>$terminado->id,
                                    'updated_at'=>$this->fechaactual,
                                ]
                            );

                HistorialFicha::where('ficha_id','=',$registro_id)
                        ->where('vigencia','=',1)
                        ->update([
                            'vigencia'=>0,
                            'fechafin'=>$fecha,
                            'updated_at'=>date('Y-m-d H:i:s'),
                            'usermod'=>Session::get('usuario')->id,
                            'fechamod'=>date('Y-m-d H:i:s'),
                        ]);

                // $indclonar                  =   (int)$request['indclonar'];

                if($indclonardatos==1){  
                    
                    //datosgenerales              
                    $clonardatosgenerales       =   $this->clonardatosgenerales($ficha_id,$beneficiario,$user_id);
                    $clonarobsdatosgenerales    =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'datosgenerales');
                    $cad = ' datos generales ';
                    // if($indclonartpif==1){
                        //informacion familiar
                        $clonarinformacionfamiliar  =   $this->clonarinformacionfamiliar($ficha_id,$beneficiario,$user_id);
                        $clonarobsinformacionfamiliar    =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'informacionfamiliar');
                    // }
                    
                    if($indclonartpsa==1){
                        //salud
                        $clonarobssalud    =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'salud');
                        $clonarmortalidad  =   $this->clonarmortalidad($ficha_id,$beneficiario,$user_id);
                        $cad .= '/ datos salud ';

                    }
                    
                    if($indclonartpse==1){
                        //situacioneconomica
                        $clonarsituacioneconomica   =   $this->clonarsituacioneconomica($ficha_id,$beneficiario,$user_id);
                        $clonarobssituacioneconomica   =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'situacioneconomica');
                        $cad .= '/ datos situacion economica ';

                    }
                    
                    if($indclonartpbe==1){
                        //beneficios
                        $clonarobsbeneficios   =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'beneficios');
                        $cad .= '/ datos beneficios ';
                    }

                    if($indclonartpvi==1){
                        //vivienda
                        $clonarvivienda  =   $this->clonarvivienda($ficha_id,$beneficiario,$user_id);
                        $clonarobsvivienda   =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'vivienda');
                        $cad .= '/ datos vivienda ';
                    }
                    if($indclonartpcf==1){
                        //convivencia familiar
                        $clonarobsconvivenciafamiliar   =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'convivenciafamiliar');
                        $clonarconvivenciafamiliar =   $this->clonarconvivenciafamiliar($ficha_id,$beneficiario,$user_id);
                        $cad .= '/ datos convivencia familiar ';
                    }
                }

                $descripcion = strval($this->fechaactual).' : Ficha Anterior: '.$fichaanterior->id.' / Ficha Actual: '.$idnuevo. ' /'.$cad;
                $this->setLogFichaSocioEconomica($idnuevo,'Reevaluar-Ficha-Socioeconomica',$descripcion);
                DB::commit();

            }catch(\Exception $ex){
                DB::rollback(); 
                $sw =   1;
                $mensaje  = $this->ge_getMensajeError($ex);
                // dd($mensaje);
                // $mensaje  = 'Ocurrio un error al intentar Guardar la información';
                return Redirect::to('/reevaluar-ficha-socieconomica/' . $idopcion.'/'.$idregistro)->with('errorbd', $mensaje);

            }
            return Redirect::to('/gestion-ficha-socieconomica/' . $idopcion)->with('bienhecho', 'Ficha ' . $codigo . ' Reevaluada con exito');
        } 
        else 
        {

            $beneficiario           =   $this->ge_getBeneficiario($registro_id);
            if(empty($beneficiario)){
                return Redirect::to('/gestion-ficha-socieconomica/' . $idopcion)->with('errorbd', 'Ficha ' . $fichaanterior->codigo . ' No tiene Usuario Registrado');
            }

            $combobeneficiario      =   $this->ge_getComboBeneficiarioClonarTodos();
            return View::make($this->rutaview.'/reevaluarficha',
                                    [
                                        'idopcion'           =>  $idopcion,
                                        'idregistro'         =>  $idregistro,
                                        'combobeneficiario'  =>  $combobeneficiario,
                                        'view'               =>  $this->rutaviewblade,
                                        'url'                =>  $this->urlopciones,
                                        'beneficiario'      =>  $beneficiario,
                                        'registro'          =>  $fichaanterior,
                                    ]);
        }

    }

    public function actionTerminarFichaSocioEconomica($idopcion,$idregistro,Request $request)
    {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Modificar');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        $registro_id    =   $this->decodificar($idregistro);
        $ficha_id       =   $registro_id;
        $terminado       =   Estado::where('descripcion','=','TERMINADO')->first();
        if($_POST)
        {

            $ficha      =   Registro::where('id','=',$registro_id)->first();
            $fechafin       =   date('Y-m-d',strtotime($request['fecha']));
            $historialvigente = HistorialFicha::where('ficha_id','=',$ficha_id)->where('vigencia','=',1)->first();
            if(!is_null($historialvigente)){
                if($this->isfechaMenor($fechafin,$historialvigente->fechainicio)){
                    return Redirect::to('/terminar-ficha-socieconomica/' . $idopcion.'/'.$idregistro)->with('errorbd', 'La fecha Fin:'.$fechafin.' debe ser mayor o igual a la Fecha de Aprobacion: '.$historialvigente->fechainicio);
                }
            }

            try{
                DB::beginTransaction();
                $descripcion    =   $request['descripcion'];

                Registro::where('id','=',$registro_id)
                            ->update(
                                [
                                    'estado_id'=>$terminado->id,
                                    'updated_at'=>$this->fechaactual,
                                ]
                            );
                // $this->ge_fnAprobarFichaSocioEconomica($registro_id);

                HistorialFicha::where('ficha_id','=',$ficha_id)
                        ->where('vigencia','=',1)
                        ->update([
                            'vigencia'  =>0,
                            'fechafin'  =>$fechafin,
                            'updated_at'    =>date('Y-m-d H:i:s'),
                            'usermod'   =>Session::get('usuario')->id,
                            'fechamod'  =>date('Y-m-d H:i:s'),
                        ]);

                $this->setLogFichaSocioEconomica($ficha_id,'Terminar-Ficha-Socioeconomica',$descripcion);

                DB::commit();
            }catch(\Exception $ex){
                DB::rollback(); 
                $sw =   1;
                $mensaje  = $this->ge_getMensajeError($ex);
                return Redirect::to('/gestion-ficha-socieconomica/' . $idopcion)->with('errorbd', $mensaje);

            }

            return Redirect::to('/gestion-ficha-socieconomica/' . $idopcion)->with('bienhecho', 'Ficha :' . $ficha->codigo . ' Terminada con exito');

        }
        else
        {

        // return Redirect::to('/gestion-ficha-socieconomica/' . $idopcion)->with('bienhecho', 'Ficha :' . $documento->codigo . ' Aprobado con exito');

            $registro   = Registro::find($ficha_id);
            $idregistro = Hashids::encode($registro->id);
            $funcion    = $this;
            return View::make('fichasocioeconomica/terminarficha',
                [
                    'idregistro'    =>  $idregistro,
                    'registro'      =>  $registro,
                    'idopcion'      =>  $idopcion,
                ]);

        }   


    }


    public function actionVerDetalleDocumentosFichaSocioEconomica($idopcion,$idficha)
    {

         /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Ver');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        View::share('titulo','Documentos Ficha SocioEconomica');

        $user_id            =   Session::get('usuario')->id;
        $rol_id             =   $this->ge_getRolEncuestador();

        $ficha_id   =   $this->decodificar($idficha);
        $ficha      =   Registro::find($ficha_id);
        $idregistro =   Hashids::encode($ficha_id);
        $listadatos         =   DocumentosFicha::where('ficha_id', '=', $ficha_id)->where('activo','=',1)
                                ->get();

        return View::make($this->rutaview.'/listadocumentos',
            [
                'idopcion'          =>  $idopcion,
                'idregistro'          =>  $idregistro,
                'view'              =>  $this->rutaviewblade,
                'url'               =>  $this->urlopciones,
                'urlcompleta'       =>  $this->urlprincipal,
                'ruta'              =>  $this->ruta,
                'idmodal'           =>  $this->idmodal,
                'listadatos'        =>  $listadatos,
                'ficha'             =>  $ficha,
                'swmodificar'            =>  0,
            ]);
    }

    public function actionVerDetalleFichaSocioEconomica($idopcion,$idregistro) {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Ver');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        View::share('titulo','Detalle Ficha SocioEconomica');
        $user_id            =   Session::get('usuario')->id;
        $registro_id    =   $this->decodificar($idregistro);


        $swmodificar = 0;
        $registro           =   Registro::find($this->decodificar($idregistro));
        // $combodepartamentos =   $this->ge_getComboDepartamentos(13);
        if(!is_null($registro->departamento_id)){
            $combodepartamentos =   $this->ge_getComboDepartamentos($registro->departamento_id);
            $comboprovincias   =   $this->ge_getComboProvincias($registro->provincia_id);
        }
        else{
            $combodepartamentos =   $this->ge_getComboDepartamentos(13);
            $comboprovincias   =   $this->ge_getComboProvinciasDepartamento(13);
        }

        $combodistritos     =   $this->ge_getComboDistritos($registro->distrito_id);
        $idregistro         =   $this->codificar($registro->id);

        //TABS INFORMACION FAMILIAR        
        $beneficiario       =   $this->ge_getBeneficiario($registro->id);
        $comboparentesco    =   $this->ge_getComboConceptos($this->codparentesco);

        if(!is_null($beneficiario)){
            $comboestadocivil       =   $this->ge_getComboConceptos($this->codestadocivil,$beneficiario->estadocivil_id);
            $comboniveleducativo    =   $this->ge_getComboConceptos($this->codniveleducativo,$beneficiario->niveleducativo_id);
            $combotipodeseguro      =   $this->ge_getComboConceptos($this->codtipodeseguro,$beneficiario->tiposeguro_id);
        }
        else{
            $comboestadocivil       =   $this->ge_getComboConceptos($this->codestadocivil);
            $comboniveleducativo    =   $this->ge_getComboConceptos($this->codniveleducativo);
            $combotipodeseguro      =   $this->ge_getComboConceptos($this->codtipodeseguro);
        }

        $comboparentescoof          =   $this->ge_getComboConceptos($this->codparentesco);
        $comboestadocivilof         =   $this->ge_getComboConceptos($this->codestadocivil);
        $comboniveleducativoof      =   $this->ge_getComboConceptos($this->codniveleducativo);
        $combotipodeseguroof        =   $this->ge_getComboConceptos($this->codtipodeseguro);

        $listafamiliares            =   $this->ge_getListaFamiliares($registro->id);

        $combofamiliares            =   $this->ge_getComboFamiliares($registro->id);


        //TABS SALUD        
        $listadiscapacidadbeneficiario= $this->ge_getListaDiscapacidadBeneficiarios($registro->id);
        $saludbeneficiario          =   $this->ge_getSaludBeneficiario($registro->id);
        $comboparentesco            =   $this->ge_getComboConceptos($this->codparentesco);
        
     

            $combodiscapacidad     =   $this->ge_getComboConceptos($this->coddiscapacidad);
            $comboniveldiscapacidad=   $this->ge_getComboConceptos($this->codniveldediscapacidad);
            $combotipodesegurobe     =   $this->ge_getComboConceptos($this->codtipodeseguro);

       

        $combodiscapacidadsaludof       =   $this->ge_getComboConceptos($this->coddiscapacidad);
        $comboniveldiscapacidadsaludof  =   $this->ge_getComboConceptos($this->codniveldediscapacidad);
        $combotipodesegurosaludof       =   $this->ge_getComboConceptos($this->codtipodeseguro);
        $comboparentescosaludof         =   $this->ge_getComboConceptos($this->codparentesco);
        
        $comboestadocivilsa             =   $this->ge_getComboConceptos($this->codestadocivil);
        $comboniveleducativosa          =   $this->ge_getComboConceptos($this->codniveleducativo);
        $listafamiliaressalud           =   $this->ge_getListaFamiliaresSalud($registro->id);


        //MORTALIDAD
        $combolugarfallecimientomo      =   $this->ge_getComboConceptos($this->codlugardefallecimiento);
        $listafamiliaresmortalidad      =   $this->ge_getListaFamiliaresMortalidad($registro->id);
        // codlugardefallecimiento

        //FICHA SOCIOECONOMICA
        $listabienes                    =   $this->ge_getlistaConceptos($this->codbienes);
        $bienes                         =   Vivienda::where('concepto','=', 'bienes')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('materialvivienda_id')->toArray();
        $listaactividadeseconomicas     =   $this->ge_getListaActividadesEconomicas($registro_id);
        $combofrecuenciaactividad       =   $this->ge_getComboConceptos($this->codfrecuenciaactividad);
        //vivienda
        $combotenenciavivienda             =   $this->ge_getComboConceptos($this->codtenenciadevivienda,$registro->tenenciavivienda_id);
        $comboacreditepropiedadvivienda    =   $this->ge_getComboConceptos($this->coddocumentaciondevivienda,$registro->acreditepropiedadvivienda_id);

        $combomaterialparedesvivienda   =   $this->ge_getComboConceptos($this->codmaterialdelavivienda,$registro->materialparedesvivienda_id);
        $combomaterialtechosvivienda    =   $this->ge_getComboConceptos($this->codmaterialdelavivienda,$registro->materialtechosvivienda_id);
        $combomaterialpisosvivienda     =   $this->ge_getComboConceptos($this->codmaterialdelavivienda,$registro->materialpisosvivienda_id);
        $comboalumbradopublicovivienda  =   [''=>'Seleccione Opcion','SI'=>'SI','NO'=>'NO'];

        $listaserviciopublicos          =   $this->ge_getlistaConceptos($this->codserviciospublicos);
        $serviciopublicos               =   Vivienda::where('concepto','=', 'serviciopublicos')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('materialvivienda_id')->toArray();

        $listaabastecimientoagua        =   $this->ge_getlistaConceptos($this->codabastecimientoagua);
        $abastecimientoagua             =   Vivienda::where('concepto','=', 'abastecimientoagua')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('materialvivienda_id')->toArray();

        $listaservicioshigienicos       =   $this->ge_getlistaConceptos($this->codservicioshigienicos);
        $servicioshigienicos             =   Vivienda::where('concepto','=', 'servicioshigienicos')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('materialvivienda_id')->toArray();



        //convivenciafamiliar

        $listatipoviolenciageneral      =   $this->ge_getlistaConceptos($this->codtipodeviolenciafamiliar);
        $tipoviolenciageneral           =   ConvivenciaFamiliar::where('concepto','=', 'tipoviolenciageneral')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('conceptodetalle_id')->toArray();

        $listatipoviolenciahijo         =   $this->ge_getlistaConceptos($this->codtipodeviolenciafamiliar);
        $tipoviolenciahijo              =   ConvivenciaFamiliar::where('concepto','=', 'tipoviolenciahijo')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('conceptodetalle_id')->toArray();

        $listainstitucionhijo           =   $this->ge_getlistaConceptos($this->codinstitucionapoyoviolencia);
        $institucionhijo                =   ConvivenciaFamiliar::where('concepto','=', 'institucionhijo')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('conceptodetalle_id')->toArray();

        $listatipoviolenciaabuelo       =   $this->ge_getlistaConceptos($this->codtipodeviolenciafamiliar);
        $tipoviolenciaabuelo            =   ConvivenciaFamiliar::where('concepto','=', 'tipoviolenciaabuelo')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('conceptodetalle_id')->toArray();

        $listainstitucionabuelo         =   $this->ge_getlistaConceptos($this->codinstitucionapoyoviolencia);
        $institucionabuelo              =   ConvivenciaFamiliar::where('concepto','=', 'institucionabuelo')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('conceptodetalle_id')->toArray();
        //beneficios
        $comboprogramabeneficiario      =   $this->ge_getComboConceptos($this->codprogramabeneficiario);
        $listabeneficios                =   $this->ge_getListaBeneficios($registro->id);


        $listadocumentos           =   $this->ge_getListaDocumentosFicha($registro->id);


        //observacion
        $odatosgenerales                =   $this->ge_getObservacion('datosgenerales',$registro_id);
        $oinformacionfamiliar           =   $this->ge_getObservacion('informacionfamiliar',$registro_id);
        $osalud                         =   $this->ge_getObservacion('salud',$registro_id);
        $osituacioneconomica            =   $this->ge_getObservacion('situacioneconomica',$registro_id);
        $obeneficios                    =   $this->ge_getObservacion('beneficios',$registro_id);
        $ovivienda                      =   $this->ge_getObservacion('vivienda',$registro_id);
        $oconvivenciafamiliar           =   $this->ge_getObservacion('convivenciafamiliar',$registro_id);
        $odocumentosficha               =   $this->ge_getObservacion('documentosficha',$registro_id);



        return View::make($this->rutaview.'/ficha',
            [
                'idopcion'                          =>      $idopcion,
                'idregistro'                        =>      $idregistro,
                'view'                              =>      $this->rutaviewblade,
                'url'                               =>      $this->urlopciones,
                'urlcompleta'                       =>      $this->urlprincipal,
                'ruta'                              =>      $this->ruta,
                'idmodal'                           =>      $this->idmodal,

                'combodepartamentos'                =>      $combodepartamentos,
                'comboprovincias'                   =>      $comboprovincias,
                'combodistritos'                    =>      $combodistritos,
                
                'registro'                          =>      $registro,
                'beneficiario'                      =>      $beneficiario,

                'comboestadocivil'                  =>      $comboestadocivil,
                'comboniveleducativo'               =>      $comboniveleducativo,
                'combotipodeseguro'                 =>      $combotipodeseguro,

                'listafamiliares'                   =>      $listafamiliares,

                'comboparentescoof'                 =>      $comboparentescoof,
                'comboestadocivilof'                =>      $comboestadocivilof,
                'comboniveleducativoof'             =>      $comboniveleducativoof,
                'combotipodeseguroof'               =>      $combotipodeseguroof,
                
                //salud 
                'saludbeneficiario'                 =>      $saludbeneficiario,
                'combodiscapacidad'                 =>      $combodiscapacidad,
                'comboniveldiscapacidad'            =>      $comboniveldiscapacidad,
                'combotipodesegurobe'                 =>      $combotipodesegurobe,

                'listadiscapacidadbeneficiario'     =>      $listadiscapacidadbeneficiario,

                'combofamiliares'                   =>      $combofamiliares,
                'comboparentescosaludof'            =>      $comboparentescosaludof,
                'combodiscapacidadsaludof'          =>      $combodiscapacidadsaludof,
                'comboniveldiscapacidadsaludof'     =>      $comboniveldiscapacidadsaludof,

                'combotipodesegurosaludof'          =>      $combotipodesegurosaludof,
                
                'listafamiliaressalud'              =>      $listafamiliaressalud,

                'comboparentesco'                   =>      $comboparentesco,
                'combolugarfallecimientomo'         =>      $combolugarfallecimientomo ,
                'listafamiliaresmortalidad'         =>      $listafamiliaresmortalidad,

                //fichasocieconomica
                'listabienes'                       =>      $listabienes,
                'bienes'                            =>      $bienes,
                'listaactividadeseconomicas'        =>      $listaactividadeseconomicas,
                'combofrecuenciaactividad'          =>      $combofrecuenciaactividad,

                'listadocumentos'                   =>      $listadocumentos,

                //vivienda
                'combotenenciavivienda'             =>      $combotenenciavivienda,
                'comboacreditepropiedadvivienda'    =>      $comboacreditepropiedadvivienda,
                'combomaterialparedesvivienda'      =>      $combomaterialparedesvivienda,
                'combomaterialtechosvivienda'       =>      $combomaterialtechosvivienda,
                'combomaterialpisosvivienda'        =>      $combomaterialpisosvivienda,
                'listaserviciopublicos'             =>      $listaserviciopublicos,
                'serviciopublicos'                  =>      $serviciopublicos,
                'listaabastecimientoagua'           =>      $listaabastecimientoagua,
                'abastecimientoagua'                =>      $abastecimientoagua,
                'listaservicioshigienicos'          =>      $listaservicioshigienicos,
                'servicioshigienicos'               =>      $servicioshigienicos,
                'comboalumbradopublicovivienda'     =>      $comboalumbradopublicovivienda,

                //convivenciafamiliar
                'listatipoviolenciageneral'         =>      $listatipoviolenciageneral,
                'tipoviolenciageneral'              =>      $tipoviolenciageneral,

                'listatipoviolenciahijo'            =>      $listatipoviolenciahijo,
                'tipoviolenciahijo'                 =>      $tipoviolenciahijo,
                'listainstitucionhijo'              =>      $listainstitucionhijo,
                'institucionhijo'                   =>      $institucionhijo,


                'listatipoviolenciaabuelo'          =>      $listatipoviolenciaabuelo,
                'tipoviolenciaabuelo'               =>      $tipoviolenciaabuelo,
                'listainstitucionabuelo'            =>      $listainstitucionabuelo,
                'institucionabuelo'                 =>      $institucionabuelo,

                //beneficios
                'comboprogramabeneficiario'         =>      $comboprogramabeneficiario,
                'listabeneficios'                   =>      $listabeneficios,

                //beneficios
                'odatosgenerales'                   =>      $odatosgenerales,
                'oinformacionfamiliar'              =>      $oinformacionfamiliar,
                'osalud'                            =>      $osalud,
                'osituacioneconomica'               =>      $osituacioneconomica,
                'obeneficios'                       =>      $obeneficios,
                'ovivienda'                         =>      $ovivienda,
                'oconvivenciafamiliar'              =>      $oconvivenciafamiliar,
                'odocumentosficha'                  =>      $odocumentosficha,

                'swmodificar'                       =>      $swmodificar,
            ]);
    }

    public function actionListarFichaSocioEconomicaPreAprobar($idopcion) {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Ver');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        View::share('titulo','Pre Aprobar Ficha SocioEconomica');
        $idestados          =   Estado::whereIn('descripcion',['GENERADO','PRE-APROBADO'])->pluck('id')->toArray();
        $user_id            =   Session::get('usuario')->id;
        $rol_id             =   $this->ge_getRolEncuestador();
        $comboencuestadores =   $this->ge_getComboEncuestadores($rol_id);    
        $listadatos         =   Registro::leftJoin('beneficiarios', 'beneficiarios.ficha_id', '=', 'fichasocioeconomica.id')
                                ->leftJoin('departamentos', 'departamentos.id', '=', 'fichasocioeconomica.departamento_id')
                                ->leftJoin('provincias', 'provincias.id', '=', 'fichasocioeconomica.provincia_id')
                                ->leftJoin('distritos', 'distritos.id', '=', 'fichasocioeconomica.distrito_id')
                                ->where('fichasocioeconomica.activo','=',1)
                                ->whereIn('fichasocioeconomica.estado_id',$idestados)
                                ->select(
                                        'fichasocioeconomica.*',
                                        'beneficiarios.dni',
                                        'beneficiarios.telefono',
                                        'beneficiarios.apellidopaterno',
                                        'beneficiarios.apellidomaterno',
                                        'beneficiarios.nombres',
                                        'departamentos.descripcion as departamento',
                                        'provincias.descripcion as provincia',
                                        'distritos.descripcion as distrito'
                                    )
                                ->selectRaw("'' as classcolorfila")
                                ->orderby('fichasocioeconomica.codigo','desc')
                                ->get();
        foreach($listadatos as $fila){
            // $classcolorfila = $this->ge_getClassColorEstado($fila->estado_id);
            // $fila->classcolorfila=$classcolorfila;
            $fila->classcolorfila=$this->colores[$fila->estado_id];
        }

        return View::make($this->rutaview.'/listapreaprobar',
            [
                'idopcion'          =>  $idopcion,
                'view'              =>  $this->rutaviewblade,
                'url'               =>  $this->urlopciones,
                'urlcompleta'       =>  $this->urlprincipal,
                'ruta'              =>  $this->ruta,
                'idmodal'           =>  $this->idmodal,
                'listadatos'        =>  $listadatos,
                'comboencuestadores'  =>  $comboencuestadores,
            ]);
    }

    public function actionVerDetallePreAprobarFichaSocioEconomica($idopcion,$idregistro) {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Ver');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        View::share('titulo','Detalle Ficha  SocioEconomica');
        $user_id            =   Session::get('usuario')->id;
        $registro_id    =   $this->decodificar($idregistro);


        $swmodificar = 0;
        $registro           =   Registro::find($this->decodificar($idregistro));
        // $combodepartamentos =   $this->ge_getComboDepartamentos(13);
        if(!is_null($registro->departamento_id)){
            $combodepartamentos =   $this->ge_getComboDepartamentos($registro->departamento_id);
            $comboprovincias   =   $this->ge_getComboProvincias($registro->provincia_id);
        }
        else{
            $combodepartamentos =   $this->ge_getComboDepartamentos(13);
            $comboprovincias   =   $this->ge_getComboProvinciasDepartamento(13);
        }

        $combodistritos     =   $this->ge_getComboDistritos($registro->distrito_id);
        $idregistro         =   $this->codificar($registro->id);

        //TABS INFORMACION FAMILIAR        
        $beneficiario       =   $this->ge_getBeneficiario($registro->id);
        $comboparentesco    =   $this->ge_getComboConceptos($this->codparentesco);

        if(!is_null($beneficiario)){
            $comboestadocivil       =   $this->ge_getComboConceptos($this->codestadocivil,$beneficiario->estadocivil_id);
            $comboniveleducativo    =   $this->ge_getComboConceptos($this->codniveleducativo,$beneficiario->niveleducativo_id);
            $combotipodeseguro      =   $this->ge_getComboConceptos($this->codtipodeseguro,$beneficiario->tiposeguro_id);
        }
        else{
            $comboestadocivil       =   $this->ge_getComboConceptos($this->codestadocivil);
            $comboniveleducativo    =   $this->ge_getComboConceptos($this->codniveleducativo);
            $combotipodeseguro      =   $this->ge_getComboConceptos($this->codtipodeseguro);
        }

        $comboparentescoof          =   $this->ge_getComboConceptos($this->codparentesco);
        $comboestadocivilof         =   $this->ge_getComboConceptos($this->codestadocivil);
        $comboniveleducativoof      =   $this->ge_getComboConceptos($this->codniveleducativo);
        $combotipodeseguroof        =   $this->ge_getComboConceptos($this->codtipodeseguro);

        $listafamiliares            =   $this->ge_getListaFamiliares($registro->id);

        $combofamiliares            =   $this->ge_getComboFamiliares($registro->id);


        //TABS SALUD        
        $listadiscapacidadbeneficiario= $this->ge_getListaDiscapacidadBeneficiarios($registro->id);
        $saludbeneficiario          =   $this->ge_getSaludBeneficiario($registro->id);
        $comboparentesco            =   $this->ge_getComboConceptos($this->codparentesco);
        
     

            $combodiscapacidad     =   $this->ge_getComboConceptos($this->coddiscapacidad);
            $comboniveldiscapacidad=   $this->ge_getComboConceptos($this->codniveldediscapacidad);
            $combotipodesegurobe     =   $this->ge_getComboConceptos($this->codtipodeseguro);

       

        $combodiscapacidadsaludof       =   $this->ge_getComboConceptos($this->coddiscapacidad);
        $comboniveldiscapacidadsaludof  =   $this->ge_getComboConceptos($this->codniveldediscapacidad);
        $combotipodesegurosaludof       =   $this->ge_getComboConceptos($this->codtipodeseguro);
        $comboparentescosaludof         =   $this->ge_getComboConceptos($this->codparentesco);
        
        $comboestadocivilsa             =   $this->ge_getComboConceptos($this->codestadocivil);
        $comboniveleducativosa          =   $this->ge_getComboConceptos($this->codniveleducativo);
        $listafamiliaressalud           =   $this->ge_getListaFamiliaresSalud($registro->id);


        //MORTALIDAD
        $combolugarfallecimientomo      =   $this->ge_getComboConceptos($this->codlugardefallecimiento);
        $listafamiliaresmortalidad      =   $this->ge_getListaFamiliaresMortalidad($registro->id);
        // codlugardefallecimiento

        //FICHA SOCIOECONOMICA
        $listabienes                    =   $this->ge_getlistaConceptos($this->codbienes);
        $bienes                         =   Vivienda::where('concepto','=', 'bienes')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('materialvivienda_id')->toArray();
        $listaactividadeseconomicas     =   $this->ge_getListaActividadesEconomicas($registro_id);
        $combofrecuenciaactividad       =   $this->ge_getComboConceptos($this->codfrecuenciaactividad);
        //vivienda
        $combotenenciavivienda             =   $this->ge_getComboConceptos($this->codtenenciadevivienda,$registro->tenenciavivienda_id);
        $comboacreditepropiedadvivienda    =   $this->ge_getComboConceptos($this->coddocumentaciondevivienda,$registro->acreditepropiedadvivienda_id);

        $combomaterialparedesvivienda   =   $this->ge_getComboConceptos($this->codmaterialdelavivienda,$registro->materialparedesvivienda_id);
        $combomaterialtechosvivienda    =   $this->ge_getComboConceptos($this->codmaterialdelavivienda,$registro->materialtechosvivienda_id);
        $combomaterialpisosvivienda     =   $this->ge_getComboConceptos($this->codmaterialdelavivienda,$registro->materialpisosvivienda_id);
        $comboalumbradopublicovivienda  =   [''=>'Seleccione Opcion','SI'=>'SI','NO'=>'NO'];

        $listaserviciopublicos          =   $this->ge_getlistaConceptos($this->codserviciospublicos);
        $serviciopublicos               =   Vivienda::where('concepto','=', 'serviciopublicos')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('materialvivienda_id')->toArray();

        $listaabastecimientoagua        =   $this->ge_getlistaConceptos($this->codabastecimientoagua);
        $abastecimientoagua             =   Vivienda::where('concepto','=', 'abastecimientoagua')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('materialvivienda_id')->toArray();

        $listaservicioshigienicos       =   $this->ge_getlistaConceptos($this->codservicioshigienicos);
        $servicioshigienicos             =   Vivienda::where('concepto','=', 'servicioshigienicos')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('materialvivienda_id')->toArray();



        //convivenciafamiliar

        $listatipoviolenciageneral      =   $this->ge_getlistaConceptos($this->codtipodeviolenciafamiliar);
        $tipoviolenciageneral           =   ConvivenciaFamiliar::where('concepto','=', 'tipoviolenciageneral')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('conceptodetalle_id')->toArray();

        $listatipoviolenciahijo         =   $this->ge_getlistaConceptos($this->codtipodeviolenciafamiliar);
        $tipoviolenciahijo              =   ConvivenciaFamiliar::where('concepto','=', 'tipoviolenciahijo')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('conceptodetalle_id')->toArray();

        $listainstitucionhijo           =   $this->ge_getlistaConceptos($this->codinstitucionapoyoviolencia);
        $institucionhijo                =   ConvivenciaFamiliar::where('concepto','=', 'institucionhijo')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('conceptodetalle_id')->toArray();

        $listatipoviolenciaabuelo       =   $this->ge_getlistaConceptos($this->codtipodeviolenciafamiliar);
        $tipoviolenciaabuelo            =   ConvivenciaFamiliar::where('concepto','=', 'tipoviolenciaabuelo')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('conceptodetalle_id')->toArray();

        $listainstitucionabuelo         =   $this->ge_getlistaConceptos($this->codinstitucionapoyoviolencia);
        $institucionabuelo              =   ConvivenciaFamiliar::where('concepto','=', 'institucionabuelo')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('conceptodetalle_id')->toArray();
        //beneficios
        $comboprogramabeneficiario      =   $this->ge_getComboConceptos($this->codprogramabeneficiario);
        $listabeneficios                =   $this->ge_getListaBeneficios($registro->id);


        $listadocumentos           =   $this->ge_getListaDocumentosFicha($registro->id);


        //observacion
        $odatosgenerales                =   $this->ge_getObservacion('datosgenerales',$registro_id);
        $oinformacionfamiliar           =   $this->ge_getObservacion('informacionfamiliar',$registro_id);
        $osalud                         =   $this->ge_getObservacion('salud',$registro_id);
        $osituacioneconomica            =   $this->ge_getObservacion('situacioneconomica',$registro_id);
        $obeneficios                    =   $this->ge_getObservacion('beneficios',$registro_id);
        $ovivienda                      =   $this->ge_getObservacion('vivienda',$registro_id);
        $oconvivenciafamiliar           =   $this->ge_getObservacion('convivenciafamiliar',$registro_id);
        $odocumentosficha               =   $this->ge_getObservacion('documentosficha',$registro_id);



        return View::make($this->rutaview.'/fichapreaprobar',
            [
                'idopcion'                          =>      $idopcion,
                'idregistro'                        =>      $idregistro,
                'view'                              =>      $this->rutaviewblade,
                'url'                               =>      $this->urlopciones,
                'urlcompleta'                       =>      $this->urlprincipal,
                'ruta'                              =>      $this->ruta,
                'idmodal'                           =>      $this->idmodal,

                'combodepartamentos'                =>      $combodepartamentos,
                'comboprovincias'                   =>      $comboprovincias,
                'combodistritos'                    =>      $combodistritos,
                
                'registro'                          =>      $registro,
                'beneficiario'                      =>      $beneficiario,

                'comboestadocivil'                  =>      $comboestadocivil,
                'comboniveleducativo'               =>      $comboniveleducativo,
                'combotipodeseguro'                 =>      $combotipodeseguro,

                'listafamiliares'                   =>      $listafamiliares,

                'comboparentescoof'                 =>      $comboparentescoof,
                'comboestadocivilof'                =>      $comboestadocivilof,
                'comboniveleducativoof'             =>      $comboniveleducativoof,
                'combotipodeseguroof'               =>      $combotipodeseguroof,
                
                //salud 
                'saludbeneficiario'                 =>      $saludbeneficiario,
                'combodiscapacidad'                 =>      $combodiscapacidad,
                'comboniveldiscapacidad'            =>      $comboniveldiscapacidad,
                'combotipodesegurobe'                 =>      $combotipodesegurobe,

                'listadiscapacidadbeneficiario'     =>      $listadiscapacidadbeneficiario,

                'combofamiliares'                   =>      $combofamiliares,
                'comboparentescosaludof'            =>      $comboparentescosaludof,
                'combodiscapacidadsaludof'          =>      $combodiscapacidadsaludof,
                'comboniveldiscapacidadsaludof'     =>      $comboniveldiscapacidadsaludof,

                'combotipodesegurosaludof'          =>      $combotipodesegurosaludof,
                
                'listafamiliaressalud'              =>      $listafamiliaressalud,

                'comboparentesco'                   =>      $comboparentesco,
                'combolugarfallecimientomo'         =>      $combolugarfallecimientomo ,
                'listafamiliaresmortalidad'         =>      $listafamiliaresmortalidad,

                //fichasocieconomica
                'listabienes'                       =>      $listabienes,
                'bienes'                            =>      $bienes,
                'listaactividadeseconomicas'        =>      $listaactividadeseconomicas,
                'combofrecuenciaactividad'          =>      $combofrecuenciaactividad,

                'listadocumentos'                   =>      $listadocumentos,

                //vivienda
                'combotenenciavivienda'             =>      $combotenenciavivienda,
                'comboacreditepropiedadvivienda'    =>      $comboacreditepropiedadvivienda,
                'combomaterialparedesvivienda'      =>      $combomaterialparedesvivienda,
                'combomaterialtechosvivienda'       =>      $combomaterialtechosvivienda,
                'combomaterialpisosvivienda'        =>      $combomaterialpisosvivienda,
                'listaserviciopublicos'             =>      $listaserviciopublicos,
                'serviciopublicos'                  =>      $serviciopublicos,
                'listaabastecimientoagua'           =>      $listaabastecimientoagua,
                'abastecimientoagua'                =>      $abastecimientoagua,
                'listaservicioshigienicos'          =>      $listaservicioshigienicos,
                'servicioshigienicos'               =>      $servicioshigienicos,
                'comboalumbradopublicovivienda'     =>      $comboalumbradopublicovivienda,

                //convivenciafamiliar
                'listatipoviolenciageneral'         =>      $listatipoviolenciageneral,
                'tipoviolenciageneral'              =>      $tipoviolenciageneral,

                'listatipoviolenciahijo'            =>      $listatipoviolenciahijo,
                'tipoviolenciahijo'                 =>      $tipoviolenciahijo,
                'listainstitucionhijo'              =>      $listainstitucionhijo,
                'institucionhijo'                   =>      $institucionhijo,


                'listatipoviolenciaabuelo'          =>      $listatipoviolenciaabuelo,
                'tipoviolenciaabuelo'               =>      $tipoviolenciaabuelo,
                'listainstitucionabuelo'            =>      $listainstitucionabuelo,
                'institucionabuelo'                 =>      $institucionabuelo,

                //beneficios
                'comboprogramabeneficiario'         =>      $comboprogramabeneficiario,
                'listabeneficios'                   =>      $listabeneficios,

                //beneficios
                'odatosgenerales'                   =>      $odatosgenerales,
                'oinformacionfamiliar'              =>      $oinformacionfamiliar,
                'osalud'                            =>      $osalud,
                'osituacioneconomica'               =>      $osituacioneconomica,
                'obeneficios'                       =>      $obeneficios,
                'ovivienda'                         =>      $ovivienda,
                'oconvivenciafamiliar'              =>      $oconvivenciafamiliar,
                'odocumentosficha'                  =>      $odocumentosficha,

                'swmodificar'                       =>      $swmodificar,
            ]);
    }

    public function actionPreAprobarFichaSocioEconomica($idopcion,$idregistro,Request $request)
    {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Modificar');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        $registro_id    =   $this->decodificar($idregistro);
        $ficha_id       =   $registro_id;
        $preaprobado    =   Estado::where('descripcion','=','PRE-APROBADO')->first();
        $ficha          =   Registro::where('id','=',$registro_id)->first();
        $fecha          =   date('Y-m-d',strtotime($request['fecha']));
        if($_POST){
             try{
                DB::beginTransaction();
                Registro::where('id','=',$registro_id)
                            ->update(
                                [
                                    'fechapreaprobacion'=>$fecha,
                                    'estado_id'=>$preaprobado->id,
                                    'updated_at'=>$this->fechaactual,
                                ]
                            );

                $descripcion    =   $request['descripcion'];
                $this->setLogFichaSocioEconomica($ficha_id,'Pre Aprobacion-Ficha-Socioeconomica',$descripcion);
                DB::commit();
            }catch(\Exception $ex){
                DB::rollback(); 
                $sw =   1;
                $mensaje  = $this->ge_getMensajeError($ex);
                return Redirect::to('/gestion-pre-aprobar-ficha-socieconomica/' . $idopcion)->with('errorbd', $mensaje);
            }
            return Redirect::to('/gestion-pre-aprobar-ficha-socieconomica/' . $idopcion)->with('bienhecho', 'Ficha :' . $ficha->codigo . ' Pre Aprobado con exito');
        }
        else
        {
            $beneficiario           =   $this->ge_getBeneficiario($registro_id);
            if(empty($beneficiario)){
                return Redirect::to('/gestion-pre-aprobar-ficha-socieconomica/' . $idopcion)->with('errorbd', 'Ficha ' . $ficha->codigo . ' No tiene Usuario Registrado');
            }
        // return Redirect::to('/gestion-ficha-socieconomica/' . $idopcion)->with('bienhecho', 'Ficha :' . $ficha->codigo . ' Aprobado con exito');
            $registro   = Registro::find($ficha_id);
            $idregistro = Hashids::encode($registro->id);
            $funcion    = $this;
            return View::make('fichasocioeconomica/preaprobarficha',
                [
                    'idregistro'    =>  $idregistro,
                    'registro'      =>  $registro,
                    'idopcion'      =>  $idopcion,
                    'beneficiario'  =>  $beneficiario,
                ]);
        }   
    }

    public function actionRevertirPreAprobarFichaSocioEconomica($idopcion,$idregistro,Request $request)
    {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Eliminar');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        $generado       =   Estado::where('descripcion','=','GENERADO')->first();

        $registro_id    =   $this->decodificar($idregistro);
        $documento = Registro::where('id','=',$registro_id)->first();
        if ($_POST) {
            try{
                DB::beginTransaction();
                Registro::where('id','=',$registro_id)
                            ->update(
                                [
                                    'estado_id'=>$generado->id,
                                    'updated_at'=>$this->fechaactual
                                ]
                            );
                $descripcion    =   $request['descripcion'];
                $this->setLogFichaSocioEconomica($registro_id,'Revertir Pre Aprobacion-Ficha-Socioeconomica',$descripcion);
                DB::commit();
            }catch(\Exception $ex){
                DB::rollback(); 
                $sw =   1;
                $mensaje  = $this->ge_getMensajeError($ex);
            }
            return Redirect::to('/gestion-pre-aprobar-ficha-socieconomica/' . $idopcion)->with('bienhecho', 'Ficha :' . $documento->codigo . ' Revertida su Aprobacion con exito');
        }
        else
        {
            $beneficiario           =   $this->ge_getBeneficiario($registro_id);
            $registro   = Registro::find($registro_id);
            $idregistro = Hashids::encode($registro->id);
            $funcion    = $this;
            return View::make('fichasocioeconomica/revertirpreaprobacionficha',
                [
                    'idregistro'    =>  $idregistro,
                    'registro'      =>  $registro,
                    'idopcion'      =>  $idopcion,
                    'beneficiario'  =>  $beneficiario,
                ]);
        }   
    }

    public function actionEliminarFichaSocioEconomicaPreAprobada($idopcion,$idregistro)
    {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Eliminar');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/

        $registro_id    = $this->decodificar($idregistro);
        $documento = Registro::where('id','=',$registro_id)->first();
        try{
            DB::beginTransaction();
            Registro::where('id','=',$registro_id)
                        ->update(
                            [
                                'activo'=>0,
                                'updated_at'=>$this->fechaactual
                            ]
                        );
            $this->setLogFichaSocioEconomica($registro_id,'Eliminar-Ficha-Socioeconomica Pre Aprobada','Estado: '.$documento->estado->descripcion);
            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
        }
        return Redirect::to('/gestion-pre-aprobar-ficha-socieconomica/' . $idopcion)->with('bienhecho', 'Ficha :' . $documento->codigo . ' Eliminado con exito');
    }

    public function actionAprobarFichaSocioEconomica($idopcion,$idregistro,Request $request)
    {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Modificar');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        $registro_id    =   $this->decodificar($idregistro);
        $ficha_id       =   $registro_id;
        $aprobado       =   Estado::where('descripcion','=','APROBADO')->first();
        $ficha      =   Registro::where('id','=',$registro_id)->first();
        if($_POST){
             try{
                DB::beginTransaction();
                $fecha    = date('Y-m-d',strtotime($request['fecha']));

                Registro::where('id','=',$registro_id)
                            ->update(
                                [
                                    'fechaaprobacion'=>$fecha,
                                    'estado_id'=>$aprobado->id,
                                    'updated_at'=>$this->fechaactual,
                                ]
                            );

                HistorialFicha::where('ficha_id','=',$ficha_id)
                        ->where('vigencia','=',1)
                        ->update([
                            'vigencia'=>0,
                            'fechafin'=>date('Y-m-d'),
                            'updated_at'=>date('Y-m-d H:i:s'),
                            'usermod'=>Session::get('usuario')->id,
                            'fechamod'=>date('Y-m-d H:i:s'),
                        ]);

                $descripcion    =   $request['descripcion'];
                $fechafin       = date('Y-m-d',strtotime('01-01-1901'));
                $fechainicio    = date('Y-m-d',strtotime($request['fecha']));
                $idnuevo                    =   $this->ge_getNuevoId('historialficha');
                $historial                  =   new HistorialFicha();
                $historial->id              =   $idnuevo;
                $historial->ficha_id        =   $ficha_id;
                $historial->fechainicio     =   $fechainicio;
                $historial->fechafin        =   $fechafin;
                $historial->usercrea        =   Session::get('usuario')->id;
                $historial->fechacrea       =   date('Y-m-d H:i:s');
                $historial->created_at      =   date('Y-m-d H:i:s');
                $historial->save();
                $this->setLogFichaSocioEconomica($ficha_id,'Aprobar-Ficha-Socioeconomica',$descripcion);

                DB::commit();
            }catch(\Exception $ex){
                DB::rollback(); 
                $sw =   1;
                $mensaje  = $this->ge_getMensajeError($ex);
                return Redirect::to('/gestion-aprobar-ficha-socieconomica/' . $idopcion)->with('errorbd', $mensaje);
            }
            return Redirect::to('/gestion-aprobar-ficha-socieconomica/' . $idopcion)->with('bienhecho', 'Ficha :' . $ficha->codigo . ' Aprobado con exito');
        }
        else
        {
            $beneficiario           =   $this->ge_getBeneficiario($registro_id);
            if(empty($beneficiario)){
                return Redirect::to('/gestion-aprobar-ficha-socieconomica/' . $idopcion)->with('errorbd', 'Ficha ' . $ficha->codigo . ' No tiene Usuario Registrado');
            }
        // return Redirect::to('/gestion-ficha-socieconomica/' . $idopcion)->with('bienhecho', 'Ficha :' . $ficha->codigo . ' Aprobado con exito');
            $registro   = Registro::find($ficha_id);
            $idregistro = Hashids::encode($registro->id);
            $funcion    = $this;
            return View::make('fichasocioeconomica/aprobarficha',
                [
                    'idregistro'    =>  $idregistro,
                    'registro'      =>  $registro,
                    'idopcion'      =>  $idopcion,
                    'beneficiario'  =>  $beneficiario,
                ]);
        }   
    }

    public function actionListarFichaSocioEconomicaAprobar($idopcion) {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Ver');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        View::share('titulo','Aprobacion Ficha SocioEconomica');
        $idestados          =   Estado::whereIn('descripcion',['PRE-APROBADO','APROBADO'])->pluck('id')->toArray();
        $user_id            =   Session::get('usuario')->id;
        $rol_id             =   $this->ge_getRolEncuestador();
        $comboencuestadores =   $this->ge_getComboEncuestadores($rol_id);    
        $listadatos         =   Registro::leftJoin('beneficiarios', 'beneficiarios.ficha_id', '=', 'fichasocioeconomica.id')
                                ->leftJoin('departamentos', 'departamentos.id', '=', 'fichasocioeconomica.departamento_id')
                                ->leftJoin('provincias', 'provincias.id', '=', 'fichasocioeconomica.provincia_id')
                                ->leftJoin('distritos', 'distritos.id', '=', 'fichasocioeconomica.distrito_id')
                                ->where('fichasocioeconomica.activo','=',1)
                                ->whereIn('fichasocioeconomica.estado_id',$idestados)
                                ->select(
                                        'fichasocioeconomica.*',
                                        'beneficiarios.dni',
                                        'beneficiarios.telefono',
                                        'beneficiarios.apellidopaterno',
                                        'beneficiarios.apellidomaterno',
                                        'beneficiarios.nombres',
                                        'departamentos.descripcion as departamento',
                                        'provincias.descripcion as provincia',
                                        'distritos.descripcion as distrito'
                                    )
                                ->selectRaw("'' as classcolorfila")
                                ->orderby('fichasocioeconomica.codigo','desc')
                                ->get();


        foreach($listadatos as $fila){
            // $classcolorfila = $this->ge_getClassColorEstado($fila->estado_id);
            $fila->classcolorfila=$this->coloresaprobar[$fila->estado_id];
        }

        return View::make($this->rutaview.'/listaaprobar',
            [
                'idopcion'          =>  $idopcion,
                'view'              =>  $this->rutaviewblade,
                'url'               =>  $this->urlopciones,
                'urlcompleta'       =>  $this->urlprincipal,
                'ruta'              =>  $this->ruta,
                'idmodal'           =>  $this->idmodal,
                'listadatos'        =>  $listadatos,
                'comboencuestadores'  =>  $comboencuestadores,
            ]);
    }
    
    public function actionVerDetalleAprobarFichaSocioEconomica($idopcion,$idregistro) {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Ver');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        View::share('titulo','Detalle Ficha  SocioEconomica');
        $user_id            =   Session::get('usuario')->id;
        $registro_id    =   $this->decodificar($idregistro);


        $swmodificar = 0;
        $registro           =   Registro::find($this->decodificar($idregistro));
        // $combodepartamentos =   $this->ge_getComboDepartamentos(13);
        if(!is_null($registro->departamento_id)){
            $combodepartamentos =   $this->ge_getComboDepartamentos($registro->departamento_id);
            $comboprovincias   =   $this->ge_getComboProvincias($registro->provincia_id);
        }
        else{
            $combodepartamentos =   $this->ge_getComboDepartamentos(13);
            $comboprovincias   =   $this->ge_getComboProvinciasDepartamento(13);
        }

        $combodistritos     =   $this->ge_getComboDistritos($registro->distrito_id);
        $idregistro         =   $this->codificar($registro->id);

        //TABS INFORMACION FAMILIAR        
        $beneficiario       =   $this->ge_getBeneficiario($registro->id);
        $comboparentesco    =   $this->ge_getComboConceptos($this->codparentesco);

        if(!is_null($beneficiario)){
            $comboestadocivil       =   $this->ge_getComboConceptos($this->codestadocivil,$beneficiario->estadocivil_id);
            $comboniveleducativo    =   $this->ge_getComboConceptos($this->codniveleducativo,$beneficiario->niveleducativo_id);
            $combotipodeseguro      =   $this->ge_getComboConceptos($this->codtipodeseguro,$beneficiario->tiposeguro_id);
        }
        else{
            $comboestadocivil       =   $this->ge_getComboConceptos($this->codestadocivil);
            $comboniveleducativo    =   $this->ge_getComboConceptos($this->codniveleducativo);
            $combotipodeseguro      =   $this->ge_getComboConceptos($this->codtipodeseguro);
        }

        $comboparentescoof          =   $this->ge_getComboConceptos($this->codparentesco);
        $comboestadocivilof         =   $this->ge_getComboConceptos($this->codestadocivil);
        $comboniveleducativoof      =   $this->ge_getComboConceptos($this->codniveleducativo);
        $combotipodeseguroof        =   $this->ge_getComboConceptos($this->codtipodeseguro);

        $listafamiliares            =   $this->ge_getListaFamiliares($registro->id);

        $combofamiliares            =   $this->ge_getComboFamiliares($registro->id);


        //TABS SALUD        
        $listadiscapacidadbeneficiario= $this->ge_getListaDiscapacidadBeneficiarios($registro->id);
        $saludbeneficiario          =   $this->ge_getSaludBeneficiario($registro->id);
        $comboparentesco            =   $this->ge_getComboConceptos($this->codparentesco);
        
     

            $combodiscapacidad     =   $this->ge_getComboConceptos($this->coddiscapacidad);
            $comboniveldiscapacidad=   $this->ge_getComboConceptos($this->codniveldediscapacidad);
            $combotipodesegurobe     =   $this->ge_getComboConceptos($this->codtipodeseguro);

       

        $combodiscapacidadsaludof       =   $this->ge_getComboConceptos($this->coddiscapacidad);
        $comboniveldiscapacidadsaludof  =   $this->ge_getComboConceptos($this->codniveldediscapacidad);
        $combotipodesegurosaludof       =   $this->ge_getComboConceptos($this->codtipodeseguro);
        $comboparentescosaludof         =   $this->ge_getComboConceptos($this->codparentesco);
        
        $comboestadocivilsa             =   $this->ge_getComboConceptos($this->codestadocivil);
        $comboniveleducativosa          =   $this->ge_getComboConceptos($this->codniveleducativo);
        $listafamiliaressalud           =   $this->ge_getListaFamiliaresSalud($registro->id);


        //MORTALIDAD
        $combolugarfallecimientomo      =   $this->ge_getComboConceptos($this->codlugardefallecimiento);
        $listafamiliaresmortalidad      =   $this->ge_getListaFamiliaresMortalidad($registro->id);
        // codlugardefallecimiento

        //FICHA SOCIOECONOMICA
        $listabienes                    =   $this->ge_getlistaConceptos($this->codbienes);
        $bienes                         =   Vivienda::where('concepto','=', 'bienes')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('materialvivienda_id')->toArray();
        $listaactividadeseconomicas     =   $this->ge_getListaActividadesEconomicas($registro_id);
        $combofrecuenciaactividad       =   $this->ge_getComboConceptos($this->codfrecuenciaactividad);
        //vivienda
        $combotenenciavivienda             =   $this->ge_getComboConceptos($this->codtenenciadevivienda,$registro->tenenciavivienda_id);
        $comboacreditepropiedadvivienda    =   $this->ge_getComboConceptos($this->coddocumentaciondevivienda,$registro->acreditepropiedadvivienda_id);

        $combomaterialparedesvivienda   =   $this->ge_getComboConceptos($this->codmaterialdelavivienda,$registro->materialparedesvivienda_id);
        $combomaterialtechosvivienda    =   $this->ge_getComboConceptos($this->codmaterialdelavivienda,$registro->materialtechosvivienda_id);
        $combomaterialpisosvivienda     =   $this->ge_getComboConceptos($this->codmaterialdelavivienda,$registro->materialpisosvivienda_id);
        $comboalumbradopublicovivienda  =   [''=>'Seleccione Opcion','SI'=>'SI','NO'=>'NO'];

        $listaserviciopublicos          =   $this->ge_getlistaConceptos($this->codserviciospublicos);
        $serviciopublicos               =   Vivienda::where('concepto','=', 'serviciopublicos')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('materialvivienda_id')->toArray();

        $listaabastecimientoagua        =   $this->ge_getlistaConceptos($this->codabastecimientoagua);
        $abastecimientoagua             =   Vivienda::where('concepto','=', 'abastecimientoagua')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('materialvivienda_id')->toArray();

        $listaservicioshigienicos       =   $this->ge_getlistaConceptos($this->codservicioshigienicos);
        $servicioshigienicos             =   Vivienda::where('concepto','=', 'servicioshigienicos')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('materialvivienda_id')->toArray();



        //convivenciafamiliar

        $listatipoviolenciageneral      =   $this->ge_getlistaConceptos($this->codtipodeviolenciafamiliar);
        $tipoviolenciageneral           =   ConvivenciaFamiliar::where('concepto','=', 'tipoviolenciageneral')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('conceptodetalle_id')->toArray();

        $listatipoviolenciahijo         =   $this->ge_getlistaConceptos($this->codtipodeviolenciafamiliar);
        $tipoviolenciahijo              =   ConvivenciaFamiliar::where('concepto','=', 'tipoviolenciahijo')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('conceptodetalle_id')->toArray();

        $listainstitucionhijo           =   $this->ge_getlistaConceptos($this->codinstitucionapoyoviolencia);
        $institucionhijo                =   ConvivenciaFamiliar::where('concepto','=', 'institucionhijo')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('conceptodetalle_id')->toArray();

        $listatipoviolenciaabuelo       =   $this->ge_getlistaConceptos($this->codtipodeviolenciafamiliar);
        $tipoviolenciaabuelo            =   ConvivenciaFamiliar::where('concepto','=', 'tipoviolenciaabuelo')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('conceptodetalle_id')->toArray();

        $listainstitucionabuelo         =   $this->ge_getlistaConceptos($this->codinstitucionapoyoviolencia);
        $institucionabuelo              =   ConvivenciaFamiliar::where('concepto','=', 'institucionabuelo')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('conceptodetalle_id')->toArray();
        //beneficios
        $comboprogramabeneficiario      =   $this->ge_getComboConceptos($this->codprogramabeneficiario);
        $listabeneficios                =   $this->ge_getListaBeneficios($registro->id);


        $listadocumentos           =   $this->ge_getListaDocumentosFicha($registro->id);


        //observacion
        $odatosgenerales                =   $this->ge_getObservacion('datosgenerales',$registro_id);
        $oinformacionfamiliar           =   $this->ge_getObservacion('informacionfamiliar',$registro_id);
        $osalud                         =   $this->ge_getObservacion('salud',$registro_id);
        $osituacioneconomica            =   $this->ge_getObservacion('situacioneconomica',$registro_id);
        $obeneficios                    =   $this->ge_getObservacion('beneficios',$registro_id);
        $ovivienda                      =   $this->ge_getObservacion('vivienda',$registro_id);
        $oconvivenciafamiliar           =   $this->ge_getObservacion('convivenciafamiliar',$registro_id);
        $odocumentosficha               =   $this->ge_getObservacion('documentosficha',$registro_id);



        return View::make($this->rutaview.'/fichaaprobar',
            [
                'idopcion'                          =>      $idopcion,
                'idregistro'                        =>      $idregistro,
                'view'                              =>      $this->rutaviewblade,
                'url'                               =>      $this->urlopciones,
                'urlcompleta'                       =>      $this->urlprincipal,
                'ruta'                              =>      $this->ruta,
                'idmodal'                           =>      $this->idmodal,

                'combodepartamentos'                =>      $combodepartamentos,
                'comboprovincias'                   =>      $comboprovincias,
                'combodistritos'                    =>      $combodistritos,
                
                'registro'                          =>      $registro,
                'beneficiario'                      =>      $beneficiario,

                'comboestadocivil'                  =>      $comboestadocivil,
                'comboniveleducativo'               =>      $comboniveleducativo,
                'combotipodeseguro'                 =>      $combotipodeseguro,

                'listafamiliares'                   =>      $listafamiliares,

                'comboparentescoof'                 =>      $comboparentescoof,
                'comboestadocivilof'                =>      $comboestadocivilof,
                'comboniveleducativoof'             =>      $comboniveleducativoof,
                'combotipodeseguroof'               =>      $combotipodeseguroof,
                
                //salud 
                'saludbeneficiario'                 =>      $saludbeneficiario,
                'combodiscapacidad'                 =>      $combodiscapacidad,
                'comboniveldiscapacidad'            =>      $comboniveldiscapacidad,
                'combotipodesegurobe'                 =>      $combotipodesegurobe,

                'listadiscapacidadbeneficiario'     =>      $listadiscapacidadbeneficiario,

                'combofamiliares'                   =>      $combofamiliares,
                'comboparentescosaludof'            =>      $comboparentescosaludof,
                'combodiscapacidadsaludof'          =>      $combodiscapacidadsaludof,
                'comboniveldiscapacidadsaludof'     =>      $comboniveldiscapacidadsaludof,

                'combotipodesegurosaludof'          =>      $combotipodesegurosaludof,
                
                'listafamiliaressalud'              =>      $listafamiliaressalud,

                'comboparentesco'                   =>      $comboparentesco,
                'combolugarfallecimientomo'         =>      $combolugarfallecimientomo ,
                'listafamiliaresmortalidad'         =>      $listafamiliaresmortalidad,

                //fichasocieconomica
                'listabienes'                       =>      $listabienes,
                'bienes'                            =>      $bienes,
                'listaactividadeseconomicas'        =>      $listaactividadeseconomicas,
                'combofrecuenciaactividad'          =>      $combofrecuenciaactividad,

                'listadocumentos'                   =>      $listadocumentos,

                //vivienda
                'combotenenciavivienda'             =>      $combotenenciavivienda,
                'comboacreditepropiedadvivienda'    =>      $comboacreditepropiedadvivienda,
                'combomaterialparedesvivienda'      =>      $combomaterialparedesvivienda,
                'combomaterialtechosvivienda'       =>      $combomaterialtechosvivienda,
                'combomaterialpisosvivienda'        =>      $combomaterialpisosvivienda,
                'listaserviciopublicos'             =>      $listaserviciopublicos,
                'serviciopublicos'                  =>      $serviciopublicos,
                'listaabastecimientoagua'           =>      $listaabastecimientoagua,
                'abastecimientoagua'                =>      $abastecimientoagua,
                'listaservicioshigienicos'          =>      $listaservicioshigienicos,
                'servicioshigienicos'               =>      $servicioshigienicos,
                'comboalumbradopublicovivienda'     =>      $comboalumbradopublicovivienda,

                //convivenciafamiliar
                'listatipoviolenciageneral'         =>      $listatipoviolenciageneral,
                'tipoviolenciageneral'              =>      $tipoviolenciageneral,

                'listatipoviolenciahijo'            =>      $listatipoviolenciahijo,
                'tipoviolenciahijo'                 =>      $tipoviolenciahijo,
                'listainstitucionhijo'              =>      $listainstitucionhijo,
                'institucionhijo'                   =>      $institucionhijo,


                'listatipoviolenciaabuelo'          =>      $listatipoviolenciaabuelo,
                'tipoviolenciaabuelo'               =>      $tipoviolenciaabuelo,
                'listainstitucionabuelo'            =>      $listainstitucionabuelo,
                'institucionabuelo'                 =>      $institucionabuelo,

                //beneficios
                'comboprogramabeneficiario'         =>      $comboprogramabeneficiario,
                'listabeneficios'                   =>      $listabeneficios,

                //beneficios
                'odatosgenerales'                   =>      $odatosgenerales,
                'oinformacionfamiliar'              =>      $oinformacionfamiliar,
                'osalud'                            =>      $osalud,
                'osituacioneconomica'               =>      $osituacioneconomica,
                'obeneficios'                       =>      $obeneficios,
                'ovivienda'                         =>      $ovivienda,
                'oconvivenciafamiliar'              =>      $oconvivenciafamiliar,
                'odocumentosficha'                  =>      $odocumentosficha,

                'swmodificar'                       =>      $swmodificar,
            ]);
    }

    public function actionRevertirPreAprobacionFichaSocioEconomicaAprobada($idopcion,$idregistro,Request $request)
    {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Eliminar');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        $generado       =   Estado::where('descripcion','=','GENERADO')->first();

        $registro_id    =   $this->decodificar($idregistro);
        $documento = Registro::where('id','=',$registro_id)->first();
        if ($_POST) {
            try{
                DB::beginTransaction();
                Registro::where('id','=',$registro_id)
                            ->update(
                                [
                                    'estado_id'=>$generado->id,
                                    'updated_at'=>$this->fechaactual
                                ]
                            );
                $descripcion    =   $request['descripcion'];
                $this->setLogFichaSocioEconomica($registro_id,'Revertir Pre Aprobacion-Ficha-Socioeconomica-Aprobada',$descripcion);
                DB::commit();
            }catch(\Exception $ex){
                DB::rollback(); 
                $sw =   1;
                $mensaje  = $this->ge_getMensajeError($ex);
            }
            return Redirect::to('/gestion-aprobar-ficha-socieconomica/' . $idopcion)->with('bienhecho', 'Ficha :' . $documento->codigo . ' Revertida su Aprobacion con exito');
        }
        else
        {
            $beneficiario           =   $this->ge_getBeneficiario($registro_id);
            $registro   = Registro::find($registro_id);
            $idregistro = Hashids::encode($registro->id);
            $funcion    = $this;
            return View::make('fichasocioeconomica/revertirpreaprobacionfichaaprobada',
                [
                    'idregistro'    =>  $idregistro,
                    'registro'      =>  $registro,
                    'idopcion'      =>  $idopcion,
                    'beneficiario'  =>  $beneficiario,
                ]);
        }   
    }

}
