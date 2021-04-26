<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ApiUserController;
use App\Http\Controllers\api\ApiComunaController;
use App\Http\Controllers\api\ApiOfertaController;
use App\Http\Controllers\api\ApiRegionController;
use App\Http\Controllers\api\ApiCarreraController;
use App\Http\Controllers\api\ApiEmpresaController;
use App\Http\Controllers\api\ApiInstitucionController;
use App\Http\Controllers\api\ApiPracticanteController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
Encryption keys generated successfully.
Personal access client created successfully.
Client ID: 1
Client secret: s3MjepjqfPQulHUJdFT054DjxAMqPs9jcyJVyJSx
Password grant client created successfully.
Client ID: 2
Client secret: TcKELXgscH1zLFlefeDGP7HD2OmUoXlww0rKxStc
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
    //return $request->user();
//});
//**************** Ruta del LOGIN ********************//
Route::post('/users/logins', [ApiUserController::class, 'logins']);
Route::get('/users', [ApiUserController::class, 'logout'])->middleware('auth:api');
Route::get('/users/obtenerUsuario', [ApiUserController::class, 'obtenerUsuario']);

Route::get('/users/get_profile', [ApiUserController::class, 'get_profile'])->name('user.profile')->middleware('auth:api');

//******** Ruta de solo los PRACTICANTES *********//
//Esta ruta es para Registrar a los PRACTICANTES desde la vista welcome, por Jair.
Route::post('/practicantes/registPrac', [ApiPracticanteController::class, 'registPrac']);
/*Ruta para listar el CURRICULUM de los PRACTICANTES desde el dashboard Practicante, Jair.*/
Route::get('/practicantes/curriculumPracticantes', [ApiPracticanteController::class, 'curriculumPracticantes'])->middleware('auth:api');
/*Ruta para listar el CURRICULUM de los PRACTICANTES desde el dashboard Practicante, Jair.*/
Route::post('/practicantes/crearCurriculum', [ApiPracticanteController::class, 'crearCurriculum'])->middleware('auth:api');
//Ruta para editar el CURRICULUM del PRACTICANTE desde el DASHBOARD, Jair.
Route::post('/practicantes/editarCurriculum', [ApiPracticanteController::class, 'editarCurriculum'])->middleware('auth:api');
//Ruta para ELIMINAR el curso con el CERTIFICADO del PRACTICANTE desde el DASHBOARD, Jair.
Route::delete('/practicantes/eliminar_curriculum/{id}', [ApiPracticanteController::class, 'eliminar_curriculum'])->middleware('auth:api');
/*Ruta pata listartodos los CEETIFICADOS de los PRACTICANTES desde el dashboard Practicante, Jair.*/
Route::get('/practicantes/certificadosPracticantes', [ApiPracticanteController::class, 'certificadosPracticantes'])->middleware('auth:api');
//Ruta para crear el curso con el CERTIFICADO del PRACTICANTE desde el DASHBOARD, Jair.
Route::post('/practicantes/crearCurso', [ApiPracticanteController::class, 'crearCurso'])->middleware('auth:api');
//Ruta para editar los campos del CERTIFICADO del PRACTICANTE desde el DASHBOARD, Jair.
Route::post('/practicantes/editarCertificado', [ApiPracticanteController::class, 'editarCertificado'])->middleware('auth:api');
//Ruta para ELIMINAR el curso con el CERTIFICADO del PRACTICANTE desde el DASHBOARD, Jair.
Route::delete('/practicantes/eliminar_curso/{id}', [ApiPracticanteController::class, 'eliminar_curso'])->middleware('auth:api');

//******** Ruta de solo las EMPRESAS *********//
//Esta ruta es para Registrar las EMPRESAS desde la vista welcome, por Jair.
Route::post('/empresas/regitEmpresa', [ApiEmpresaController::class, 'regitEmpresa']);
//Ruta para editar las OFERTAS de cada EMPRESA desde el DASHBOARD, jair.
Route::put('/empresas/editar_oferta/{idOferta}', [ApiEmpresaController::class, 'editar_oferta'])->middleware('auth:api');
/*Esta ruta es para registrar las OFERTAS por parte de las EMPRESAS, Jair.*/
Route::post('/empresas/registrarOfer', [ApiEmpresaController::class, 'registrarOfer'])->middleware('auth:api');
/*Esta es la ruta patra eliminar una OFERTA desde el dashboard EMPRESA, Jair*/
Route::delete('/ofertas/eliminar_oferta/{idOferta}', [ApiOfertaController::class, 'eliminar_oferta'])->middleware('auth:api');

//Esta ruta es para obtener los datos de la EMPRESA y pueda EDITARLOS desde su DASHBOARD, por Jair.
Route::get('/empresas/datEmp', [ApiEmpresaController::class, 'datEmp'])->middleware('auth:api');

/*EDITAR datos desde el DASHBOARD de la EMPRESA.*/
Route::put('/empresas/editarDatosEmp/{id}', [ApiEmpresaController::class, 'editarDatosEmp'])->middleware('auth:api');

/******************** PRACTICANTES *******************************************************/
//Esta ruta es para la CONFIRMACIÓN por parte del PRACTICANTE a la fecha de citación dada por la EMPRESA, por Jair.
Route::post('/practicantes/confirmacionPracticante', [ApiEmpresaController::class, 'confirmacionPracticante']);

//Esta ruta es para la CONFIRMACIÓN por parte del PRACTICANTE a la fecha de citación dada por la EMPRESA, por Jair.
//Route::post('/practicantes/registrarWelcomePrac', [ApiPracticanteController::class, 'registrarWelcomePrac']);

//Esta ruta es para obtener los datos del PRACTICANTE y pueda EDITARLOS desde su DASHBOARD, por Jair.
Route::get('/practicantes/datPract', [ApiPracticanteController::class, 'datPract'])->middleware('auth:api');

//Esta ruta es para EDITAR desde el FORM de registro sin archivos los datos PRACTICANTES desde el DASHBOARD, por Jair.
Route::post('/practicantes/editarFormPrac', [ApiPracticanteController::class, 'editarFormPrac']);

//Esta ruta es para listar las Comunas del form de Registro de los PRACTICANTES desde la vista registro, por Jair.
Route::post('/practicantes/formPrac', [ApiPracticanteController::class, 'formPrac']);

/*Enviar citación desde el DASHBOARD a PRACTICANTE por parte de la EMPRESA.*/
Route::post('/empresas/enviarPostulacionPracticante', [ApiEmpresaController::class, 'enviarPostulacionPracticante'])->middleware('auth:api');

/*Enviar citación desde el DASHBOARD a PRACTICANTE por parte de la EMPRESA.*/
Route::get('/empresas/practicantesConfirmaron', [ApiEmpresaController::class, 'practicantesConfirmaron'])->middleware('auth:api');

/*EDITAR datos desde el DASHBOARD del PRACTICANTE.*/
Route::put('/empresas/editarDatosPrac/{id}', [ApiEmpresaController::class, 'editarDatosPrac']);

//******** Ruta de solo las CARRERAS *********//
//Esta ruta es para listar las Regiones del form de Registro de los PRACTICANTES desde la vista registro, por Jair.
Route::get('/carreras/listCarreras', [ApiCarreraController::class, 'listCarreras']);

//******** Ruta de solo las OFERTAS *********//
//Esta ruta es para listar todas las OFERTAS disponibles, por Jair.
Route::get('/ofertas/listOfertas', [ApiOfertaController::class, 'listOfertas']);

//Esta ruta es para listar el ESTADO de las OFERTAS para EDITAR, por Jair.
Route::get('/ofertas/listarEstadoOfertas', [ApiOfertaController::class, 'listarEstadoOfertas'])->middleware('auth:api');

/*Ruta para registrar la postulación del PRACTICANTE, Jair.*/
Route::get('/ofertas/listarOfertaPracticante', [ApiOfertaController::class, 'listarOfertaPracticante'])->middleware('auth:api');

/*Ruta para registrar la postulación del PRACTICANTE, Jair.*/
Route::post('/ofertas/store', [ApiOfertaController::class, 'store'])->middleware('auth:api');

/*Ruta para registrar la postulación del PRACTICANTE, Jair.*/
Route::get('/carreras/listarCarrerasFormPracticante', [ApiCarreraController::class, 'listarCarrerasFormPracticante']);
//Esta ruta es para listar las Comunas del form de Registro de los PRACTICANTES desde la vista registro, por Jair.
Route::post('/comunas/listarComunas', [ApiComunaController::class, 'listarComunas']);

/*Ruta pata listar las OFERTAS con PRACTICANTES desde el dashboard EMPRESA, Jair.*/
Route::get('/empresas/listarPracticantes', [ApiEmpresaController::class, 'listarPracticantes'])->middleware('auth:api');
//Esta ruta es para listar todas las OFERTAS por EMPRESA desde el DASHBOARD, por Jair.
/**A esta ruta le falta el loguin por api. Realizado*/
Route::get('ofertas/listarOfertas', [ApiOfertaController::class, 'listarOfertas'])->middleware('auth:api');

/*************************** SOLO INSTITUCIONES ***********************************/
//Esta ruta es para listar las Comunas del form de Registro de los PRACTICANTES desde la vista registro, por Jair.
Route::get('/instituciones/insti', [ApiInstitucionController::class, 'insti']);

/**************************** SOLO REGIONES ******************************************************/
//Esta ruta es para listar las Regiones del form de Registro de los PRACTICANTES desde la vista registro, por Jair.
Route::get('/regiones/listarRegion', [ApiRegionController::class, 'listarRegion']);