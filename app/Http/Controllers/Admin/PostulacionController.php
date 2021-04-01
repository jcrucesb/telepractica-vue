<?php

namespace App\Http\Controllers\Admin;

use App\Models\Oferta;
use App\Models\EstadoPost;
use App\Models\Postulacion;
use App\Models\Practicante;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostulacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/postulacion/index');
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
    public function store(Request $request)
    {
        //
    }

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
        $postulacions = Postulacion::orderBy('id', 'desc')->orderBy('nombre', 'asc')->get();

        $postulacions->transform(function ($postulacion) {
            $estado_post = EstadoPost::findOrFail($postulacion->estado_post_id);
            $oferta = Oferta::findOrFail($postulacion->oferta_id);
            $practicante = Practicante::findOrFail($postulacion->practicante_id);

            $postulacion->estado_post_nombre = $estado_post->nombre;
            $postulacion->oferta_nombre = $oferta->nombre_oferta;
            $postulacion->practicante_nombre = $practicante->nombre_completo;

            // Borrar            
            /* $carreras = array();
            foreach ($oferta->carreras as $carrera) {
                array_push($carreras, $carrera["id"]);
            }
            $postulacion->cantidad_carreras = count($carreras);
            $posicion_random = random_int(0, count($carreras)-1);
            
            $carrera_id_random = $carreras[$posicion_random];
            $postulacion->carrera_id_random = $carrera_id_random;
            $practicante_ids = Practicante::inRandomOrder()->where('carrera_id', $carrera_id_random)->value('id');
            $postulacion->practicante_id_random = $practicante_ids;

            $postulacion->carreras = $carreras; */

            return $postulacion;
        });

        return response()->json([
            'postulacions' => $postulacions
        ], 200);
    }

    public function get_all_by_practicante($id)
    {
        $postulacions = Postulacion::where('practicante_id', $id)->orderBy('id', 'desc')->orderBy('nombre', 'asc')->get();

        $postulacions->transform(function ($postulacion) {
            $estado_post = EstadoPost::findOrFail($postulacion->estado_post_id);
            $oferta = Oferta::findOrFail($postulacion->oferta_id);
            $practicante = Practicante::findOrFail($postulacion->practicante_id);

            $postulacion->estado_post_nombre = $estado_post->nombre;
            $postulacion->oferta_nombre = $oferta->nombre_oferta;
            $postulacion->practicante_nombre = $practicante->nombre_completo;

            return $postulacion;
        });

        return response()->json([
            'postulacions' => $postulacions
        ], 200);
    }
    /*Datos de la postulacion del PRACTICANTE desde su DASHBOARD, Jair
    public function postulacionPracticante(Request $request){
        dd($request);
    }*/
}
