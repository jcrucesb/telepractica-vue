<?php

namespace App\Http\Controllers\api;

use App\Models\Rol;
use App\Models\User;
use App\Models\Region;
//use Faker\Provider\Image;
use App\Models\Institucion;
use App\Models\Postulacion;
use App\Models\Practicante;
use App\Models\TipoPractica;
use Illuminate\Http\Request;
//use Intervention\Image\Image;
use App\Models\EstadoUsuario;
use App\Models\CurriculumPracticante;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
//use Intervention\Image\Facades\Image;
use Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\PracticanteRegistroEmail;
use App\Models\CertificadoPracticante;

class ApiPracticanteController extends Controller
{
    /*Método para insertar a un PRACTICANTE desde la vista WELCOME, Jair*/
    public function registPrac(Request $request){
        //dd($request);
        /*data = request()->validate([
            'comuna' => ['required','max:1'],
            'institucion' => ['required'],
            'educacion' => ['required'],
            'region' => ['required'],
            'practica' => ['required'],
            'rut' => ['required', 'string'],
            'nombre_completo' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:255'],
            'cantidadHora' => ['required', 'integer'],
            'cantidadMeses' => ['required', 'integer'],
            'equipoComputacional' => ['required', 'string'],
            'internetFijo' => ['required', 'string'],
            'hab.*' => ['required','min:3','max:3'],
            'habilida_blandas.*' => ['required','min:1','max:1'],
            'habilid_blandas.*' => ['required','min:1','max:1'],
            'habili_blandas.*' => ['required','min:1','max:1'],
            'habilidades_profesionales.*' => ['required','min:3' ,'max:3'],
            'experiencia' => ['required', 'string'],
        ]);*/
        $exist = DB::table('users')
        ->select('email')
        ->where('email', '=', $request->email)
        ->where('run', '=', $request->rut)
        ->get();
        if (count($exist) > 0) {
            return response()->json([
                'status' => '2',
                'msg' => 'existe el email registrado',
            ]);
        }else{
            $user = User::create([
                /*Funcionando correctamente.*/
                'name' => $request->usuario,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'api_token' => Str::random(10),
                'rol_id' => 1,
                'run' => $request->rut,
                'estado_usuario_id' => 1,
            ])->assignRole('Practicante');
    
            if ($user) {  
                $user->id; 
                $prac = Practicante::create([
                    /*Funcionando correctamente.*/
                    'user_id' => $user->id,
                    'carrera_id' => $request->carrera,
                    'email' => $request->email,
                    'run' => $request->rut,
                ]);
            }
                $details = [
                    //Titulo del Email
                    'email' => $request->email,
                    'name' => $request->usuario,
                    'verificacion' => 'Citación'
                ];
                //var_dump($mailDetails['email']);
                //Email a enviar.
                Mail::to($request->email)->send(new PracticanteRegistroEmail($details));
                
                return response()->json([
                    'status' => '1',
                    'msg' => 'correo enviado',
                ]);
        }
    }
    /*Actualizar los datos del practicante con el formulario de registro.*/
    public function formPrac(Request $request){
        //dd($request);
        $e = collect(explode( ',', $request->hab));
        $cv = collect(explode( ',', $request->hab_profs));
        if(count($e) != 3 || count($cv) != 3){
            return response()->json([
                'status' => '3',
                'msg' => 'error',
            ]);
        }
        /*$data = request()->validate([
            'comuna' => ['required','max:1'],
            'institucion' => ['required'],
            'educacion' => ['required'],
            'region' => ['required'],
            'practica' => ['required'],
            'rut' => ['required', 'string'],
            'nombre_completo' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:255'],
            'cantidadHora' => ['required', 'integer'],
            'cantidadMeses' => ['required', 'integer'],
            'equipoComputacional' => ['required', 'string'],
            'internetFijo' => ['required', 'string'],
            'hab.*' => ['required','min:3','max:3'],
            'habilida_blandas.*' => ['required','min:1','max:1'],
            'habilid_blandas.*' => ['required','min:1','max:1'],
            'habili_blandas.*' => ['required','min:1','max:1'],
            'habilidades_profesionales.*' => ['required','min:3' ,'max:3'],
            'experiencia' => ['required', 'string'],
        ]);*/
        if ($request->hasFile('img')) {
        /*Actualizamos los datos del Practicante cuando llene el formulario 
        que se envió a su correo electrónico.*/
        $prac = DB::table('practicantes')
        ->where('email','=', $request->email)
        ->where('run','=', $request->rut)
        ->update(array(
                       'comuna_id' => $request->comuna,
                       'institucion_id' => $request->institucion,
                       'nivel_educacional_id' => $request->educacion,
                       'region_id' => $request->region,
                       'tipo_practica_id' => $request->practica,
                       'run' => $request->rut,
                       'nombre_completo' => $request->nombre_completo,
                       'telefono' => $request->telefono,
                       'cantidad_horas' => $request->cantidadHora,
                       'cantidad_meses' => $request->cantidadMeses,
                       'equipo_computacional' => $request->equipoComputacional,
                       'internet_fijo' => $request->internetFijo,
                       'hab_blandas' => json_encode($e),
                       'hab_profesionals' => json_encode($cv),
                       //'experiencia' => $request->experiencia,
                    ));
                //$prac->save();
            /*Obtendremos el id del usuario que esta completando su registro.*/
            $_id = DB::table('practicantes')
            ->select('id')
            ->where('email', '=', $request->email)
            ->where('run', '=', $request->rut)
            ->get();
            foreach ($_id as $key) {
                /*Funcionando correctamente.*/
                $practicante = $request->all();
                //dd($request->img);
                $practicante = new CertificadoPracticante();
                $practicante->practicante_id = $key->id;
                $practicante->nombreCurso = $request->nombreCurso;
                $practicante->nombreProfesionalCurso = $request->profesionalCargo;
                $practicante->duracionMesesCurso = $request->duracionCurso;
                $practicante->duracionHorasCurso = $request->horasCurso;
                $practicante->certificacion = $request->certificacion;

                if($request->hasFile('img')) {
                    $practicante['rutaArchivo'] = time() . '_' . 
                    $request->file('img')->getClientOriginalName();
                    $request->file('img')->move(public_path('certificacion'), 
                    $practicante['rutaArchivo']);
                }
                $practicante->save();
            }
            if($_id){
                return response()->json([
                    'status' => '1',
                    'msg' => 'estamos Full',
                ]);
            }
        }else if($request->img === "undefined"){
        /*Actualizamos los datos del Practicante cuando llene el formulario 
        que se envió a su correo electrónico.*/
        $pra = DB::table('practicantes')
        ->where('email','=', $request->email)
        //->where('run','=', $request->rut)
        ->update(array(
                       'comuna_id' => $request->comuna,
                       'institucion_id' => $request->institucion,
                       'nivel_educacional_id' => $request->educacion,
                       'region_id' => $request->region,
                       'tipo_practica_id' => $request->practica,
                       'run' => $request->rut,
                       'nombre_completo' => $request->nombre_completo,
                       'telefono' => $request->telefono,
                       'cantidad_horas' => $request->cantidadHora,
                       'cantidad_meses' => $request->cantidadMeses,
                       'equipo_computacional' => $request->equipoComputacional,
                       'internet_fijo' => $request->internetFijo,
                       'hab_blandas' => json_encode($e),
                       'hab_profesionals' => json_encode($cv),
                       //'experiencia' => $request->experiencia,
                    ));
                    //$pra->save();
                    return response()->json([
                        'status' => '1',
                        'msg' => 'estamos Full',
                    ]);
        }
    }
    /*Datos del PRACTICANTE para mostrar y EDITAR desde su DASHBOARD, Jair*/
    public function datPract(Request $request){
        $id = auth()->id();
        //echo $id;
        $prac = DB::table('practicantes')
        ->select('id', 'run', 'nombre_completo', 'email','telefono',
                 'cantidad_horas', 'cantidad_meses', 'hab_blandas', 'hab_profesionals')
        ->where('user_id', '=', $id)
        ->get();
        return response()->json($prac, 200);
    }
    /*Datos del PRACTICANTE para mostrar sus CERTIFICADOS desde su DASHBOARD, Jair*/
    public function curriculumPracticantes(Request $request){
        $id = auth()->id();
        $prac = DB::table('practicantes')
        ->select('id')
        ->where('user_id', '=', $id)
        ->get();
        foreach($prac as $key){
            $cur = DB::table('curriculum_practicantes')
                    ->select('id','rutaCurriculum')
                    ->where('practicante_id', '=', $key->id)
                    ->get();
            return response()->json($cur,200);
        }
    }
    /*Método para ELIMINAR un CURSO con ERTIFICADO.Jair*/
    public function crearCurriculum(Request $request){
        //dd($request); 
        $id = auth()->id();
        //echo $id;
        $prac = DB::table('practicantes')
        ->select('id')
        ->where('user_id', '=', $id)
        ->get();
        foreach ($prac as $key) {                
            $practicante = $request->all();
            $practicante = new CurriculumPracticante();
            $practicante->practicante_id = $key->id;
            if($request->hasFile('img')) {
                $practicante['rutaCurriculum'] = time() . '_' . 
                $request->file('img')->getClientOriginalName();
                $request->file('img')->move(public_path('curriculumPracticantes'), 
                $practicante['rutaCurriculum']);
            }
            $practicante->save();
            if(count($prac) > 0){
                return response()->json([
                    'status' => '1',
                    'msg' => 'estamos Full',
                ]);
            }else{
                return response()->json([
                    'status' => '2',
                    'msg' => 'error',
                ]);
            }
        }
    }
    /*EDITAR CERTIFICADOS desde su DASHBOARD Practicante, Jair*/
    public function editarCurriculum(Request $request){
        //dd($request);                 
        $practicante = $request->all();
        $practicante = new CurriculumPracticante();
        
        if($request->hasFile('img')){
            $practicante['rutaCurriculum'] = time() . '_' . 
            $request->file('img')->getClientOriginalName();
            $request->file('img')->move(public_path('curriculumPracticantes'), 
            $practicante['rutaCurriculum']);
            $ro = $practicante['rutaCurriculum'];

            $prac = DB::table('curriculum_practicantes')
            ->where('id','=', $request->id)
            ->update(array(
                'rutaCurriculum' => $ro,
            ));
            return response()->json([
                'status' => '1'
            ]);
        }else if($request->hasFile('img') == null){
            return response()->json([
                'status' => '2'
            ]);
        }
    }
    /**Método para ELIMINAR el CURRICULUM del PRACTICANTE desde su DASHBOARD.Jair*/
    public function eliminar_curriculum(CurriculumPracticante $id){
        //dd($id);
        $id->delete();
    }
    /*Datos del PRACTICANTE para mostrar sus CERTIFICADOS desde su DASHBOARD, Jair*/
    public function certificadosPracticantes(){
        $id = auth()->id();
        //echo $id;
        $prac = DB::table('practicantes')
        ->select('id')
        ->where('user_id', '=', $id)
        ->get();
        foreach ($prac as $key) {
            $prac = DB::table('certificado_practicantes')
                    ->select('id','practicante_id', 'nombreCurso', 'nombreProfesionalCurso', 'duracionMesesCurso',
                            'duracionHorasCurso','certificacion','rutaArchivo')
                    ->where('practicante_id', '=', $key->id)
                    ->get();
                    return response()->json($prac,200);
        }
    }
    /*Crear Curso con CERTIFICADOS desde su DASHBOARD Practicante, Jair*/
    public function crearCurso(Request $request){
        //dd($request); 
        $id = auth()->id();
        //echo $id;
        $prac = DB::table('practicantes')
        ->select('id')
        ->where('user_id', '=', $id)
        ->get();
        foreach ($prac as $key) {                
            $practicante = $request->all();
            $practicante = new CertificadoPracticante();
            $practicante->practicante_id = $key->id;
            $practicante->nombreCurso = $request->nombreCurso;
            $practicante->nombreProfesionalCurso = $request->nombreProfesionalCurso;
            $practicante->duracionMesesCurso = $request->duracionMesesCurso;
            $practicante->duracionHorasCurso = $request->duracionHorasCurso;
            $practicante->certificacion = $request->certificacion;

            if($request->hasFile('img')) {
                $practicante['rutaArchivo'] = time() . '_' . 
                $request->file('img')->getClientOriginalName();
                $request->file('img')->move(public_path('certificacion'), 
                $practicante['rutaArchivo']);
            }
            $practicante->save();
            if(count($prac) > 0){
                return response()->json([
                    'status' => '1',
                    'msg' => 'estamos Full',
                ]);
            }else{
                return response()->json([
                    'status' => '2',
                    'msg' => 'error',
                ]);
            }
        }
    }
    /*EDITAR CERTIFICADOS desde su DASHBOARD Practicante, Jair*/
    public function editarCertificado(Request $request){
        //dd($request->img);                 
        $practicante = $request->all();
        $practicante = new CertificadoPracticante();
        
        if($request->hasFile('img')){
            $practicante['rutaArchivo'] = time() . '_' . 
            $request->file('img')->getClientOriginalName();
            $request->file('img')->move(public_path('certificacion'), 
            $practicante['rutaArchivo']);
            $ro = $practicante['rutaArchivo'];

            $prac = DB::table('certificado_practicantes')
            ->where('id','=', $request->id)
            ->update(array(
                'nombreCurso' => $request->nombreCurso,
                'nombreProfesionalCurso' => $request->nombreProfesionalCurso,
                'duracionMesesCurso' => $request->duracionMesesCurso,
                'duracionHorasCurso' => $request->duracionHorasCurso,
                'certificacion' => $request->certificacion,
                'rutaArchivo' => $ro,
            ));
            return response()->json([
                'status' => '1'
            ]);
        }else if($request->hasFile('img') == null){
            $prac = DB::table('certificado_practicantes')
            ->where('id','=', $request->id)
            ->update(array(
                'nombreCurso' => $request->nombreCurso,
                'nombreProfesionalCurso' => $request->nombreProfesionalCurso,
                'duracionMesesCurso' => $request->duracionMesesCurso,
                'duracionHorasCurso' => $request->duracionHorasCurso,
                'certificacion' => $request->certificacion,
                //'rutaArchivo' => $ro,
            ));
            return response()->json([
                'status' => '1'
            ]);
        }
    }
    /**Método para ELIMINAR un CURSO con ERTIFICADO.Jair*/
    public function eliminar_curso(CertificadoPracticante $id){
        //dd($id);
        $id->delete();
    }
    /**Método para ELIMINAR el CURRICULUM del PRACTICANTE desde su DASHBOARD.Jair*/
    public function editarFormPrac(Request $request){
        //dd($request);
        $e = collect(explode( ',', $request->hab));
        $cv = collect(explode( ',', $request->hab_profs));
        if(count($e) != 3 || count($cv) != 3){
            return response()->json([
                'status' => '3',
                'msg' => 'error',
            ]);
        }
        $data = request()->validate([
            'comuna' => ['required','max:1'],
            'institucion' => ['required'],
            'educacion' => ['required'],
            'region' => ['required'],
            'practica' => ['required'],
            'rut' => ['required', 'string'],
            'nombre_completo' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:255'],
            'cantidadHora' => ['required', 'integer'],
            'cantidadMeses' => ['required', 'integer'],
            'equipoComputacional' => ['required', 'string'],
            'internetFijo' => ['required', 'string'],
            'hab.*' => ['required','min:3','max:3'],
            /*'habilida_blandas.*' => ['required','min:1','max:1'],
            'habilid_blandas.*' => ['required','min:1','max:1'],
            'habili_blandas.*' => ['required','min:1','max:1'],*/
            'habilidades_profesionales.*' => ['required','min:3' ,'max:3'],
            'experiencia' => ['required', 'string'],
        ]);

        $prac = DB::table('practicantes')
        ->where('email','=', $request->email)
        ->where('run','=', $request->rut)
        ->update(array(
            //'carrera_id' => $request->,
            'comuna_id' => $request->comuna,
            'institucion_id' => $request->institucion,
            'nivel_educacional_id' => $request->educacion,
            'region_id' => $request->region,
            'tipo_practica_id' => $request->practica,
            'run' => $request->rut,
            'nombre_completo' => $request->nombre_completo,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'internet_fijo' => $request->internetFijo,
            'equipo_computacional' => $request->equipoComputacional,
            'cantidad_horas' => $request->cantidadHora,
            'cantidad_meses' => $request->cantidadMeses,
            'hab_blandas' => json_encode($e),
            'hab_profesionals' => json_encode($cv),
            'experiencia' => $request->experiencia,
        ));
        if (!$prac) {
            return response()->json([
                'status' => '2',
                'msg' => 'estamos Full',
            ]);
        }else{
            return response()->json([
                'status' => '1',
                'msg' => 'error',
            ]);
        }
    }
}
