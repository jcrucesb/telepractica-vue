<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiComunaController extends Controller
{
    /*Listar las comunas del formulario de registro de los practicantes, Jair*/
    /*Funcionando perfectamente el select dinámico.*/
    public function listarComunas(Request $request){
        //dd($request);
        $comunas = DB::table('comunas')
                  ->select('id', 'region_id','nombre')
                  ->where('region_id', '=', $request->id_region)
                  ->get();
        return  response()->json($comunas, 200);
    }
}
