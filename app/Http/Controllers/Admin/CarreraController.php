<?php

namespace App\Http\Controllers\Admin;

use App\Models\Carrera;
use App\Models\Escuela;
use App\Models\Institucion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('admin/carrera/index');
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
        $carreras = Carrera::orderBy('escuela_id', 'asc')->orderBy('nombre', 'asc')->get();

        $carreras->transform(function($carrera) {
            $escuela = Escuela::findOrFail($carrera->escuela_id);

            $carrera->escuela_nombre = $escuela->nombre;

            return $carrera;
        });

        return response()->json([
            'carreras' => $carreras
        ], 200);
    }

    public function get_all_by_institucion($id)
    {
        $institucion = Institucion::findOrFail($id);
        $carreras = $institucion->carreras;

        return response()->json([
            'carreras' => $carreras
        ], 200);
    }
    /*public function listCarreras(){
        $id_carrera = DB::table('carreras')
        ->select('id','nombre')
        ->get();
        return $id_carrera;
    }*/
}