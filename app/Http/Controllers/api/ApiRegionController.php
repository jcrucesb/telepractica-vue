<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class ApiRegionController extends Controller
{
    //
    /*Listar las REGIONES del formulario de registro de los practicantes, Jair*/
    public function listarRegion(){
        $region =  Region::all()->toArray();
        //echo $region;
        return  response()->json($region, 200);
    }
}
