<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiInstitucionController extends Controller
{
    /*Listar las comunas del formulario de registro de los practicantes, Jair*/
    public function insti(){
        $inst = DB::table('institucions')
                  ->select('id', 'nombre')
                  ->get();
        //echo $inst;
        return  response()->json($inst, 200);
    }
}
