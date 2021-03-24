<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
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

        return view('admin-home', ['users' => $users, 'total_users' => $total_users, 'total_users_hoy' => $total_users_hoy, 'porcentaje_validados' => $porcentaje_validados, 'porcentaje_bajas' => $porcentaje_bajas]);
    }
}
