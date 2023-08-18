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


use GuzzleHttp\Client;
use App\Traits\GeneralesTraits;

class GeneralAjaxController extends Controller
{
      use GeneralesTraits;
    private   $tituloview               =   'Cosecha Productos';
    private   $ruta                     =   'generalajax';
    private   $urlprincipal             =   'gestion-ficha-socieconomica';
    private   $urlcompleto              =   'gestion-ficha-socieconomica';
    private   $urlopciones              =   'ficha-socieconomica';
    private   $rutaview                 =   'general';

    private   $rutaviewblade            =   'productos';

    private   $rutaviewbladegeneral     =   'general';
    private   $tregistro                =   'generalajax';
    private   $tfoto                    =   'multimedias';
    private   $idmodal                  =   'modgeneralajax';

    private   $categoria_id             =   3;
    private   $pathLocal                =   'generalajax/';
    private   $carpetaimg               =   'cp/';


     public function actionProvinciaAjax(Request $request) {
        $departamento_id   = $request['iddepartamento'];

        $provincia = DB::table('provincias')->where('departamento_id','=',$departamento_id)->pluck('descripcion','id')->toArray();
        $comboprovincia  = ['' => "Ubicacion"] + $provincia;

        return View::make($this->rutaview.'/ajax/comboprovincia',
                         [
                         'comboprovincia' => $comboprovincia
                         ]);
    }

    public function actionDistritoAjax(Request $request)
    {
        $provincia_id   = $request['idprovincia'];

        $distrito = DB::table('distritos')->where('provincia_id','=',$provincia_id)->pluck('descripcion','id')->toArray();
        $combodistrito  = ['' => "Ubicacion"] + $distrito;

        return View::make($this->rutaview.'/ajax/combodistrito',
                         [
                         'combodistrito' => $combodistrito,
                         'ajax' => true
                         ]);
    }   

}
