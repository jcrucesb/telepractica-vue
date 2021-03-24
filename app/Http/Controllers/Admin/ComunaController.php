<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comuna;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ComunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('admin/comuna/index');
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
        $comunas = Comuna::orderBy('region_id', 'asc')->orderBy('nombre', 'asc')->get();

        $comunas->transform(function($comuna) {
            $region = Region::findOrFail($comuna->region_id);

            $comuna->region_nombre = $region->nombre;

            return $comuna;
        });

        return response()->json([
            'comunas' => $comunas
        ], 200);
    }

    public function get_all_by_region($id)
    {
        $comunas = Comuna::where('region_id', $id)->get();

        return response()->json([
            'comunas' => $comunas
        ], 200);
    }
    /*Listar las comunas del formulario de registro de los practicantes, Jair*/
    public function listarComunas(){
        $comunas = DB::table('comunas')
                  ->select('id', 'nombre')
                  ->get();
        return  $comunas;
    }
}
