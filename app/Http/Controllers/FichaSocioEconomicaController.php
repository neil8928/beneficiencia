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

use App\Modelos\FichaSocioEconomica as Registro;
use App\Modelos\Estado;
use App\Modelos\Beneficiario;
use App\Modelos\Familiar;
use App\Modelos\SaludBeneficiario;
use App\Modelos\SaludFamiliar;
use App\Modelos\Vivienda;
use App\Modelos\Detalleconcepto;
use App\Modelos\ConvivenciaFamiliar;

use GuzzleHttp\Client;
use App\Traits\GeneralesTraits;

class FichaSocioEconomicaController extends Controller
{
    //
    use GeneralesTraits;
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


    public function actionListarFichaSocioEconomica($idopcion) {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Ver');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        View::share('titulo','Ficha SocioEconomica');
        $user_id            =   Session::get('usuario')->id;
        $rol_id             =   $this->ge_getRolEncuestador();
        $comboencuestadores =   $this->ge_getComboEncuestadores($rol_id);    
        $listadatos         =   Registro::where('activo','=',1)->get();

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

    public function actionRegistrarFichaSocioEconomica($idopcion) {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Anadir');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        View::share('titulo','Ficha SocioEconomica');
        $user_id            =   Session::get('usuario')->id;
        $generado           =   Estado::where('descripcion','=','GENERADO')->first();
        $usuario            =   User::find($user_id);
        $registro           =   Registro::where('activo','=',1)
                                    ->where('encuestador_id','=',$usuario->id)
                                    ->where('estado_id','=',$generado->id)
                                    ->first();

        if(empty($registro) || is_null($registro)){
            $fecha          =   date('Y-m-d',strtotime($this->fechaactual));
            $codigo         =   $this->ge_getCodigoTabla($this->tregistro);
            $idnuevo                    =   $this->ge_getNuevoId($this->tregistro);
            $modelo                     =   new Registro();
            $modelo->id                 =   $idnuevo;
            $modelo->codigo             =   $codigo;
            $modelo->fecha              =   $fecha;
            $modelo->encuestador_id     =   $usuario->id;
            $modelo->estado_id          =   $generado->id;
            $modelo->activo             =   1;
            $modelo->save();
            $registro       =   $modelo;
            // $this->mostrarValor($registro.' vacio');
        }

        $idregistro     = $this->codificar($registro->id);
        return Redirect::to('/modificar-ficha-socieconomica/' . $idopcion.'/'.$idregistro)
                        ->with('bienhecho', 'Llenado de Ficha Socio Economica');
    }

     public function actionModificarFichaSocioEconomica($idopcion,$idregistro) {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Anadir');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        View::share('titulo','Ficha SocioEconomica');
        $user_id            =   Session::get('usuario')->id;
        $registro_id    =   $this->decodificar($idregistro);



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
        $saludbeneficiario          =   $this->ge_getSaludBeneficiario($registro->id);
        $comboparentesco            =   $this->ge_getComboConceptos($this->codparentesco);
        
        if(!is_null($saludbeneficiario)){
            $combodiscapacidadsalud     =   $this->ge_getComboConceptos($this->coddiscapacidad,$saludbeneficiario->discapacidad_id);
            $comboniveldiscapacidadsalud=   $this->ge_getComboConceptos($this->codniveldediscapacidad,$saludbeneficiario->niveldiscapacidad_id);
            $combotipodesegurosalud     =   $this->ge_getComboConceptos($this->codtipodeseguro,$saludbeneficiario->tiposeguro_id);
        }
        else{
            $combodiscapacidadsalud     =   $this->ge_getComboConceptos($this->coddiscapacidad);
            $comboniveldiscapacidadsalud=   $this->ge_getComboConceptos($this->codniveldediscapacidad);
            $combotipodesegurosalud     =   $this->ge_getComboConceptos($this->codtipodeseguro);
        }
       

        $combodiscapacidadsaludof       =   $this->ge_getComboConceptos($this->coddiscapacidad);
        $comboniveldiscapacidadsaludof  =   $this->ge_getComboConceptos($this->codniveldediscapacidad);
        $combotipodesegurosaludof       =   $this->ge_getComboConceptos($this->codtipodeseguro);
        $comboparentescosaludof         =   $this->ge_getComboConceptos($this->codparentesco);
        
        $comboestadocivilsa             =   $this->ge_getComboConceptos($this->codestadocivil);
        $comboniveleducativosa          =   $this->ge_getComboConceptos($this->codniveleducativo);
        $listafamiliaressalud           =   $this->ge_getListaFamiliaresSalud($registro->id);


        //MORTALIDAD
        $combolugarfallecimientomo      =   [];


        // $combodiscapacidadsalud     =   [];
        // $combodiscapacidadsalud     =   [];
        // if(!is_null($saludbeneficiario)){
        //     $comboestadocivil       =   $this->ge_getComboConceptos($this->codestadocivil,$saludbeneficiario->estadocivil_id);
        //     $comboniveleducativo    =   $this->ge_getComboConceptos($this->codniveleducativo,$saludbeneficiario->niveleducativo_id);
        //     $combotipodeseguro      =   $this->ge_getComboConceptos($this->codtipodeseguro,$saludbeneficiario->tiposeguro_id);
        // }
        // else{
        //     $comboestadocivil       =   $this->ge_getComboConceptos($this->codestadocivil);
        //     $comboniveleducativo    =   $this->ge_getComboConceptos($this->codniveleducativo);
        //     $combotipodeseguro      =   $this->ge_getComboConceptos($this->codtipodeseguro);
        // }

      

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
                'combodiscapacidadsalud'            =>      $combodiscapacidadsalud,
                'comboniveldiscapacidadsalud'       =>      $comboniveldiscapacidadsalud,

                'combotipodesegurosalud'            =>      $combotipodesegurosalud,

                'combofamiliares'                   =>      $combofamiliares,
                'comboparentescosaludof'            =>      $comboparentescosaludof,
                'combodiscapacidadsaludof'          =>      $combodiscapacidadsaludof,
                'comboniveldiscapacidadsaludof'     =>      $comboniveldiscapacidadsaludof,

                'combotipodesegurosaludof'          =>      $combotipodesegurosaludof,
                
                'listafamiliaressalud'              =>      $listafamiliaressalud,

                'comboparentesco'                   =>      $comboparentesco,
                'combolugarfallecimientomo'         =>      $combolugarfallecimientomo ,
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
                            'idopcion'          =>  $idopcion,                        
                         ]);

    }

    public function actionAjaxTabInformacionFamiliarEliminarOtroFamiliar(Request $request)
    {
        $idopcion       =   $request['idopcion'];
        $ficha_id       =   $request['idficha'];
        $registro_id    =   $request['idregistro'];
        try{
            DB::beginTransaction();

            $idnuevo        =   $this->ge_getNuevoId('familiares');

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
            // dd($mensaje);
            // $mensaje  = 'Ocurrio un error al intentar Guardar la información';
        }

        $listafamiliares      =   Familiar::where('ficha_id',$ficha_id)->where('activo','=','1')->get();
        // dd($listafamiliares);
        return View::make($this->rutaview.'/tabs/informacionfamiliar/ajax/ajaxtinformacionfamiliar',
                         [                  
                            'listafamiliares'   => $listafamiliares,
                            'ajax'              => true,
                            'idopcion'          =>  $idopcion,                        
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

    public function actionAjaxActualizarTabSaludBeneficiario(Request $request)
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
            $beneficiario_id    =   NULL;
            $beneficiario       =   SaludBeneficiario::where('ficha_id','=',$registro_id)->where('activo','=',1)->first();
            $beneficiario_id    =   !empty($beneficiario)? $beneficiario->id:NULL;
            if(is_null($beneficiario_id)){
                $idnuevo        =   $this->ge_getNuevoId('saludbeneficiarios');

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
            }
            else{
                $sw     =   1;
                $mensaje=  'LA FICHA CON CODIGO: '.$registro->codigo.'<br> YA TIENE DATOS SALUD BENEFICIARIO REGISTRADOS:';                  
            }

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


     public function actionAjaxTabSaludAgregarOtroFamiliar(Request $request){

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
                            'idopcion'          =>  $idopcion,                        
                         ]);
    }


}
