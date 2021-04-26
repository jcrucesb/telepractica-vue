<?php

namespace App\Http\Controllers\api;

use App\Models\Oferta;
use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Models\Postulacion;
use Illuminate\Support\Facades\Auth;
/**Esto es para utilizar las consultas cn join, Jair*/
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use App\Models\EstadoOferta;
use App\Models\Supervisor;

class ApiOfertaController extends Controller
{
    //Obtener todas las OFERTAS para listarlas desde la vista welcome.
    public function listOfertas(){
        $empresas = DB::table('empresas')
        ->join('ofertas','ofertas.empresa_id','=','empresas.id')
        ->select('ofertas.id as id_oferta','empresas.id','empresas.razon_social','empresas.web','ofertas.nombre_oferta', 'ofertas.descripcion',
                 'ofertas.remunerada', 'ofertas.fecha_inicio','ofertas.cupos_totales',
                 'ofertas.fecha_termino', 'ofertas.valor_remuneracion', 'ofertas.requisitos_min')
        ->get();
        return response()->json($empresas, 200);
    }
    /*Obtener todas las OFERTAS para listarlas desde el DATATABLE del
    DASHBOARD, de empresa cuando se crea una oferta.*/
    public function listarOfertas(){
        $emp = Auth::user()->id;
        //echo $emp;
        /**Obtener la empresa que hizo la oferta.*/
        $oferta =  DB::table('empresas')
            ->select('user_id', 'id')
            ->where('user_id', '=', $emp)
            ->get();
            //echo $oferta;
        foreach ($oferta as $key) {
            $empresas = DB::table('ofertas')
            ->join('estado_ofertas', 'ofertas.estado_oferta_id', '=', 'estado_ofertas.id')
                ->select('estado_ofertas.nombre','ofertas.id', 'ofertas.nombre_oferta', 'ofertas.descripcion', 'ofertas.remunerada',
                            'ofertas.valor_remuneracion', 'ofertas.cupos_totales', 'ofertas.fecha_inicio', 'ofertas.fecha_termino',
                            'ofertas.requisitos_min','ofertas.created_at')
                ->where('empresa_id', '=' , $key->id)
                ->get();
            return response()->json($empresas, 200);
        }
    }
    /*Listar el estado de las ofertas para EDITAR desde el DASHBOARD DE LAS empresas, Jair.*/
    public function listarEstadoOfertas(){
        $li = DB::table('estado_ofertas')
                ->select('id', 'nombre')
                ->get();
        return response()->json($li, 200);
    }
    public function eliminar_oferta(Request $request, Oferta $idOferta){
        $idOferta->delete();
    }
    /*Listar Ofertas para el DASHBOARD de los practicantes por carrera.*/
    public function listarOfertaPracticante(){
        $id_prac = auth()->user()->email;
        //echo $id_prac;
        $li = DB::table('practicantes')
                ->select('id', 'carrera_id')
                ->where('email', '=', $id_prac)
                ->get();
        
        foreach ($li as $key){
            $list = DB::table('ofertas')
                ->join('oferta_carreras','ofertas.id','=','oferta_carreras.oferta_id')
                ->join('empresas','ofertas.empresa_id','=','empresas.id')
                ->select('ofertas.id','empresas.razon_social','ofertas.nombre_oferta', 'ofertas.descripcion',
                        'ofertas.remunerada', 'ofertas.cupos_totales', 'ofertas.requisitos_min', 
                        'empresas.web')
                ->where('oferta_carreras.carrera_id', '=', $key->carrera_id)
                ->get();
            return $list;
        }
    }
    public function store(Request $request)
    {
        //dd($request);
        $id_session = auth()->id();
        $practicante = DB::table('practicantes')
                       ->select('id')
                       ->where('user_id', '=', $id_session)
                       ->get();

        foreach ($practicante as $key) {
            
            $_dat = DB::table('postulacions')
            ->select('oferta_id','practicante_id')
            ->where('oferta_id', '=', $request->id_oferta)
            ->where('practicante_id', '=', $key->id)
            ->get();
            //echo count($_dat);

            if (count($_dat) > 0) {
                return response()->json([
                    'msg' => '1'
                ]);
            }else{
                $_datos = DB::table('ofertas')
                 ->select('id','nombre_oferta', 'estado_oferta_id')
                 ->where('id', '=', $request->id_oferta)
                 ->get();
                //echo $_datos;
                foreach ($_datos as $ke) {
                    Postulacion::create([
                        /*Acá insertamos correctamente el id de la empresa en la tabla Oferta.*/
                        /*Funcionando correctamente.*/
                        'oferta_id' => $request->id_oferta,
                        'practicante_id' => $key->id,
                        'estado_post_id' => $ke->estado_oferta_id,
                        'nombre' => $ke->nombre_oferta
                    ]);
                    return response()->json([
                        'msg' => '0'
                    ]);
                }
            }
        }
    }
}