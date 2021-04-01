<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rol;
use App\Models\OfertaCarrera;
use App\Models\Practicante;
use App\Models\Entrevista;
use App\Models\EstadoEntrevista;
/**Importamos el modelo de Laravel permission.*/
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\CorreoEntrevista;
use Illuminate\Support\Facades\DB;
use App\Models\Oferta;
use App\Models\User;
use App\Models\Empresa;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use App\Models\EstadoUsuario;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     
       //Funcionando correctamente el filtro de USUARIOS.
        if(auth()->user()->can('empresas.index')){
            return view('empresas.index');
        }else if(auth()->user()->can('admin.home')){
            return view('admin.empresa.index');
        }
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
            'rol_id' => ['required'],

            'area_id' => ['required'],
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

        // Creación del perfil (empresa)

        $empresa = new Empresa();

        $empresa->id = $user->id;
        $empresa->run = $user->run;
        $empresa->nombre_ficticio = $user->name;
        $empresa->email = $user->email;
        $empresa->area_id = $request['area_id'];

        $empresa->user_id = $user->id;
        $empresa->save();

        return response()->json('Empresa creada', 200);
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
            'rol_id' => ['required'],

            'area_id' => ['required'],
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        Empresa::where('id', $user->id)->update(['run' => $request->run]);
        Empresa::where('id', $user->id)->update(['nombre_ficticio' => $request->name]);
        Empresa::where('id', $user->id)->update(['email' => $request->email]);
        Empresa::where('id', $user->id)->update(['area_id' => $request->area_id]);

        return response()->json('Empresa actualizada', 200);
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
        $empresas = Empresa::orderBy('id', 'desc')->orderBy('nombre_ficticio', 'asc')->get();

        $empresas->transform(function($empresa) {
            $empresa->area_nombre = $empresa->area->nombre;

            $user = User::findOrFail($empresa->id);
            $estado_usuario = EstadoUsuario::findOrFail($user->estado_usuario_id);
            $rol = Rol::findOrFail($user->rol_id);
            $empresa->supervisors;

            $empresa->user = $empresa->user;
            $empresa->estado_usuario_nombre = $estado_usuario->nombre;
            $empresa->rol_nombre = $rol->nombre;
            
            $empresa->estado_usuario_id = $estado_usuario->id;
            $empresa->rol_id = $rol->id;
            
            return $empresa;
        });

        return response()->json([
            'empresas' => $empresas
        ], 200);
    }

    public function get_empresa($id)
    {
        $empresa = Empresa::where('id', $id)->get();

        $empresa->transform(function($empresa_) {
            $empresa_->area_nombre = $empresa_->area->nombre;

            $user = User::findOrFail($empresa_->id);
            $estado_usuario = EstadoUsuario::findOrFail($user->estado_usuario_id);
            $rol = Rol::findOrFail($user->rol_id);

            $empresa_->user = $empresa_->user;
            $empresa_->estado_usuario_nombre = $estado_usuario->nombre;
            $empresa_->rol_nombre = $rol->nombre;
            
            $empresa_->estado_usuario_id = $estado_usuario->id;
            $empresa_->rol_id = $rol->id;

            return $empresa_;
        });

        return response()->json([
            'empresa' => $empresa
        ], 200);
    }
    /*Registrar las EMPRESAS desde la vista WELCOME por Jair.*/
    public function regitEmpresa(Request $request){
        //dd($request);
        //Validaciones.
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
        ])->assignRole([$empresa]);

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
    }
    //
    public function registrarOfer(Request $request){
        //dd();
        $emp = DB::table('ofertas')
        ->select('nombre_oferta')
        ->where('nombre_oferta', '=', $request->nombre_oferta)
        ->get();
        //Con esto obtenemos el resultado del id de la session que viene siendo la EMPRESA.
        $empresa_email = auth()->user()->email; 
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
                    'nombre_oferta' => $request->nombre_oferta,
                    'descripcion' => $request->descripcion,
                    'remunerada' => $request->remunerada,
                    'valor_remuneracion' => $request->valor_remuneracion,
                    'cupos_totales' => $request->cupos,
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
            //'carrera' => 'required',
        ]);
        //dd($data);
        //
        $idOferta->update($data);
        return response()->json(1); 
    }
    /*Método para listar los PRACTICANTES que postularon a la OFERTA  de alguna EMPRESA, 
    la lista es por EMPRESA y su OFERTA.*/
    public function listarPracticantes(){  
        //dd($request);
        $id =auth()->id();
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
                ->get();

            return $prac;
        }
        
    }
    /*Método para enviar por correo la fecha de postulación al practicante por parte de la
    EMPRESA*/
    public function enviarPostulacionPracticante(Request $request){
        //dd($request);
        $mailDetails = [
            //Titulo del Email
            'email' => $request->email_practicante,
            'verificacion' => 'Citación'
        ];
        //var_dump($mailDetails['email']);
        //Email a enviar.
        Mail::to($request->email_practicante)->send(new CorreoEntrevista($request->email_practicante));
        
        /* */
        $id_post = DB::table('postulacions')
                   ->select('id', 'oferta_id', 'practicante_id', 'nombre')
                   ->where('practicante_id', '=', $request->id_practicante)
                   ->where('nombre', '=', $request->nombreOferta)
                   ->get();
        //echo count($id_post);
        if(count($id_post)){
            foreach ($id_post as $key) {
                $id_entrevista = Entrevista::create([
                    'postulacion_id' => $key->id,
                    'fecha_citacion' => $request->fechaCitacion,
                    'hora_citacion' => $request->horaCitacion,
                ]);
                //Veamos si funciona.
                $id_entrevista = EstadoEntrevista::create([
                    'entrevista_id' => $id_entrevista->id,
                ]);
            }
        }
        
    }
    /*Método para recibir la CONFIRMACIÓN del PRACTICANTE a su fecha de citación.*/
    public function confirmacionPracticante(Request $request){
        //dd($request);
        $id_prac = DB::table('practicantes')
                    ->join('postulacions', 'practicantes.id', '=', 'postulacions.practicante_id')
                    ->join('entrevistas', 'postulacions.id', '=', 'entrevistas.postulacion_id')
                    ->select('entrevistas.id as entrevista_id','entrevistas.postulacion_id','practicantes.id', 'practicantes.run', 'practicantes.nombre_completo', 'practicantes.email')
                    ->where('practicantes.run', '=', $request->run)
                    ->get();
                if (count($id_prac) > 0) {
                    foreach ($id_prac as $key) {
                        $prac = DB::table('estado_entrevistas')
                               ->where('entrevista_id','=', $key->entrevista_id)  // find your user by their email
                               ->update(array(
                                   'rut_confirmacion' => $request->run,
                               ));
                               return response()->json([
                                   'msg' => '0'
                               ]);
                   }
                }else{
                    return response()->json([
                        'msg' => '1'
                    ]);
                }
    }
    /*Método para obtener a los PRACTICANTES que confirmaron la fecha de entrevista.*/
    public function practicantesConfirmaron(){
        $run_prac = DB::table('estado_entrevistas')
                    ->select('rut_confirmacion')
                    ->get();
                    //echo $run_prac;
        foreach ($run_prac as $key) {
            $prac = DB::table('estado_entrevistas')
                ->join('entrevistas','estado_entrevistas.entrevista_id', '=', 'entrevistas.id')
                ->join('postulacions','entrevistas.postulacion_id', '=', 'postulacions.id')
                ->join('practicantes','postulacions.practicante_id', '=', 'practicantes.id')
                ->select('practicantes.id','practicantes.run', 'practicantes.nombre_completo', 'postulacions.nombre',
                         'practicantes.email')
                //->where('estado_entrevistas.rut_confirmacion', '=',$key->rut_confirmacion)
                ->get();
            return $prac;
            //echo $prac;
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
    /*Obtener los datos de la EMPRESA para listarlos desde su DASHBOARD, Jair.*/
    public function datEmp(){
        $empresa = auth()->id();
        //echo $empresa;
        $dat = DB::table('empresas')
                ->select('id','user_id','run','email','razon_social','nombre_ficticio', 'giro','descripcion',
                        'web', 'telefono', 'direccion')
                ->where('user_id', '=', $empresa)
                ->get();
        return $dat;
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
}