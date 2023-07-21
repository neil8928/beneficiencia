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
use Datetime;

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

class ReingresoBeneficiarioController extends Controller
{
    //
    use GeneralesTraits;
    use ClonarTraits;    
    private   $tituloview               =   'Cosecha Productos';
    private   $ruta                     =   'reingreso';
    private   $urlprincipal             =   'gestion-reingreso-beneficiario';
    private   $urlcompleto              =   'gestion-reingreso-beneficiario';
    private   $urlopciones              =   'reingreso-beneficiario';
    private   $rutaview                 =   'reingreso';

    private   $rutaviewblade            =   'reingreso';

    private   $rutaviewbladegeneral     =   'general';
    private   $tregistro                =   'fichasocioeconomica';
    private   $tfoto                    =   'multimedias';
    private   $idmodal                  =   'modfichasocioeconomica';

    private   $categoria_id             =   3;
    private   $pathLocal                =   'fichasocioeconomica/';
    private   $carpetaimg               =   'cp/';


    public function actionListarReingresoFichaSocioEconomica($idopcion) 
    {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Ver');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        View::share('titulo','Reingreso Usuario');
        $user_id            =   Session::get('usuario')->id;
        $rol_id             =   $this->ge_getRolEncuestador();
        $dnisbeneficiarios    =   $this->ge_getDnisBeneficiariosVigentes();

        $comboencuestadores =   $this->ge_getComboEncuestadores($rol_id);  
        $terminado           =   Estado::where('descripcion','=','TERMINADO')->first();
        $idbeneficiarios    =   $this->ge_getUltimosIdBeneficiarios();
        $listadatos         =   Registro::join('beneficiarios', 'beneficiarios.ficha_id', '=', 'fichasocioeconomica.id')
                                ->leftJoin('departamentos', 'departamentos.id', '=', 'fichasocioeconomica.departamento_id')
                                ->leftJoin('provincias', 'provincias.id', '=', 'fichasocioeconomica.provincia_id')
                                ->leftJoin('distritos', 'distritos.id', '=', 'fichasocioeconomica.distrito_id')
                                ->where('fichasocioeconomica.activo','=',1)
                                ->where('fichasocioeconomica.estado_id','=',$terminado->id)
                                ->whereIn('beneficiarios.id',$idbeneficiarios)
                                ->whereNotIn('beneficiarios.dni',$dnisbeneficiarios)
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
        // dd($listadatos);
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

    public function actionVerDetalleReingresoFichaSocioEconomica($idopcion,$idregistro) {
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

            $combofrecuenciaactividadusuario    =   $this->ge_getComboConceptos($this->codfrecuenciaactividad,$beneficiario->frecuenciaactividadusuario_id);
        }
        else{
            $comboestadocivil       =   $this->ge_getComboConceptos($this->codestadocivil);
            $comboniveleducativo    =   $this->ge_getComboConceptos($this->codniveleducativo);
            $combotipodeseguro      =   $this->ge_getComboConceptos($this->codtipodeseguro);
            $combofrecuenciaactividadusuario    =   $this->ge_getComboConceptos($this->codfrecuenciaactividad);  

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

        $listaactividadeseconomicasfh   =   $this->ge_getListaActividadesEconomicasFH($registro_id);
        $listaprogramabeneficiario      =   $this->ge_getlistaConceptos($this->codprogramabeneficiario);
        $programausuario                =   Vivienda::where('concepto','=', 'programabeneficiariousuario')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('materialvivienda_id')->toArray();

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

                'listaactividadeseconomicasfh'      =>      $listaactividadeseconomicasfh,
                'listaprogramabeneficiario'         =>      $listaprogramabeneficiario,
                'programausuario'                   =>      $programausuario,
                'combofrecuenciaactividadusuario'   =>      $combofrecuenciaactividadusuario,




                'swmodificar'                       =>      $swmodificar,
            ]);
    }


    public function actionReingresoFichaSocioEconomica($idopcion,$idregistro,Request $request)
    {
       /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Anadir');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        View::share('titulo','Reingreso Ficha SocioEconomica');
        $user_id            =   Session::get('usuario')->id;
        $generado           =   Estado::where('descripcion','=','GENERADO')->first();
        $usuario            =   User::find($user_id);
        $registro_id        =   $this->decodificar($idregistro);
        $fichaanterior      =   Registro::find($registro_id);
        if ($_POST) {
            $terminado       =   Estado::where('descripcion','=','TERMINADO')->first();

            // $indclonarbeneficiario  =  (int) $request['indclonarbeneficiario'];
            $indclonardatos         =  (int) $request['indclonardatos'];
            // $indclonartpif          =  (int) $request['indclonartpif'];
            $indclonartpsa          =  (int) $request['indclonartpsa'];
            $indclonartpse          =  (int) $request['indclonartpse'];
            $indclonartpbe          =  (int) $request['indclonartpbe'];
            $indclonartpvi          =  (int) $request['indclonartpvi'];
            $indclonartpcf          =  (int) $request['indclonartpcf'];
            // $datos = compact('indclonartpsa','indclonartpse','indclonartpbe','indclonartpvi','indclonartpcf');
            // dd($datos);
            $beneficiario           =   $this->ge_getBeneficiario($registro_id);
            $nombreUsuario = $beneficiario->apellidopaterno.' '. $beneficiario->apellidomaterno.' '.$beneficiario->nombres;
            $user_id            =   Session::get('usuario')->id;

            $sw                 =   0;
            $error              =   true;

            try{
                DB::beginTransaction();

                $codigo='';
                $fecha                        =   date('Y-m-d',strtotime($request['fecha']));
                $codigo                       =   $this->ge_getCodigoTabla($this->tregistro);
                $idnuevo                      =   $this->ge_getNuevoId($this->tregistro);
               
                $registro                     =   new Registro();
                $registro->id                 =   $idnuevo;
                $registro->codigo             =   $codigo;
                $registro->fecha              =   $fecha;
                $registro->encuestador_id     =   $usuario->id;
                $registro->estado_id          =   $generado->id;
                $registro->fechacrea          =   $this->fechaactual;
                $registro->usercrea           =   Session::get('usuario')->id;

                $registro->activo             =   1;
                $registro->save();
                $ficha_id                     =    $idnuevo;

                Registro::where('id','=',$registro_id)
                            ->update(
                                [
                                    'estado_id'=>$terminado->id,
                                    'updated_at'=>$this->fechaactual,
                                    'usermod'=>Session::get('usuario')->id,
                                    'fechamod'=>date('Y-m-d H:i:s'),

                                ]
                            );

                // $indclonar                  =   (int)$request['indclonar'];
                //datosgenerales              
                $clonarbeneficiario         =   $this->clonarbeneficiario($ficha_id,$beneficiario,$fecha);
                $clonardatosgenerales       =   $this->clonardatosgenerales($ficha_id,$beneficiario,$user_id);
                $clonarobsdatosgenerales    =   $this->clonarobservacion($ficha_id,$beneficiario,$user_id,'datosgenerales');
                $cad = ' datos generales ';

                if($indclonardatos==1){  
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
                $idnuevoregistro = $this->codificar($ficha_id);
                $descripcion = strval($this->fechaactual).' : Ficha Anterior: '.$fichaanterior->id.' / Ficha Actual: '.$idnuevo.' / Beneficio: '.$nombreUsuario.'/'.$cad;
                $this->setLogFichaSocioEconomica($idnuevo,'Reingreso Usuario ',$descripcion);
                DB::commit();

            }catch(\Exception $ex){
                DB::rollback(); 
                $sw =   1;
                $mensaje  = $this->ge_getMensajeError($ex);
                // dd($mensaje);
                // $mensaje  = 'Ocurrio un error al intentar Guardar la información';
                return Redirect::to('/accion-'.$this->urlopciones.'/' . $idopcion.'/'.$idregistro)->with('errorbd', $mensaje);

            }
            return Redirect::to('/editar-'.$this->urlopciones.'/' . $idopcion.'/'.$idnuevoregistro)->with('bienhecho', 'Usuario ' . $nombreUsuario . ' Reingresado con exito');
        } 
        else 
        {

            $beneficiario           =   $this->ge_getBeneficiario($registro_id);
            if(empty($beneficiario)){
                return Redirect::to('/'.$this->urlcompleto.'/' . $idopcion)->with('errorbd', 'Ficha ' . $fichaanterior->codigo . ' No tiene Usuario Registrado');
            }

            // $combobeneficiario      =   $this->ge_getComboBeneficiarioClonarTodos();
            return View::make($this->rutaview.'/reingresoficha',
                                    [
                                        'idopcion'           =>  $idopcion,
                                        'idregistro'         =>  $idregistro,
                                        'urlcompleta'       =>  $this->urlprincipal,
                                        'view'               =>  $this->rutaviewblade,
                                        'url'                =>  $this->urlopciones,
                                        'beneficiario'      =>  $beneficiario,
                                        'registro'          =>  $fichaanterior,
                                    ]);
        }

    }

     public function actionEditarReingresoFichaSocioEconomica($idopcion,$idregistro) {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Anadir');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        View::share('titulo','Modificar Ficha SocioEconomica Reingreso');
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
            $combofrecuenciaactividadusuario    =   $this->ge_getComboConceptos($this->codfrecuenciaactividad,$beneficiario->frecuenciaactividadusuario_id);

        }
        else{
            $comboestadocivil       =   $this->ge_getComboConceptos($this->codestadocivil);
            $comboniveleducativo    =   $this->ge_getComboConceptos($this->codniveleducativo);
            $combotipodeseguro      =   $this->ge_getComboConceptos($this->codtipodeseguro);
            $combofrecuenciaactividadusuario    =   $this->ge_getComboConceptos($this->codfrecuenciaactividad);

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


        //porgrama beneficiario usuario
        $listaprogramabeneficiario      =   $this->ge_getlistaConceptos($this->codprogramabeneficiario);


        $programausuario                =   Vivienda::where('concepto','=', 'programabeneficiariousuario')
                                                    ->where('ficha_id','=', $registro_id)
                                                    ->where('activo','=','1')->pluck('materialvivienda_id')->toArray();


        $listaactividadeseconomicasfh   =   $this->ge_getListaActividadesEconomicasFH($registro_id);

        //dd($programausuario);

        return View::make($this->rutaview.'/editarficha',
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


                'programausuario'                   =>      $programausuario,
                'listaprogramabeneficiario'         =>      $listaprogramabeneficiario,
                'combofrecuenciaactividadusuario'   =>      $combofrecuenciaactividadusuario,
                'listaactividadeseconomicasfh'      =>      $listaactividadeseconomicasfh,


            ]);
    }
}
