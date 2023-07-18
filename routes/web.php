<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

/********************** USUARIOS *************************/
// header('Access-Control-Allow-Origin:  *');
// header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
// header('Access-Control-Allow-Headers: *');

Route::group(['middleware' => ['guestaw']], function () {

	Route::any('/', 'UserController@actionLogin');
	Route::any('/login', 'UserController@actionLogin');
	Route::any('/acceso', 'UserController@actionAcceso');

});

Route::get('/cerrarsession', 'UserController@actionCerrarSesion');

Route::group(['middleware' => ['authaw']], function () {

	Route::get('/bienvenido', 'UserController@actionBienvenido');

	Route::any('/gestion-de-usuarios/{idopcion}', 'UserController@actionListarUsuarios');
	Route::any('/agregar-usuario/{idopcion}', 'UserController@actionAgregarUsuario');
	Route::any('/modificar-usuario/{idopcion}/{idusuario}', 'UserController@actionModificarUsuario');
	Route::any('/ajax-activar-perfiles', 'UserController@actionAjaxActivarPerfiles');

	Route::any('/gestion-de-roles/{idopcion}', 'UserController@actionListarRoles');
	Route::any('/agregar-rol/{idopcion}', 'UserController@actionAgregarRol');
	Route::any('/modificar-rol/{idopcion}/{idrol}', 'UserController@actionModificarRol');

	Route::any('/gestion-de-permisos/{idopcion}', 'UserController@actionListarPermisos');
	Route::any('/ajax-listado-de-opciones', 'UserController@actionAjaxListarOpciones');
	Route::any('/ajax-activar-permisos', 'UserController@actionAjaxActivarPermisos');

	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////
 	// SECCION DE GRUPO OPCIONES
	///////////////////////////////////////////////////////////////////////////////////////////////////////////
	Route::any('/gestion-de-grupoopciones/{idopcion}', 'UserController@actionListarGrupoOpciones');
	Route::any('/agregar-grupoopcion/{idopcion}', 'UserController@actionAgregarGrupoOpcion');
	Route::any('/modificar-grupoopcion/{idopcion}/{idregistro}', 'UserController@actionModificarGrupoOpcion');

	///////////////////////////////////////////////////////////////////////////////////////////////////////////
 	// SECCION DE OPCIONES
	///////////////////////////////////////////////////////////////////////////////////////////////////////////
	Route::any('/gestion-de-opciones/{idopcion}', 'UserController@actionListarOpciones');
	Route::any('/agregar-opcion/{idopcion}', 'UserController@actionAgregarOpcion');
	Route::any('/modificar-opcion/{idopcion}/{idregistro}', 'UserController@actionModificarOpcion');

 	

	///////////////////////////////////////////////////////////////////////////////////////////////////////////
 	// FICHA SOCIECONOMICA
	///////////////////////////////////////////////////////////////////////////////////////////////////////////
	Route::any('/gestion-ficha-socieconomica/{idopcion}', 'FichaSocioEconomicaController@actionListarFichaSocioEconomica');
	Route::any('/registrar-ficha-socieconomica/{idopcion}', 'FichaSocioEconomicaController@actionRegistrarFichaSocioEconomica');
	Route::any('/modificar-ficha-socieconomica/{idopcion}/{idregistro}', 'FichaSocioEconomicaController@actionModificarFichaSocioEconomica');
	// Route::any('/agregar-opcion/{idopcion}', 'UserController@actionAgregarOpcion');
	// Route::any('/modificar-opcion/{idopcion}/{idregistro}', 'UserController@actionModificarOpcion');

	Route::any('/ajax-actualizar-tab-datos-generales', 'FichaSocioEconomicaController@actionAjaxActualizarTabDatosGenerales');

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//TAB INFORMACION FAMILIAR
	//TAB BENEFICIAROP
	Route::any('/ajax-actualizar-tab-informacion-familiar-beneficiario', 'FichaSocioEconomicaController@actionAjaxActualizarTabInformacionFamiliarBeneficiario');
	//TAB FAMILIAR
	Route::any('/ajax-tab-informacion-familiar-agregar-otro-familiar', 'FichaSocioEconomicaController@actionAjaxTabInformacionFamiliarAgregarOtroFamiliar');
	Route::any('/ajax-tab-informacion-familiar-eliminar-otro-familiar', 'FichaSocioEconomicaController@actionAjaxTabInformacionFamiliarEliminarOtroFamiliar');
	Route::any('/ajax-get-combo-informacion-familiar', 'FichaSocioEconomicaController@actionAjaxGetComboInformacionFamiliar');
	
	Route::any('/ajax-cargar-combo-familiar-salud', 'FichaSocioEconomicaController@actionAjaxCargarComboFamiliarSalud');
	Route::any('/ajax-cargar-combo-familiar-se', 'FichaSocioEconomicaController@actionAjaxCargarComboFamiliarSE');
	Route::any('/ajax-cargar-combo-familiar-apoyo', 'FichaSocioEconomicaController@actionAjaxCargarComboFamiliarApoyo');
				
	Route::any('/pdf-ficha-socieconomica/{idopcion}/{idregistro}', 'FichaSocioEconomicaController@actionPdfFichaSocioEconomica');

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//TAB SALUD
	//TAB BENEFICIARIO
	Route::any('/ajax-tab-salud-agregar-discapacidad-beneficiario', 'FichaSocioEconomicaController@actionAjaxTabSaludAgregarDiscapacidadBeneficiario');
	Route::any('/ajax-tab-salud-eliminar-discapacidad-beneficiario', 'FichaSocioEconomicaController@actionAjaxTabSaludEliminarDiscapacidadBeneficiario');

	//TAB OTRO
	Route::any('/ajax-tab-salud-agregar-otro-familiar', 'FichaSocioEconomicaController@actionAjaxTabSaludAgregarOtroFamiliar');
	Route::any('/ajax-tab-salud-eliminar-otro-familiar', 'FichaSocioEconomicaController@actionAjaxTabSaludEliminarOtroFamiliar');
	//TAB MORTALIDAD
	Route::any('/ajax-tab-salud-agregar-otro-mortalidad', 'FichaSocioEconomicaController@actionAjaxTabSaludAgregarOtroMortalidad');
	Route::any('/ajax-tab-salud-eliminar-otro-mortalidad', 'FichaSocioEconomicaController@actionAjaxTabSaludEliminarOtroMortalidad');

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//TAB SITUACION ECONOMICA
	Route::any('/ajax-tab-situacion-economica-agregar-otro-familiar', 'FichaSocioEconomicaController@actionAjaxTabSituacionEconomicaAgregarOtroFamiliar');
	Route::any('/ajax-tab-situacion-economica-eliminar-otro-familiar', 'FichaSocioEconomicaController@actionAjaxTabSituacionEconomicaEliminarOtroFamiliar');
	Route::any('/ajax-actualizar-tab-datos-situacion-economica-bienes', 'FichaSocioEconomicaController@actionAjaxActualizarTabDatosSituacionEconomicaBienes');

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//OPCION DOCUMENTOS FICHA
	Route::any('/gestion-documentos-ficha-socioeconomica/{idopcion}/{idficha}', 'FichaSocioEconomicaController@actionListarDocumentosFichaSocioEconomica');
	Route::any('/agregar-documento-ficha-socioeconomica/{idopcion}/{idficha}', 'FichaSocioEconomicaController@actionAgregarDocumentosFichaSocioEconomica');
	Route::any('/eliminar-documento-ficha-socioeconomica/{idopcion}/{idficha}/{idregistro}', 'FichaSocioEconomicaController@actionEliminarDocumentosFichaSocioEconomica');
	Route::any('/descargar-documento-ficha/{idregistro}', 'FichaSocioEconomicaController@actionDescargarDocumentosFichaSocioEconomica');


	//ESTADOS DE LA FICHA SOCIOECONOMICA
	Route::any('/eliminar-ficha-socieconomica/{idopcion}/{idregistro}', 'FichaSocioEconomicaController@actionEliminarFichaSocioEconomica');
	// Route::any('/reevaluar-ficha-socieconomica/{idopcion}/{idregistro}', 'FichaSocioEconomicaController@actionReevaluarFichaSocioEconomica');
	Route::any('/ver-detalle-documentos-ficha-socieconomica/{idopcion}/{idregistro}', 'FichaSocioEconomicaController@actionVerDetalleDocumentosFichaSocioEconomica');
	Route::any('/detalle-ficha-socieconomica/{idopcion}/{idregistro}', 'FichaSocioEconomicaController@actionVerDetalleFichaSocioEconomica');

	// //TAB DOCUMENTOS FICHA
	// Route::any('/ajax-tab-documentos-ficha-agregar', 'FichaSocioEconomicaController@actionAjaxTabSituacionEconomicaAgregarDocumentosFicha');
	// Route::any('/ajax-tab-documentos-ficha-eliminar', 'FichaSocioEconomicaController@actionAjaxTabSituacionEconomicaEliminarDocumentosFicha');
	// // Route::any('/ajax-actualizar-tab-datos-situacion-economica-bienes', 'FichaSocioEconomicaController@actionAjaxActualizarTabDatosSituacionEconomicaBienes');
	// //observacion
	// Route::any('/ajax-modal-documentos-ficha', 'FichaSocioEconomicaController@actionAjaxDocumentosFicha');
	// Route::any('/ajax-guardar-documentos-ficha', 'FichaSocioEconomicaController@actionAjaxGuardarObservacion');


	//NUEVAS OPCIONES DE APROBACION
	///////////////////////////////////////////////////////////////////////////////////////////////////////////
	Route::any('/gestion-pre-aprobar-ficha-socieconomica/{idopcion}', 'FichaSocioEconomicaController@actionListarFichaSocioEconomicaPreAprobar');
	Route::any('/pre-aprobar-ficha-socieconomica/{idopcion}/{idregistro}', 'FichaSocioEconomicaController@actionPreAprobarFichaSocioEconomica');
	Route::any('/detalle-pre-aprobar-ficha-socieconomica/{idopcion}/{idregistro}', 'FichaSocioEconomicaController@actionVerDetallePreAprobarFichaSocioEconomica');
	Route::any('/revertir-pre-aprobacion-ficha-socieconomica/{idopcion}/{idregistro}', 'FichaSocioEconomicaController@actionRevertirPreAprobarFichaSocioEconomica');
	Route::any('/eliminar-pre-aprobar-ficha-socieconomica/{idopcion}/{idregistro}', 'FichaSocioEconomicaController@actionEliminarFichaSocioEconomicaPreAprobada');
	// 
	Route::any('/gestion-aprobar-ficha-socieconomica/{idopcion}', 'FichaSocioEconomicaController@actionListarFichaSocioEconomicaAprobar');
	Route::any('/detalle-aprobar-ficha-socieconomica/{idopcion}/{idregistro}', 'FichaSocioEconomicaController@actionVerDetalleAprobarFichaSocioEconomica');
	Route::any('/aprobar-ficha-socieconomica/{idopcion}/{idregistro}', 'FichaSocioEconomicaController@actionAprobarFichaSocioEconomica');
	Route::any('/revertir-pre-aprobacion-ficha-socieconomica-aprobada/{idopcion}/{idregistro}', 'FichaSocioEconomicaController@actionRevertirPreAprobacionFichaSocioEconomicaAprobada');

	
	
	//REEVALUAR
	Route::any('/gestion-reevaluar-ficha/{idopcion}', 'ReevaluarFichaSocioEconomicaController@actionListarReevaluarFichaSocioEconomica');
	Route::any('/detalle-reevaluar-ficha/{idopcion}/{idregistro}', 'ReevaluarFichaSocioEconomicaController@actionVerDetalleReevaluarFichaSocioEconomica');
	Route::any('/accion-reevaluar-ficha/{idopcion}/{idregistro}', 'ReevaluarFichaSocioEconomicaController@actionReevaluarFichaSocioEconomica');
	Route::any('/editar-reevaluar-ficha/{idopcion}/{idregistro}', 'ReevaluarFichaSocioEconomicaController@actionEditarReevaluarFichaSocioEconomica');
	Route::any('/ajax-actualizar-tab-informacion-familiar-beneficiario-reevaluar', 'ReevaluarFichaSocioEconomicaController@actionAjaxActualizarTabInformacionFamiliarBeneficiarioReevaluar');
	Route::any('/terminar-reevaluar-ficha/{idopcion}/{idregistro}', 'ReevaluarFichaSocioEconomicaController@actionTerminarFichaSocioEconomica');

	//REINGRESO
	Route::any('/gestion-reingreso-beneficiario/{idopcion}', 'ReingresoBeneficiarioController@actionListarReingresoFichaSocioEconomica');
	Route::any('/detalle-reingreso-beneficiario/{idopcion}/{idregistro}', 'ReingresoBeneficiarioController@actionVerDetalleReingresoFichaSocioEconomica');
	Route::any('/accion-reingreso-beneficiario/{idopcion}/{idregistro}', 'ReingresoBeneficiarioController@actionReingresoFichaSocioEconomica');
	Route::any('/editar-reingreso-beneficiario/{idopcion}/{idregistro}', 'ReingresoBeneficiarioController@actionEditarReingresoFichaSocioEconomica');




	//REPORTES
	Route::any('/reporte-todas-ficha-socieconomicas/{idopcion}', 'ReporteFichaSocioEconomicaController@actionListarTodasFichas');
	Route::any('/detalle-reporte-ficha-socieconomica/{idopcion}/{idregistro}', 'ReporteFichaSocioEconomicaController@actionVerDetalleReporteFichaSocioEconomica');
	Route::any('/reporte-tiempo-restante-ficha-socieconomicas/{idopcion}', 'ReporteFichaSocioEconomicaController@actionListarTiempoRestanteFichaSocioEconomica');

	//PERMANENCIA
	Route::any('/gestion-variables-permanencia/{idopcion}', 'PermanenciaController@actionListarPermanencia');
	Route::any('/eliminar-variables-permanencia/{idopcion}/{idregistro}', 'PermanenciaController@actionEliminarPermanencia');
	Route::any('/detalle-variables-permanencia/{idopcion}/{idregistro}', 'PermanenciaController@actionDetallePermanencia');
	Route::any('/registrar-variables-permanencia/{idopcion}', 'PermanenciaController@actionRegistrarPermanencia');

	// Route::any('/registrar-ficha-socieconomica/{idopcion}', 'FichaSocioEconomicaController@actionRegistrarFichaSocioEconomica');
	// Route::any('/modificar-ficha-socieconomica/{idopcion}/{idregistro}', 'FichaSocioEconomicaController@actionModificarFichaSocioEconomica');
	


	Route::any('/ajax-actualizar-tab-datos-evaluacion-profesional', 'FichaSocioEconomicaController@actionAjaxActualizarTabEvaluacionProfesional');
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	Route::any('/ajax-select-provincia', 'GeneralAjaxController@actionProvinciaAjax');
	Route::any('/ajax-select-distrito', 'GeneralAjaxController@actionDistritoAjax');

	
	//vivienda
	Route::any('/ajax-actualizar-tab-datos-vivienda', 'FichaSocioEconomicaController@actionAjaxActualizarTabDatosVivienda');


	//CATEGORIA
	Route::any('/gestion-categorias/{idopcion}', 'CategoriaController@actionListarCategoria');
	Route::any('/ajax-detalle-concepto', 'CategoriaController@actionAjaxDetalleConcepto');
	Route::any('/agregar-concepto/{idopcion}', 'CategoriaController@actionAgregarConcepto');
	Route::any('/modificar-concepto/{idopcion}/{iddetconcepto}', 'CategoriaController@actionModificarconcepto');


	//convivenciafamiliar
	Route::any('/ajax-actualizar-tab-datos-convivencia-familiar', 'FichaSocioEconomicaController@actionAjaxActualizarTabDatosConvivenciaFamiliar');

	//beneficios
	Route::any('/ajax-tab-beneficios-agregar', 'FichaSocioEconomicaController@actionAjaxTabBeneficiosAgregar');
	Route::any('/ajax-tab-beneficios-eliminar', 'FichaSocioEconomicaController@actionAjaxTabBeneficioEliminar');
	Route::any('/ajax-actualizar-tab-datos-programa-usuario', 'FichaSocioEconomicaController@actionAjaxActualizarTabDatosProgramaUsuario');


	//observacion
	Route::any('/ajax-modal-observacion', 'FichaSocioEconomicaController@actionAjaxObservacion');
	Route::any('/ajax-guardar-observacion', 'FichaSocioEconomicaController@actionAjaxGuardarObservacion');

	//clonar
	Route::any('/ajax-modal-clonar', 'FichaSocioEconomicaController@actionAjaxClonar');
	Route::any('/ajax-guardar-clonar', 'FichaSocioEconomicaController@actionAjaxGuardarClonar');


	Route::any('/ajax-tab-situacion-economica-agregar-otro-ingreso', 'FichaSocioEconomicaController@actionAjaxTabSituacionEconomicaAgregarOtroIngreso');
	Route::any('/ajax-tab-situacion-economica-eliminar-otro-ingreso', 'FichaSocioEconomicaController@actionAjaxTabSituacionEconomicaEliminarOtroIngreso');

});


