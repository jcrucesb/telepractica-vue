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
    Route::get('/admin/profile', [App\Http\Controllers\Admin\UserController::class, 'get_profile'])->name('user.profile');
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
    Route::put('/admin/empresa/update/{id}', [App\Http\Controllers\Admin\EmpresaController::class, 'update']);

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

    /////////////////
    // POSTULACION //
    /////////////////
    // POSTULACION: Routes
    Route::resource('admin/postulacion', App\Http\Controllers\Admin\PostulacionController::class);
    // POSTULACION : Vue Axios API Routes
    Route::get('/admin/api/postulacion/get-all', [App\Http\Controllers\Admin\PostulacionController::class, 'get_all']);
    Route::get('/admin/api/postulacion/get-all-by-practicante/{id}', [App\Http\Controllers\Admin\PostulacionController::class, 'get_all_by_practicante']);

    ////////////
    // REGION //
    ////////////
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

//Esta ruta es para listar todas las OFERTAS disponibles, por Jair.
Route::get('listarOfertas', [App\Http\Controllers\Admin\OfertaController::class, 'listarOfertas']);

//Esta ruta es para Registrar las EMPRESAS desde la vista welcome, por Jair.
Route::post('regitEmpresa', [App\Http\Controllers\Admin\EmpresaController::class, 'regitEmpresa']);

//Esta ruta es para Registrar las EMPRESAS desde la vista welcome, por Jair.
Route::get('listarCarreras', [App\Http\Controllers\Admin\CarreraController::class, 'listarCarreras']);

//Esta ruta es para Registrar a los PRACTICANTES desde la vista welcome, por Jair.
Route::post('registPrac', [App\Http\Controllers\Admin\PracticanteController::class, 'registPrac']);

/*Esta es la ruta de registro para el formulario de los Practicantes.*/
Route::get('/registroTelepracticante', function(){
    return view('registroTelepracticante');
  })->name('registro');

//Esta ruta es para listar las Regiones del form de Registro de los PRACTICANTES desde la vista registro, por Jair.
Route::get('listarRegion', [App\Http\Controllers\Admin\RegionController::class, 'listarRegion']);

//Esta ruta es para listar las Comunas del form de Registro de los PRACTICANTES desde la vista registro, por Jair.
Route::get('listarComunas', [App\Http\Controllers\Admin\ComunaController::class, 'listarComunas']);

//Esta ruta es para listar las Comunas del form de Registro de los PRACTICANTES desde la vista registro, por Jair.
Route::get('insti', [App\Http\Controllers\Admin\InstitucionController::class, 'insti']);

//Esta ruta es para listar las Comunas del form de Registro de los PRACTICANTES desde la vista registro, por Jair.
Route::get('nivelEduc', [App\Http\Controllers\Admin\NivelEducacionalController::class, 'nivelEduc']);

//Esta ruta es para listar las Comunas del form de Registro de los PRACTICANTES desde la vista registro, por Jair.
Route::get('prac', [App\Http\Controllers\Admin\TipoPracticaController::class, 'prac']);

//Esta ruta es para listar las Comunas del form de Registro de los PRACTICANTES desde la vista registro, por Jair.
Route::post('formPrac', [App\Http\Controllers\Admin\PracticanteController::class, 'formPrac'])->name('formPrac');
