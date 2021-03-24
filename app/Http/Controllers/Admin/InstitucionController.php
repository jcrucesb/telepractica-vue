<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Institucion;
use Illuminate\Http\Request;
use App\Models\EstadoUsuario;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class InstitucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('admin/institucion/index');
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
        $this->validate($request, [
            'run' => ['required', 'string', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'estado_usuario_id' => ['required'],
        ]);

        // Creación del usuario

        $user = new User();

        $user->run = $request['run'];
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->estado_usuario_id = $request['estado_usuario_id'];
        $user->rol_id = 3;

        $user->save();

        // Creación del perfil (institucion)

        $institucion = new Institucion();

        $institucion->id = $user->id;
        $institucion->run = $user->run;
        $institucion->nombre = $user->name;
        $institucion->email = $user->email;

        $institucion->user_id = $user->id;
        $institucion->save();

        return response()->json('Institucion creada', 200);
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
        $this->validate($request, [
            'run' => ['required', 'string', 'max:255', 'unique:users,run,' .$id],
            'name' => ['required', 'string', 'max:255', 'unique:users,name,' .$id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' .$id],
            'password' => ['string', 'min:8', 'confirmed'],
            'estado_usuario_id' => ['required'],
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        Institucion::where('id', $user->id)->update(['run' => $request->run]);
        Institucion::where('id', $user->id)->update(['nombre' => $request->name]);
        Institucion::where('id', $user->id)->update(['email' => $request->email]);

        return response()->json('Institucion actualizada', 200);
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
        $institucions = Institucion::orderBy('id', 'desc')->orderBy('nombre', 'asc')->get();

        $institucions->transform(function($institucion) {
            $user = User::findOrFail($institucion->id);
            $estado_usuario = EstadoUsuario::findOrFail($user->estado_usuario_id);
            $rol = Rol::findOrFail($user->rol_id);

            $institucion->user = $institucion->user;
            $institucion->estado_usuario_nombre = $estado_usuario->nombre;
            $institucion->rol_nombre = $rol->nombre;
            
            $institucion->estado_usuario_id = $estado_usuario->id;
            $institucion->rol_id = $rol->id;

            return $institucion;
        });

        return response()->json([
            'institucions' => $institucions
        ], 200);
    }

    public function get_institucion($id)
    {
        $institucion = Institucion::where('id', $id)->get();

        $institucion->transform(function($institucion_) {
            $user = User::findOrFail($institucion_->id);
            $estado_usuario = EstadoUsuario::findOrFail($user->estado_usuario_id);
            $rol = Rol::findOrFail($user->rol_id);

            $institucion_->user = $institucion_->user;
            $institucion_->estado_usuario_nombre = $estado_usuario->nombre;
            $institucion_->rol_nombre = $rol->nombre;
            
            $institucion_->estado_usuario_id = $estado_usuario->id;
            $institucion_->rol_id = $rol->id;

            return $institucion_;
        });

        return response()->json([
            'institucion' => $institucion
        ], 200);
    }
    /*Listar las comunas del formulario de registro de los practicantes, Jair*/
    public function insti(){
        $inst = DB::table('institucions')
                  ->select('id', 'nombre')
                  ->get();
        return  $inst;
    }
}
