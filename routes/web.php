<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Group Route
Route::group(['middleware' => 'auth'], function () {
    ///////////
    // ADMIN //
    ///////////
    // ADMIN: Routes
    Route::get('/admin-home', [App\Http\Controllers\AdminHomeController::class, 'index'])->name('admin.home');
    //Route::get('/admin/profile', [App\Http\Controllers\Admin\UserController::class, 'get_profile'])->name('user.profile');
    Route::post('/admin/profile', [App\Http\Controllers\Admin\UserController::class, 'post_profile'])->name('user.post-profile');

    //////////
    // USER //
    //////////
    // USER: Routes
    Route::resource('admin/user', App\Http\Controllers\Admin\UserController::class);
    // USER: Vue Axios API Routes
    Route::get('/admin/api/user/get-all', [App\Http\Controllers\Admin\UserController::class, 'get_all'])->name('user.get-all');
    Route::get('/admin/api/user/get-all-empresa', [App\Http\Controllers\Admin\UserController::class, 'get_all_empresa'])->name('user.get-all-empresa');
    Route::get('/admin/api/user/get-all-institucion', [App\Http\Controllers\Admin\UserController::class, 'get_all_institucion'])->name('user.get-all-institucion');
    Route::get('/admin/api/user/get-all-practicante', [App\Http\Controllers\Admin\UserController::class, 'get_all_practicante'])->name('user.get-all-practicante');
    Route::get('/admin/api/user/get-stats', [App\Http\Controllers\Admin\UserController::class, 'get_stats'])->name('user.get-stats');
    Route::get('/admin/api/user/get-stats-empresa', [App\Http\Controllers\Admin\UserController::class, 'get_stats_empresa'])->name('user.get-stats-empresa');
    Route::get('/admin/api/user/get-stats-institucion', [App\Http\Controllers\Admin\UserController::class, 'get_stats_institucion'])->name('user.get-stats-institucion');
    Route::get('/admin/api/user/get-stats-practicante', [App\Http\Controllers\Admin\UserController::class, 'get_stats_practicante'])->name('user.get-stats-practicante');
    // USER: Vue Axios Routes
    Route::post('/admin/user/create', [App\Http\Controllers\Admin\UserController::class, 'store']);
    Route::put('/admin/user/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'update']);
    Route::put('/admin/user/down/{id}', [App\Http\Controllers\Admin\UserController::class, 'down']);
    Route::put('/admin/user/to-premium/{id}', [App\Http\Controllers\Admin\UserController::class, 'to_premium']);

    /////////////////
    // PRACTICANTE //
    /////////////////
    // PRACTICANTE: Routes
    Route::resource('admin/practicante', App\Http\Controllers\Admin\PracticanteController::class);
    // PRACTICANTE: Vue Axios API Routes
    Route::get('/admin/api/practicante/get-all', [App\Http\Controllers\Admin\PracticanteController::class, 'get_all']);
    Route::get('/admin/api/practicante/get-practicante/{id}', [App\Http\Controllers\Admin\PracticanteController::class, 'get_practicante']);
    // PRACTICANTE: Vue Axios Routes
    Route::post('/admin/practicante/create', [App\Http\Controllers\Admin\PracticanteController::class, 'store']);
    Route::put('/admin/practicante/update/{id}', [App\Http\Controllers\Admin\PracticanteController::class, 'update']);
    /*Ruta pata listar las OFERTAS con PRACTICANTES desde el dashboard EMPRESA, Jair.*/
    //Route::get('/api/practicante/listarPracticantes', [App\Http\Controllers\Admin\EmpresaController::class, 'listarPracticantes']);
    /*Ruta pata listartodos los CEETIFICADOS de los PRACTICANTES desde el dashboard Practicante, Jair.*/
    //Route::get('/api/practicante/certificadosPracticantes', [App\Http\Controllers\Admin\PracticanteController::class, 'certificadosPracticantes']);
    /*Ruta para listar el CURRICULUM de los PRACTICANTES desde el dashboard Practicante, Jair.*/
    //Route::get('/api/practicante/curriculumPracticantes', [App\Http\Controllers\Admin\PracticanteController::class, 'curriculumPracticantes']);
    
    //Ruta para editar el CURRICULUM del PRACTICANTE desde el DASHBOARD, Jair.
    //Route::post('/admin/practicante/editarCurriculum', [App\Http\Controllers\Admin\PracticanteController::class, 'editarCurriculum']);


    //Ruta para ELIMINAR el curso con el CERTIFICADO del PRACTICANTE desde el DASHBOARD, Jair.
    //Route::delete('/admin/practicante/eliminar_curriculum/{id}', [App\Http\Controllers\Admin\PracticanteController::class, 'eliminar_curriculum']);
    
    /*Ruta para listar el CURRICULUM de los PRACTICANTES desde el dashboard Practicante, Jair.*/
    //Route::post('/admin/practicante/crearCurriculum', [App\Http\Controllers\Admin\PracticanteController::class, 'crearCurriculum']);
    //Ruta para editar los campos del CERTIFICADO del PRACTICANTE desde el DASHBOARD, Jair.
    //Route::post('/admin/practicante/editarCertificado', [App\Http\Controllers\Admin\PracticanteController::class, 'editarCertificado']);
    //Ruta para crear el curso con el CERTIFICADO del PRACTICANTE desde el DASHBOARD, Jair.
    //Route::post('/admin/practicante/crearCurso', [App\Http\Controllers\Admin\PracticanteController::class, 'crearCurso']);
    //Ruta para ELIMINAR el curso con el CERTIFICADO del PRACTICANTE desde el DASHBOARD, Jair.
    //Route::delete('/admin/practicante/eliminar_curso/{id}', [App\Http\Controllers\Admin\PracticanteController::class, 'eliminar_curso']);
    //Esta ruta es para obtener los datos del PRACTICANTE y pueda EDITARLOS desde su DASHBOARD, por Jair.
    //Route::get('/admin/api/practicante/datPract', [App\Http\Controllers\Admin\PracticanteController::class, 'datPract']);
    //Esta ruta es para EDITAR desde el FORM de registro sin archivos los datos PRACTICANTES desde el DASHBOARD, por Jair.
    //Route::post('/admin/api/practicante/editarFormPrac', [App\Http\Controllers\Admin\PracticanteController::class, 'editarFormPrac']);
    /////////////
    // EMPRESA //
    /////////////
    // EMPRESA: Routes
    Route::resource('admin/empresa', App\Http\Controllers\Admin\EmpresaController::class);
    // EMPRESA: Vue Axios API Routes
    Route::get('/admin/api/empresa/get-all', [App\Http\Controllers\Admin\EmpresaController::class, 'get_all']);
    Route::get('/admin/api/empresa/get-empresa/{id}', [App\Http\Controllers\Admin\EmpresaController::class, 'get_empresa']);
    // EMPRESA: Vue Axios Routes
    Route::post('/admin/empresa/create', [App\Http\Controllers\Admin\EmpresaController::class, 'store']);
    /*Esta ruta es para registrar las OFERTAS por parte de las EMPRESAS, Jair.*/
    //Route::post('/admin/empresa/registrarOfer', [App\Http\Controllers\Admin\EmpresaController::class, 'registrarOfer']);

    //Ruta para editar una Oferta.
    //Route::put('/admin/empresa/editar_oferta/{idOferta}', [App\Http\Controllers\Admin\EmpresaController::class, 'editar_oferta']);

    Route::put('/admin/empresa/update/{id}', [App\Http\Controllers\Admin\EmpresaController::class, 'update']);

    /*Enviar citación desde el DASHBOARD a PRACTICANTE por parte de la EMPRESA.*/
    //Route::post('/admin/empresa/enviarPostulacionPracticante', [App\Http\Controllers\Admin\EmpresaController::class, 'enviarPostulacionPracticante']);

    /*Enviar citación desde el DASHBOARD a PRACTICANTE por parte de la EMPRESA.*/
    //Route::get('/practicantesConfirmaron', [App\Http\Controllers\Admin\EmpresaController::class, 'practicantesConfirmaron']);
    
    /*EDITAR datos desde el DASHBOARD del PRACTICANTE.*/
    //Route::put('/admin/empresa/editarDatosPrac/{id}', [App\Http\Controllers\Admin\EmpresaController::class, 'editarDatosPrac']);

    //Esta ruta es para obtener los datos de la EMPRESA y pueda EDITARLOS desde su DASHBOARD, por Jair.
    //Route::get('/empresa/datEmp', [App\Http\Controllers\Admin\EmpresaController::class, 'datEmp']);

    /*EDITAR datos desde el DASHBOARD de la EMPRESA.*/
    //Route::put('/admin/empresa/editarDatosEmp/{id}', [App\Http\Controllers\Admin\EmpresaController::class, 'editarDatosEmp']);


    /////////////////
    // INSTITUCION //
    /////////////////
    // INSTITUCION: Routes
    Route::resource('admin/institucion', App\Http\Controllers\Admin\InstitucionController::class);
    // INSTITUCION: Vue Axios API Routes
    Route::get('/admin/api/institucion/get-all', [App\Http\Controllers\Admin\InstitucionController::class, 'get_all']);
    Route::get('/admin/api/institucion/get-institucion/{id}', [App\Http\Controllers\Admin\InstitucionController::class, 'get_institucion']);
    // EMPRESA: Vue Axios Routes
    Route::post('/admin/institucion/create', [App\Http\Controllers\Admin\InstitucionController::class, 'store']);
    Route::put('/admin/institucion/update/{id}', [App\Http\Controllers\Admin\InstitucionController::class, 'update']);

    //////////
    // AREA //
    //////////
    // AREA : Vue Axios API Routes
    Route::get('/admin/api/area/get-all', [App\Http\Controllers\Admin\AreaController::class, 'get_all']);

    /////////////
    // CARRERA //
    /////////////
    // CARRERA: Routes
    Route::resource('admin/carrera', App\Http\Controllers\Admin\CarreraController::class);
    // CARRERA : Vue Axios API Routes
    Route::get('/admin/api/carrera/get-all', [App\Http\Controllers\Admin\CarreraController::class, 'get_all']);
    Route::get('/admin/api/carrera/get-all-by-institucion/{id}', [App\Http\Controllers\Admin\CarreraController::class, 'get_all_by_institucion']);
    
    /*Listar las carreras en el Formulario de Registro Oferta, Jair*/
    //Route::get('/admin/api/carrera/listCarreras', [App\Http\Controllers\Admin\CarreraController::class, 'listCarreras']);

    ////////////
    // COMUNA //
    ////////////
    // COMUNA: Routes
    Route::resource('admin/comuna', App\Http\Controllers\Admin\ComunaController::class);
    // COMUNA : Vue Axios API Routes
    Route::get('/admin/api/comuna/get-all', [App\Http\Controllers\Admin\ComunaController::class, 'get_all']);
    Route::get('/admin/api/comuna/get-all-by-region/{id}', [App\Http\Controllers\Admin\ComunaController::class, 'get_all_by_region']);

    ////////////////////
    // ESTADO_USUARIO //
    ////////////////////
    // ESTADO_USUARIO : Vue Axios API Routes
    Route::get('/admin/api/estado-usuario/get-all', [App\Http\Controllers\Admin\EstadoUsuarioController::class, 'get_all']);

    /////////////////
    // ESTADO_POST //
    /////////////////
    // ESTADO_POST : Vue Axios API Routes
    Route::get('/admin/api/estado-post/get-all', [App\Http\Controllers\Admin\EstadoPostController::class, 'get_all']);

    ///////////////////////
    // NIVEL_EDUCACIONAL //
    ///////////////////////
    // NIVEL_EDUCACIONAL : Vue Axios API Routes
    Route::get('/admin/api/nivel-educacional/get-all', [App\Http\Controllers\Admin\NivelEducacionalController::class, 'get_all']);

    ////////////
    // OFERTA //
    ////////////
    // OFERTA: Routes
    Route::resource('admin/oferta', App\Http\Controllers\Admin\OfertaController::class);
 
    // OFERTA : Vue Axios API Routes
    Route::get('/admin/api/oferta/get-all', [App\Http\Controllers\Admin\OfertaController::class, 'get_all']);
    
    //Esta ruta es para listar todas las OFERTAS disponibles, por Jair.
    //Route::get('/admin/api/oferta/listarOfertas', [App\Http\Controllers\Admin\OfertaController::class, 'listarOfertas']);

    //Esta ruta es para listar el ESTADO de las OFERTAS para EDITAR, por Jair.
    //Route::get('/admin/api/oferta/listarEstadoOfertas', [App\Http\Controllers\Admin\OfertaController::class, 'listarEstadoOfertas']);

    /*Esta es la ruta patra eliminar una OFERTA desde el dashboard EMPRESA, Jair*/
    //Route::delete('/admin/api/oferta/eliminar_oferta/{idOferta}', [App\Http\Controllers\Admin\OfertaController::class, 'eliminar_oferta']);

    //////////////////////////////////////////////
    // POSTULACION //
    /////////////////
    // POSTULACION: Routes
    Route::resource('admin/postulacion', App\Http\Controllers\Admin\PostulacionController::class);
    // POSTULACION : Vue Axios API Routes
    Route::get('/admin/api/postulacion/get-all', [App\Http\Controllers\Admin\PostulacionController::class, 'get_all']);
    Route::get('/admin/api/postulacion/get-all-by-practicante/{id}', [App\Http\Controllers\Admin\PostulacionController::class, 'get_all_by_practicante']);
    
    ////////////
    // REGION //
    ///////////
    // REGION : Vue Axios API Routes
    Route::get('/admin/api/region/get-all', [App\Http\Controllers\Admin\RegionController::class, 'get_all']);

    /////////
    // ROL //
    /////////
    // ROL : Vue Axios API Routes
    Route::get('/admin/api/rol/get-all', [App\Http\Controllers\Admin\RolController::class, 'get_all']);
    Route::get('/admin/api/rol/get-all-for-empresa', [App\Http\Controllers\Admin\RolController::class, 'get_all_for_empresa']);

    ///////////////////
    // TIPO_PRACTICA //
    ///////////////////
    // TIPO_PRACTICA : Vue Axios API Routes
    Route::get('/admin/api/tipo-practica/get-all', [App\Http\Controllers\Admin\TipoPracticaController::class, 'get_all']);

});



//Esta ruta es para Registrar las EMPRESAS desde la vista welcome, por Jair.
//Route::post('regitEmpresa', [App\Http\Controllers\Admin\EmpresaController::class, 'regitEmpresa']);

//Esta ruta es para Registrar a los PRACTICANTES desde la vista welcome, por Jair.
//Route::post('registPrac', [App\Http\Controllers\Admin\PracticanteController::class, 'registPrac']);

/*Esta es la ruta de registro para el formulario de los Practicantes.*/
Route::get('/registroTelepracticante', function(){
    return view('registroTelepracticante');
  })->name('registro');

//Esta ruta es para listar las Regiones del form de Registro de los PRACTICANTES desde la vista registro, por Jair.
//Route::get('listarRegion', [App\Http\Controllers\Admin\RegionController::class, 'listarRegion']);

//Esta ruta es para listar las Comunas del form de Registro de los PRACTICANTES desde la vista registro, por Jair.
//Route::post('listarComunas', [App\Http\Controllers\Admin\ComunaController::class, 'listarComunas']);

//Esta ruta es para listar las Comunas del form de Registro de los PRACTICANTES desde la vista registro, por Jair.
//Route::get('insti', [App\Http\Controllers\Admin\InstitucionController::class, 'insti']);

//Esta ruta es para listar las CARRERAS del form de Registro de los PRACTICANTES desde EL dashboard, por Jair.
Route::get('listarCarrera', [App\Http\Controllers\Admin\CarreraController::class, 'listarCarrera']);


//Esta ruta es para listar las Comunas del form de Registro de los PRACTICANTES desde la vista registro, por Jair.
Route::get('nivelEduc', [App\Http\Controllers\Admin\NivelEducacionalController::class, 'nivelEduc']);

//Esta ruta es para listar las Comunas del form de Registro de los PRACTICANTES desde la vista registro, por Jair.
Route::get('prac', [App\Http\Controllers\Admin\TipoPracticaController::class, 'prac']);

//Esta ruta es para listar las Comunas del form de Registro de los PRACTICANTES desde la vista registro, por Jair.
//Route::post('formPrac', [App\Http\Controllers\Admin\PracticanteController::class, 'formPrac'])->name('formPrac');

//Ruta para obtener el estado de las ofertas, Jair.
Route::get('estadoOfert', [App\Http\Controllers\Admin\EstadoPostController::class, 'estadoOfert']);

/*Ruta para registrar la postulación del PRACTICANTE, Jair.*/
//Route::get('/admin/api/oferta/listarOfertaPracticante', [App\Http\Controllers\Admin\OfertaController::class, 'listarOfertaPracticante']);

/*Ruta para registrar la postulación del PRACTICANTE, Jair.*/
//Route::post('store', [App\Http\Controllers\Admin\OfertaController::class, 'store']);

/*Esta es la ruta de la vista de a CONFIRMACIÓN del PRACTICANTE a entrevista, Jair.*/
Route::get('/confirmacionFechaCitacion', function(){
    return view('confirmacionFechaCitacion');
})->name('confirmacionFechaCitacion');

//Esta ruta es para la CONFIRMACIÓN por parte del PRACTICANTE a la fecha de citación dada por la EMPRESA, por Jair.
//Route::post('confirmacionPracticante', [App\Http\Controllers\Admin\EmpresaController::class, 'confirmacionPracticante']);

/*Esta es la ruta de la vista de los DATOS del PRACTICANTE desde su DASHBOARD, Jair.*/
Route::get('practicantes/datosPersonales', function(){
    return view('practicantes/datosPersonales');
})->name('datosPersonales');

/*Esta es la ruta de la vista de los DATOS del PRACTICANTE desde su DASHBOARD, Jair.*/
Route::get('empresas/datosEmpresa', function(){
    return view('empresas/datosEmpresa');
})->name('datosEmpresa');

/*Esta es la ruta del archivo bienvenidaEmpresa, Jair.*/
Route::get('emails/bienvenidaEmpresa', function(){
    return view('emails/bienvenidaEmpresa');
})->name('bienvenidaEmpresa');

/*Esta es la ruta es para las que las EMPRESAS puedan ver que PRACTICANTES aceptaron la fecha de entrevista desde el DASHBOARD, Jair.*/
Route::get('empresas/confirmacionEntrevistaPracticantes', function(){
    return view('empresas/confirmacionEntrevistaPracticantes');
})->name('confirmacionEntrevistaPracticantes');

/*Esta es la vista del PRACTICANTES para ver sus certificados, Jair.*/
Route::get('practicantes/certificadoPracticante', function(){
    return view('practicantes/certificadoPracticante');
})->name('certificadoPracticante');

/*Vista para la asección del CURRICULUM, Jair.*/
Route::get('practicantes/curriculumPracticante', function(){
    return view('practicantes/curriculumPracticante');
  })->name('curriculumPract');

/*Vista para EDITAR los datos personales del PRACTICANTE desde su DASHBOARD, Jair.*/
Route::get('registroPracticanteDashboard', function(){
    return view('registroPracticanteDashboard');
  })->name('editarTelepracticante');

/*Vista para las OFERTAS del DASHBOARD PRACTICANTES, Jair.*/
Route::get('/practicantes/index', function(){
    return view('practicantes.index');
  })->name('practicante.index');

 /*Vista para las OFERTAS del DASHBOARD EMPRESAS, Jair.*/
 Route::get('/empresas/index', function(){
    return view('empresas.index');
  })->name('empresa.index');