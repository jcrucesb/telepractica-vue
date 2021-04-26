<?php

namespace App\Http\Controllers\Admin;

use App\Models\Oferta;
use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Models\Postulacion;
/**Esto es para utilizar las consultas cn join, Jair*/
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\EstadoOferta;
use App\Models\Supervisor;

class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('admin/oferta/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(Request $request)
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
                        /*Funcionando correctamente.
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
    }*/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function get_all()
    {
        $ofertas = Oferta::orderBy('id', 'desc')->orderBy('nombre_oferta', 'asc')->get();

        $ofertas->transform(function($oferta) {
            $empresa = Empresa::findOrFail($oferta->empresa_id);
            $estado_oferta = EstadoOferta::findOrFail($oferta->estado_oferta_id);
            $supervisor = Supervisor::findOrFail($oferta->supervisor_id);

            $oferta->empresa_nombre = $empresa->nombre_ficticio;
            $oferta->estado_oferta_nombre = $estado_oferta->nombre;
            $oferta->supervisor_nombre = $supervisor->nombre_completo;

            $oferta->carreras = $oferta->carreras;

            return $oferta;
        });

        return response()->json([
            'ofertas' => $ofertas
        ], 200);
    }
    /*Obtener todas las OFERTAS para listarlas desde la vista welcome.
    public function listOfertas(){
        $empresas = DB::table('empresas')
        ->join('ofertas','ofertas.empresa_id','=','empresas.id')
        ->select('ofertas.id as id_oferta','empresas.id','empresas.razon_social','empresas.web','ofertas.nombre_oferta', 'ofertas.descripcion',
                 'ofertas.remunerada', 'ofertas.fecha_inicio','ofertas.cupos_totales',
                 'ofertas.fecha_termino', 'ofertas.valor_remuneracion', 'ofertas.requisitos_min')
        ->get();
        return response()->json($empresas, 200);
    }*/


    /*Obtener todas las OFERTAS para listarlas desde el DATATABLE del
    DASHBOARD, de empresa cuando se crea una oferta.*/
    /*public function listarOfertas(){
        $emp = auth()->id();
        //echo $emp;
        /**Obtener la empresa que hizo la oferta.
        $oferta =  DB::table('empresas')
            ->select('user_id', 'id')
            ->where('user_id', '=', $emp)
            ->get();

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
        
    }*/
    /**Método paRA ELIMINAR una OFERTA.*/
    /*public function eliminar_oferta(Oferta $idOferta){
        $idOferta->delete();
    }*/
    /*Listar el estado de las ofertas para EDITAR desde el DASHBOARD DE LAS empresas, Jair.*/
    /*public function listarEstadoOfertas(){
        $li = DB::table('estado_ofertas')
                ->select('id', 'nombre')
                ->get();
        return $li;

    }*/
    /*Listar Ofertas para el DASHBOARD de los practicantes por carrera.*/
    /*public function listarOfertaPracticante(){
        $id_prac = auth()->user()->email;
        
        $li = DB::table('practicantes')
                ->select('id', 'carrera_id')
                ->where('email', '=', $id_prac)
                ->get();
        //echo $li;
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
    }*/
}
