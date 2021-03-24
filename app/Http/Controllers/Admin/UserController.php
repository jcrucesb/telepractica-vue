<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Practicante;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Institucion;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Usuarios registrados total
        $users = User::orderBy('id', 'desc')->orderBy('name', 'asc')->get();
        $total_users = $users->count();

        // Usuarios registrados hoy
        $users_hoy = User::whereDate('created_at', Carbon::today())->get();
        $total_users_hoy = $users_hoy->count();

        // Usuarios validados
        $users_validados = User::where('estado_usuario_id', 2)->get();
        $total_users_validados = $users_validados->count();
        $porcentaje_validados = round((($total_users_validados / $total_users) * 100), 1);

        // Usuarios dados de baja
        $users_baja = User::where('estado_usuario_id', 3)->get();
        $total_users_baja = $users_baja->count();
        $porcentaje_bajas = round((($total_users_baja / $total_users) * 100), 1);
        
        return view('admin/user/index', ['users' => $users, 'total_users' => $total_users, 'total_users_hoy' => $total_users_hoy, 'porcentaje_validados' => $porcentaje_validados, 'porcentaje_bajas' => $porcentaje_bajas]);
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
            'rol_id' => ['required']
        ]);

        // Creación del usuario

        $user = new User();
        
        $user->run = $request['run'];
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->estado_usuario_id = $request['estado_usuario_id'];
        $user->rol_id = $request['rol_id'];

        $user->save();

        // Creación del perfil

        if($user->rol_id == 1){
            $perfil = new Practicante();
    
            $perfil->id = $user->id;
            $perfil->run = $user->run;
            $perfil->nombre_completo = $user->name;
            $perfil->email = $user->email;

            $perfil->user_id = $user->id;    
            $perfil->save();
        }
        elseif($user->rol_id == 2 or $user->rol_id == 4){
            $perfil = new Empresa();
    
            $perfil->id = $user->id;
            $perfil->run = $user->run;
            $perfil->nombre_ficticio = $user->name;
            $perfil->email = $user->email;

            $perfil->user_id = $user->id; 
            $perfil->save();
        }
        elseif($user->rol_id == 3){
            $perfil = new Institucion();
    
            $perfil->id = $user->id;
            $perfil->run = $user->run;
            $perfil->nombre = $user->name;
            $perfil->email = $user->email;

            $perfil->user_id = $user->id; 
            $perfil->save();
        }

        return response()->json('Usuario creado', 200);
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
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'estado_usuario_id' => ['required'],
            'rol_id' => ['required']
        ]);

        $user = User::findOrFail($id);

        $user->update($request->all());

        return response()->json('Usuario actualizado', 200);
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
 
    public function get_profile()
    {
        return view('admin/profile/profile');
    }
 
    public function post_profile(Request $request)
    {
        //dd($request->all());

        $user = auth()->user();

        $this -> validate($request, [
            'run' => 'required|string|max:255|unique:users,run,'.$user->id,            
            'name' => 'required|string|max:255|unique:users,name,'.$user->id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        ]);

        $user->update($request->all());

        return redirect()->back()->with('success', 'Perfil actualizado');
    }
    
    public function get_all()
    {
        $users = User::orderBy('id', 'desc')->orderBy('name', 'asc')->get();

        $users->transform(function($user) {
            $user->rol = $user->rol->nombre;
            $user->estado_usuario = $user->estado_usuario->nombre;

            return $user;
        });

        return response()->json([
            'users' => $users
        ], 200);
    }
    
    public function get_stats()
    {
        // Usuarios registrados total
        $users = User::orderBy('id', 'desc')->orderBy('name', 'asc')->get();
        $total_users = $users->count();

        // Usuarios registrados hoy
        $users_hoy = User::whereDate('created_at', Carbon::today())->get();
        $total_users_hoy = $users_hoy->count();

        // Usuarios validados
        $users_validados = User::where('estado_usuario_id', 2)->get();
        $total_users_validados = $users_validados->count();
        if($total_users < 1){
            $porcentaje_validados = 0;
        }
        else{
            $porcentaje_validados = round((($total_users_validados / $total_users) * 100), 1);
        }

        // Usuarios dados de baja
        $users_baja = User::where('estado_usuario_id', 3)->get();
        $total_users_baja = $users_baja->count();
        if($total_users < 1){
            $porcentaje_bajas = 0;
        }
        else{
            $porcentaje_bajas = round((($total_users_baja / $total_users) * 100), 1);
        }

        return response()->json([
            'total_users' => $total_users,
            'total_users_hoy' => $total_users_hoy,
            'porcentaje_validados' => $porcentaje_validados,
            'porcentaje_bajas' => $porcentaje_bajas
        ], 200);
    }

    public function down($id)
    {
        $user = User::findOrFail($id);

        $user->estado_usuario_id = 3;

        $user->save();

        return response()->json('Usuario dado de baja', 200);
    }

    public function to_premium($id)
    {
        $user = User::findOrFail($id);

        if($user->rol_id == 2){
            $user->rol_id = 4;
    
            $user->save();
    
            return response()->json('Convertido a premium', 200);
        }
    }

    ///////////////////////
    // USER: PRACTICANTE //
    ///////////////////////   
    public function get_all_practicante()
    {
        $users = User::where('rol_id', 1)->orderBy('id', 'desc')->orderBy('name', 'asc')->get();

        $users->transform(function($user) {
            $user->estado_usuario = $user->estado_usuario->nombre;
            $user->rol = $user->rol->nombre;

            return $user;
        });

        return response()->json([
            'users' => $users
        ], 200);
    }
    
    public function get_stats_practicante()
    {
        // Usuarios registrados total
        $users = User::where('rol_id', 1)->orderBy('id', 'desc')->orderBy('name', 'asc')->get();
        $total_users = $users->count();

        // Usuarios registrados hoy
        $users_hoy = User::where('rol_id', 1)->whereDate('created_at', Carbon::today())->get();
        $total_users_hoy = $users_hoy->count();

        // Usuarios validados
        $users_validados = User::where('rol_id', 1)->where('estado_usuario_id', 2)->get();
        $total_users_validados = $users_validados->count();
        if($total_users < 1){
            $porcentaje_validados = 0;
        }
        else{
            $porcentaje_validados = round((($total_users_validados / $total_users) * 100), 1);
        }

        // Usuarios dados de baja
        $users_baja = User::where('rol_id', 1)->where('estado_usuario_id', 3)->get();
        $total_users_baja = $users_baja->count();
        if($total_users < 1){
            $porcentaje_bajas = 0;
        }
        else{
            $porcentaje_bajas = round((($total_users_baja / $total_users) * 100), 1);
        }

        return response()->json([
            'total_users' => $total_users,
            'total_users_hoy' => $total_users_hoy,
            'porcentaje_validados' => $porcentaje_validados,
            'porcentaje_bajas' => $porcentaje_bajas
        ], 200);
    }

    ///////////////////
    // USER: EMPRESA //
    ///////////////////   
    public function get_all_empresa()
    {
        $users = User::whereIn('rol_id', [2, 4])->orderBy('id', 'desc')->orderBy('name', 'asc')->get();

        $users->transform(function($user) {
            $user->rol = $user->rol->nombre;
            $user->estado_usuario = $user->estado_usuario->nombre;

            return $user;
        });

        return response()->json([
            'users' => $users
        ], 200);
    }
    
    public function get_stats_empresa()
    {
        // Usuarios registrados total
        $users = User::whereIn('rol_id', [2, 4])->orderBy('id', 'desc')->orderBy('name', 'asc')->get();
        $total_users = $users->count();

        // Usuarios registrados hoy
        $users_hoy = User::whereIn('rol_id', [2, 4])->whereDate('created_at', Carbon::today())->get();
        $total_users_hoy = $users_hoy->count();

        // Usuarios validados
        $users_validados = User::whereIn('rol_id', [2, 4])->where('estado_usuario_id', 2)->get();
        $total_users_validados = $users_validados->count();
        if($total_users < 1){
            $porcentaje_validados = 0;
        }
        else{
            $porcentaje_validados = round((($total_users_validados / $total_users) * 100), 1);
        }

        // Usuarios dados de baja
        $users_baja = User::whereIn('rol_id', [2, 4])->where('estado_usuario_id', 3)->get();
        $total_users_baja = $users_baja->count();
        if($total_users < 1){
            $porcentaje_bajas = 0;
        }
        else{
            $porcentaje_bajas = round((($total_users_baja / $total_users) * 100), 1);
        }

        return response()->json([
            'total_users' => $total_users,
            'total_users_hoy' => $total_users_hoy,
            'porcentaje_validados' => $porcentaje_validados,
            'porcentaje_bajas' => $porcentaje_bajas
        ], 200);
    }

    ///////////////////////
    // USER: INSTITUCION //
    ///////////////////////
    public function get_all_institucion()
    {
        $users = User::where('rol_id', 3)->orderBy('id', 'desc')->orderBy('name', 'asc')->get();

        $users->transform(function($user) {
            $user->rol = $user->rol->nombre;
            $user->estado_usuario = $user->estado_usuario->nombre;

            return $user;
        });

        return response()->json([
            'users' => $users
        ], 200);
    }
    
    public function get_stats_institucion()
    {
        // Usuarios registrados total
        $users = User::where('rol_id', 3)->orderBy('id', 'desc')->orderBy('name', 'asc')->get();
        $total_users = $users->count();

        // Usuarios registrados hoy
        $users_hoy = User::where('rol_id', 3)->whereDate('created_at', Carbon::today())->get();
        $total_users_hoy = $users_hoy->count();

        // Usuarios validados
        $users_validados = User::where('rol_id', 3)->where('estado_usuario_id', 2)->get();
        $total_users_validados = $users_validados->count();
        if($total_users < 1){
            $porcentaje_validados = 0;
        }
        else{
            $porcentaje_validados = round((($total_users_validados / $total_users) * 100), 1);
        }

        // Usuarios dados de baja
        $users_baja = User::where('rol_id', 3)->where('estado_usuario_id', 3)->get();
        $total_users_baja = $users_baja->count();
        if($total_users < 1){
            $porcentaje_bajas = 0;
        }
        else{
            $porcentaje_bajas = round((($total_users_baja / $total_users) * 100), 1);
        }

        return response()->json([
            'total_users' => $total_users,
            'total_users_hoy' => $total_users_hoy,
            'porcentaje_validados' => $porcentaje_validados,
            'porcentaje_bajas' => $porcentaje_bajas
        ], 200);
    }
}
