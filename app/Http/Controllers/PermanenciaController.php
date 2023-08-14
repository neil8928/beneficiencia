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

use App\Modelos\Permanencia as Registro;
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


class PermanenciaController extends Controller
{
    //
      use GeneralesTraits;
    use ClonarTraits;    
    private   $tituloview               =   'Cosecha Productos';
    private   $ruta                     =   'permanencia';
    private   $urlprincipal             =   'gestion-variables-permanencia';
    private   $urlcompleto              =   'gestion-variables-permanencia';
    private   $urlopciones              =   'variables-permanencia';
    private   $rutaview                 =   'permanencia';

    private   $rutaviewblade            =   'permanencia';

    private   $rutaviewbladegeneral     =   'general';
    private   $tregistro                =   'permanencia';
    private   $tfoto                    =   'multimedias';
    private   $idmodal                  =   'modpermanencia';

    private   $categoria_id             =   3;
    private   $pathLocal                =   'permanencia/';
    private   $carpetaimg               =   'cp/';


    public function actionListarPermanencia($idopcion) 
    {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Ver');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        View::share('titulo','Lista de Permanencias');
        $user_id            =   Session::get('usuario')->id;
        $rol_id             =   $this->ge_getRolEncuestador();
        $comboencuestadores =   $this->ge_getComboEncuestadores($rol_id);    
        $listadatos         =   Registro::from($this->tregistro.' as R')
                                ->where('R.activo','=',1)
                                ->orderby('R.id','asc')
                                ->get();
        

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


    public function actionEliminarPermanencia($idopcion,$idregistro)
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
                                'updated_at'=>$this->fechaactual,
                                'fechamod'=>$this->fechaactual,
                                'usermod'=>Session::get('usuario')->id
                            ]
                        );
            // $this->setLogFichaSocioEconomica($registro_id,'Eliminar-Ficha-Socioeconomica','');
            DB::commit();
        }catch(\Exception $ex){
            DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
        }
        return Redirect::to($this->urlprincipal.'/' . $idopcion)->with('bienhecho', 'Permanencia Eliminada con exito');
    }

    public function actionDetallePermanencia($idopcion,$idregistro){
           /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Ver');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/

        $registro_id    = $this->decodificar($idregistro);
        View::share('titulo','Detalle Permanencia');
        $user_id            =   Session::get('usuario')->id;
        $rol_id             =   $this->ge_getRolEncuestador();
        // $comboencuestadores =   $this->ge_getComboEncuestadores($rol_id);    
        $registro         =   Registro::where('id','=',$registro_id)
                                // ->orderby('id','asc')
                                ->first();
        

        return View::make($this->rutaview.'/detalle',
            [
                'idopcion'          =>  $idopcion,
                'idregistro'        =>  $idregistro,
                'view'              =>  $this->rutaviewblade,
                'url'               =>  $this->urlopciones,
                'urlcompleta'       =>  $this->urlprincipal,
                'ruta'              =>  $this->ruta,
                'idmodal'           =>  $this->idmodal,
                'registro'           =>  $registro,
                // 'comboencuestadores'  =>  $comboencuestadores,
            ]);
    }

     public function actionRegistrarPermanencia($idopcion,Request $request) 
    {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion, 'Anadir');
        if ($validarurl != 'true') {return $validarurl;}
        /******************************************************/
        View::share('titulo','Registrar Variable Permanencia');
        $user_id            =   Session::get('usuario')->id;
        $generado           =   Estado::where('descripcion','=','GENERADO')->first();
        $usuario            =   User::find($user_id);

        if ($_POST) {
            try{

                DB::beginTransaction();
                $descripcion        = $request['descripcion'];
                $edadmin            = (int)$request['edadmin'];
                $edadmax            = ((int)$request['edadmax']==0)?NULL:$emax;
                $indvulnerabilidad  = (int)$request['indvulnerabilidad'];
                $indriesgosocial    = (int)$request['indriesgosocial'];
                $indsueldo          = (int)$request['indsueldo'];
                $sueldomaximo       = (float)$request['sueldomaximo'];
                $indcantpersonas    = (int)$request['indcantpersonas'];
                $cantpersonas       = (float)$request['cantpersonas'];
                $indsinlimite        = (int)$request['indsinlimite'];
                $anios              = (int)$request['anios'];
                $meses              = (int)$request['meses'];
                $dias               = (int)$request['dias'];
              
               
              
                $cabecera = new Registro();
                $idnuevo =  $this->ge_getNuevoId($this->tregistro);
                $cabecera->id = $idnuevo;

                $cabecera->descripcion          = $descripcion;
                $cabecera->indsinlimite         = $indsinlimite;
                $cabecera->indvulnerabilidad    = $indvulnerabilidad;
                $cabecera->indriesgosocial      = $indriesgosocial;
                $cabecera->indsueldo            = $indsueldo;
                $cabecera->sueldomaximo         = $sueldomaximo;
                $cabecera->indcantpersonas      = $indcantpersonas;
                $cabecera->cantpersonas         = $cantpersonas;
                $cabecera->anios                = $anios;
                $cabecera->meses                = $meses;
                $cabecera->dias                 = $dias;
                $cabecera->edadmin              = $edadmin;
                $cabecera->edadmax              = $edadmax;
                $cabecera->created_at           = $this->fechaactual;
                $cabecera->activo               = 1;
                $cabecera->usercrea             = $user_id;
                $cabecera->fechacrea            = $this->fechaactual;
                
                $cabecera->save();

                DB::commit();

            }catch(\Exception $ex){
                DB::rollback(); 
                $sw =   1;
                $mensaje  = $this->ge_getMensajeError($ex);
                // dd($mensaje);
                // $mensaje  = 'Ocurrio un error al intentar Guardar la información';
                return Redirect::to($this->urlprincipal.'/' . $idopcion)->with('errorbd', $mensaje);

            }
            return Redirect::to($this->urlprincipal.'/'.$idopcion)->with('bienhecho', 'Variable registrada con exito');
        } 
        else {

            return View::make($this->rutaview.'/agregar',
                                    [
                                        'idopcion'                          =>      $idopcion,
                                        'view'                              =>      $this->rutaviewblade,
                                        'url'                               =>      $this->urlopciones,
                                    ]);
        }

    }
    //
}


