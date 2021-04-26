<?php

namespace App\Http\Controllers\api;

use App\Models\Carrera;
use App\Models\Escuela;
use App\Models\Institucion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiCarreraController extends Controller
{
    
    public function listarCarreras(Request $request){
        $id_carrera = DB::table('carreras')
        ->select('id','nombre')
        ->get();
        return response()->json($id_carrera, 200);
    }
    /**Este método es para listar las carreras pero para insertar OFERTA desde
    el DASHBOARD EMPRESAS, y también lista ls carreras desde el archivo welcome para insertar 
    a un PRACTICANTE.*/
    public function listCarreras(){
        $id_carrera = DB::table('carreras')
        ->select('id','nombre')
        ->get();
        return response()->json($id_carrera, 200);
    }
    public function listarCarrerasFormPracticante(){
        $id_carrera = DB::table('carreras')
        ->select('id','nombre')
        ->get();
        return response()->json($id_carrera, 200);
    }
}
