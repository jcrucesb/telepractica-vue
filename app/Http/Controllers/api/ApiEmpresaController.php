<?php

namespace App\Http\Controllers\api;

use App\Models\Rol;
use App\Models\User;
use App\Models\Oferta;
use App\Models\Empresa;
use App\Models\Entrevista;
/**Importamos el modelo de Laravel permission.*/
use App\Models\Supervisor;
use App\Models\Practicante;
use Illuminate\Http\Request;
use App\Models\EstadoUsuario;
use App\Models\OfertaCarrera;
use App\Mail\CorreoEntrevista;
use App\Models\EstadoEntrevista;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Mail\PracticanteSeleccionado;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\CorreoBienvenidaEmpresa;
use Illuminate\Support\Str;
use client_credentials;

class ApiEmpresaController extends Controller
{
    /*Registrar las EMPRESAS desde la vista WELCOME por Jair.*/
    public function regitEmpresa(Request $request){
        //dd($request);
        if (empty($request->run || $request->email || $request->razon_social || $request->nombre_ficticio
            || $request->giro || $request->descripcion || $request->usuario || $request->web || $request->telefono
            || $request->direccion || $request->password)) 
            {
                return response()->json([
                    'status' => '3'
                ]);
        }else{
            $emailEmp = DB::table('users')
                        ->select('email', 'run')
                        ->where('email', '=', $request->email)
                        ->orWhere('run', '=', $request->run)
                        ->get();
        if(count($emailEmp) > 0){
            return response()->json([
                'status' => '1',
                'error' => 'ya existe'
            ]);
        }else{
            $this->validate($request, [
                /**Están funcionando los required.*/
                'run' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'razon_social' => ['required', 'string', 'max:255'],
                'nombre_ficticio' => ['required', 'string', 'max:255'],
                'giro' => ['required'],
                'descripcion' => ['required', 'string', 'max:255'],
                'web' => ['required', 'string', 'max:255'],
                'telefono' => ['required', 'int'],
                'usuario' => ['required', 'max:255'],
                'direccion' => ['required', 'string', 'max:255'],
                'password' => ['required','max:255'],
            ]);
            $user = User::create([
                /*Funcionando correctamente.*/
                'name' => $request->usuario,
                'run' => $request->run,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'api_token' => Str::random(10),
                'rol_id' => $request->rol_id,
            ])->assignRole(['Empresa']);
                
            $emp = Empresa::create([
                /*Funcionando correctamente.*/
                'user_id' => $user->id,
                'run' => $request->run,
                'email' => $request->email,
                'razon_social' => $request->razon_social,
                'nombre_ficticio' => $request->nombre_ficticio,
                'giro' => $request->giro,
                'descripcion' => $request->descripcion,
                'web' => $request->web,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
            ]);
            /*Enviar correo de Bienvenida a las Empresas.*/
            $details = [
                //Titulo del Email
                'email' => $request->email,
                'razon_social' => $request->razon_social,
                'verificacion' => 'Bienvenida Empresa'
            ];
            //Email a enviar.
            Mail::to($request->email)->send(new CorreoBienvenidaEmpresa($details));
                return response()->json([
                    'status' => '2'
                ]);
            }
        }

    }
    /*Método para listar los PRACTICANTES que postularon a la OFERTA  de alguna EMPRESA, 
    la lista es por EMPRESA y su OFERTA.*/
    public function listarPracticantes(){  
        //dd($request);
        $id = Auth::user()->id;
        //echo $id;
        $id_empresa = DB::table('empresas')
                    ->select('id', 'razon_social')
                    ->where('id', '=', $id)
                    ->get();
        //echo $id_empresa;
        foreach ($id_empresa as $key) {
            $prac = DB::table('postulacions')
                ->join('practicantes', 'postulacions.practicante_id','=', 'practicantes.id')
                ->join('ofertas', 'postulacions.oferta_id','=', 'ofertas.id')
                ->select('practicantes.id','practicantes.run', 'practicantes.nombre_completo', 'practicantes.email',
                        'practicantes.cantidad_horas', 'practicantes.cantidad_meses', 'practicantes.equipo_computacional',
                        'practicantes.internet_fijo', 'ofertas.nombre_oferta')
                ->where('ofertas.empresa_id', '=', $key->id)
                //->where('ofertas.id', '=', 'postulacions.oferta_id')
                ->get();
            return response()->json($prac, 200);
        }
    }
    public function registrarOfer(Request $request){
        //dd($request);
        /*Validaciones de los campos.*/
        $vali = $this->validate($request, [
            'nombre_oferta' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string','max:255'],
            'remunerada' => ['required', 'string', 'max:255'],
            'valor_remuneracion' => ['required', 'integer'],
            'fecha_inicio' => ['required'],
            'fecha_termino' => ['required'],
            'requisitos' => ['required', 'string', 'max:255'],
            'cupos_totales' => ['required', 'integer'],
        ]);
        if ($request->carrera == null) {
            return response()->json([
                'status' => '3']);
        }else{
            date_default_timezone_set('America/Santiago');
            $date = date('Y-m-d');
            //print_r($date);
            if ($request->fecha_inicio >= $date) {
                $emp = DB::table('ofertas')
                ->select('nombre_oferta')
                ->where('nombre_oferta', '=', $request->nombre_oferta)
                ->get();
                //Con esto obtenemos el resultado del id de la session que viene siendo la EMPRESA.
                $empresa_email = Auth::user()->email; 
                //echo $id_empresa;
                $id_empresa = DB::table('empresas')
                ->select('id')
                ->where('email', '=', $empresa_email)
                ->get();
                //echo $id_empresa;
                foreach($id_empresa as $ingreso)
                {
                    $ingreso->id;
                    //Este está funcionando.
                    if(count($emp) < 1 && count($id_empresa) > 0){
                        //Este está funcionando.
                        $id_oferta = Oferta::create([
                            'empresa_id' => $ingreso->id,
                            'estado_oferta_id' => 1,
                            'nombre_oferta' => $request->nombre_oferta,
                            'descripcion' => $request->descripcion,
                            'remunerada' => $request->remunerada,
                            'valor_remuneracion' => $request->valor_remuneracion,
                            'cupos_totales' => $request->cupos_totales,
                            'carrera' => $request->carrera,
                            'fecha_inicio' => $request->fecha_inicio,
                            'fecha_termino' => $request->fecha_termino,
                            'requisitos_min' => $request->requisitos,
                        ]);
                        $id_carrera = DB::table('carreras')
                                    ->select('id', 'nombre')
                                    ->where('nombre', '=', $request->carrera)
                                    ->get();
                        //echo $id_carrera;
                        foreach ($id_carrera as $key) {
                            OfertaCarrera::create([
                                'carrera_id' => $key->id,
                                'oferta_id' => $id_oferta->id,    
                            ]);
                        }
                        /**Con esto, obtenemos el id de la oferta insertada correctamente.*/
                        //dd($id_oferta->id);
                        return response()->json([
                            'status' => 'Muy bien!',
                            'msg' => 'Datos actualizados correctamente.',
                        ],201);
                    }else{
                        return response()->json([
                            'status' => '1']);
                    }
                }
            }else{
                /**Con esto, obtenemos el id de la oferta insertada correctamente.*/
                //dd($id_oferta->id);
                return response()->json([
                    'status' => '2']);
            }
        }
    }

    //Método para EDITAR una OFERTA.
    public function editar_oferta(Request $request, Oferta $idOferta){
        //dd($request);
        $data = request()->validate([
            'nombre_oferta' => 'required',
            'descripcion' => ['required','string'],             
            'remunerada' => 'nullable',
            'valor_remuneracion' => 'nullable',
            'fecha_inicio' =>  'required',
            'fecha_termino' => 'required',
            'cupos_totales' => 'required',
            'estado_oferta_id' => 'required',
        ]);
        //
        $idOferta->update($data);
        return response()->json($data, 200); 
    }
    /*Obtener los datos de la EMPRESA para listarlos desde su DASHBOARD, Jair.*/
    public function datEmp(Request $request){
        //dd($request->user());
        $empresa = Auth::user()->id;
        //echo $empresa;
        $dat = DB::table('empresas')
                ->select('id','user_id','run','email','razon_social','nombre_ficticio', 'giro','descripcion',
                        'web', 'telefono', 'direccion')
                ->where('user_id', '=', $empresa)
                ->get();
        return response()->json($dat, 200);
    }

    /*Método para actualizar los datos personales del PRACTICAnte, Jair */
    public function editarDatosEmp(Request $request, Empresa $id){
        //dd($request->id);
        $data = request()->validate([
            'run' => ['required', 'string'],
            'email' => ['required', 'string'],
            'razon_social' => ['required', 'string'],
            'nombre_ficticio' => ['required', 'string'],
            'giro' => ['required', 'string'],
            'descripcion' => ['required', 'string'],
            'web' => ['required', 'string'],
            'telefono' => ['required', 'string'],
            'direccion' => ['required', 'string'],
        ]);
        if ($id->update($data)) {
            $id_user = DB::table('empresas')
                       ->select('id','user_id','run','email','razon_social','nombre_ficticio', 'giro','descripcion',
                                'web', 'telefono', 'direccion')
                       ->where('id', '=', $request->id)
                       ->get();
            //echo $id_user;
            foreach ($id_user as $key) {
                $prac = DB::table('users')
                ->where('id','=', $key->user_id)
                ->update(array(
                    'email' => $request->email,
                    'run' => $request->run,
                ));
                return response()->json([
                    'msg' => '1'
                ]);
            }
        }else{
            return response()->json([
                'msg' => '0'
            ]);
        }
    }
    /*Método para enviar por correo la fecha de postulación al practicante por parte de la
    EMPRESA*/
    public function enviarPostulacionPracticante(Request $request){
        //dd($request->nombreOferta);
        $id_post = DB::table('postulacions')
                   ->select('id', 'oferta_id', 'practicante_id','nombre')
                   ->where('practicante_id', '=', $request->id_practicante)
                   ->where('nombre', '=', $request->nombreOferta)
                   ->get();
        
        //$id_post = json_encode($id_post);
        //dd($id_post);
        if(count($id_post)){
            foreach ($id_post as $key) {
                $id_entrevista = Entrevista::create([
                    'postulacion_id' => $key->id,
                    'fecha_citacion' => $request->fechaCitacion,
                    'hora_citacion' => $request->horaCitacion,
                ]);
                /**Enviar EMAIL con fecha y Hora de citación.*/
                    $dat = DB::table('ofertas')
                    ->join('empresas', 'ofertas.empresa_id', '=', 'empresas.id')
                    ->select('empresas.nombre_ficticio')
                    ->get();
                    foreach ($dat as $key) {
                        $nombreFicticio = $key->nombre_ficticio;
                    }
                    $details = [
                        //Titulo del Email
                        'email' => $request->email_practicante,
                        'fecha_citacion' => $request->fechaCitacion,
                        'hora_citacion' => $request->horaCitacion,
                        'nombrePracticante' => $request->nombrePracticante,
                        'nombreOferta' => $request->nombreOferta,
                        'nombreEmpresa' => $nombreFicticio,
                    ];
                    Mail::to($request->email_practicante)->send(new CorreoEntrevista($details));
                    //Veamos si funciona.
                    $id_entrevista = EstadoEntrevista::create([
                        'entrevista_id' => $id_entrevista->id,
                    ]);
                    return response()->json([
                        'status' => '1',
                        'message' => 'Correo enviado Correctamente'
                    ]);
            }
        }else{
            return response()->json([
                'status' => '0',
                'message' => 'Error, no se pudo enviar el correo'
            ]);
        }

    }
    /*Método para obtener a los PRACTICANTES que confirmaron la fecha de entrevista.*/
    public function practicantesConfirmaron(Request $request){
        $id = Auth::user()->id;
        $run_prac = DB::table('estado_entrevistas')
                    ->select('rut_confirmacion')
                    ->get();
        //echo $run_prac;
        foreach ($run_prac as $key) {
            $prac = DB::table('estado_entrevistas')
                ->join('entrevistas','estado_entrevistas.entrevista_id', '=', 'entrevistas.id')
                ->join('postulacions','entrevistas.postulacion_id', '=', 'postulacions.id')
                ->join('ofertas','postulacions.oferta_id', '=', 'ofertas.id')
                ->join('practicantes','postulacions.practicante_id', '=', 'practicantes.id')
                ->select('entrevistas.hora_citacion','entrevistas.fecha_citacion','practicantes.id','practicantes.run', 'entrevistas.correo_enviado','practicantes.nombre_completo', 
                         'postulacions.nombre','practicantes.email')
                ->where('ofertas.empresa_id', '=', $id)
                ->get();
            return response()->json($prac, 200);
        }
    }
    /*Método para actualizar los datos personales del PRACTICAnte, Jair */
    public function editarDatosPrac(Request $request, Practicante $id){
        //dd($request->id);

        $data = request()->validate([
            'run' => ['required', 'string'],
            'nombre_completo' => ['required', 'string'],
            'email' => ['required', 'string'],
            'telefono' => ['required', 'string'],
            'cantidad_horas' => ['required', 'integer'],
            'cantidad_meses' => ['required', 'integer'],
        ]);
        if ($id->update($data)) {
            $id_user = DB::table('practicantes')
            ->select('user_id', 'email', 'run')
            ->where('id', '=', $request->id)
            ->get();
            //echo $id_user;
            foreach ($id_user as $key) {
                $prac = DB::table('users')
                ->where('id','=', $key->user_id)
                ->update(array(
                    'email' => $request->email,
                    'run' => $request->run,
                ));
                return response()->json([
                    'msg' => '1'
                ]);
            }
        }else{
            return response()->json([
                'msg' => '0'
            ]);
        }
    }
    /* Método para enviar correo al PRACTICANTE por la EMPRESA, que ha sido seleccionado
    para la oferta que ha postulado.*/
    public function practicanteSeleccionado(Request $request){
        //dd($request);
        $prac = DB::table('postulacions')
        ->select('id','practicante_id', 'nombre', 'oferta_id')
        ->where('practicante_id', '=', $request->id_prac)
        ->where('nombre', '=', $request->nombreOferta)
        ->get();
        //echo $prac;
        foreach ($prac as $key) {
            $prac = DB::table('entrevistas')
                    ->where('postulacion_id','=', $key->id)
                    ->update(array(
                        'seleccionado' => 'Si',
                        'correo_enviado' => 'Si',
                    ));       
            if ($prac > 0) {
                $prac = DB::table('empresas')
                        ->join('ofertas', 'empresas.id', '=','ofertas.empresa_id')
                        ->join('postulacions', 'ofertas.id', '=', 'postulacions.oferta_id')
                        ->join('practicantes', 'postulacions.practicante_id', '=', 'practicantes.id')
                        ->select('practicantes.email','ofertas.nombre_oferta', 'empresas.nombre_ficticio')
                        ->where('ofertas.nombre_oferta', '=', $request->nombreOferta)
                        ->where('practicantes.nombre_completo', '=', $request->nombrePract)    
                        ->get();
                //echo $prac;        
                foreach ($prac as $key) {      
                    $details = [
                        //Titulo del Email
                        'nombrePract' => $request->nombrePract,
                        'nombreOferta' => $request->nombreOferta,
                        'nombre_ficticio' => $key->nombre_ficticio,
                        //'nombre_ficticio' => 
                    ];
                    Mail::to($key->email)->send(new PracticanteSeleccionado($details));
                }
                return response()->json([
                    'status' => 1,
                    'message' => 'Practicante Notificado Correctamente'
                ] ,200);
            }else{
                return response()->json([
                    'status' => 1,
                    'message' => 'Error'
                ] ,404);
            }
        }
    }
}