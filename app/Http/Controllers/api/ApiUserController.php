<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\Rol;
use App\Models\User;
use App\Models\Empresa;
use App\Models\Institucion;
use App\Models\Practicante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Hash;


class ApiUserController extends Controller
{
    /*public function __construct(){
        $this->middleware('client-credentials');
    }*/
    //

    public function logins(Request $request){
        //Session::flush();
        //dd($request);
        //if(Auth::attempt(['email' => $request->email, 'password' => $request->password ])){
            /*$user = Auth::user();
            //echo Auth::user()->rol_id;
            $responseArray = [];
            $responseArray['name'] = $user->name;
            $responseArray['token'] = $user->createToken('MyApp')->accessToken;
            //$responseArray[''] = 
            return response()->json($responseArray , 200);
            if (Auth::check()){
                if(Auth::user()->rol_id == 2){
                   return view('empresas.index');   
                }
                else if(Auth::user()->rol_id == 1){
                   return view('practicantes.index');
                }
             }
        }else{
            return response()->json(['error' => 'No está autenticado'], 203);
        }*/
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Credenciales Incorrectas', 401
            ]);
        }
        
        $user = $request->user();
        //echo $user;
        if ($user->rol_id == 2) {
            $tokenData = $user->createToken('Personal Access Token Empresa');
            $token = $tokenData->token;
        } else if ($user->rol_id == 1){
            $tokenData = $user->createToken('Personal Access Token Practicante');
            $token = $tokenData->token;
        }
        
        /*else{
            $tokenData = $user->createToken('Personal Access Token Practicante',['check-status']);
        }*/
        if ($token->save()) {
            if(Auth::check()){
                if(Auth::user()->rol_id == 2){
                    return response()->json([
                        'user' => $user,
                        'rol_id' => $user->rol_id,
                        'id_users' => $user->id,
                        'email' => $user->email,
                        'access_token' => $tokenData->accessToken,
                        'token_type' => 'Bearer',
                        //'token_scope' => $tokenData->token->scopes[0],
                    ], 200);
                }
                else if(Auth::user()->rol_id == 1){
                    return response()->json([
                        'user' => $user,
                        'rol_id' => $user->rol_id,
                        'id_users' => $user->id,
                        'email' => $user->email,
                        'access_token' => $tokenData->accessToken,
                        'token_type' => 'Bearer',
                        //'token_scope' => $tokenData->token->scopes[0],
                    ], 200);
                   //return view('practicantes.index');
                }
            }
        }else{
            return response()->json([
                'message' => 'Error',
                'status' => 401
            ], 401);
        }
    }
    public function logout(){
        $request->user()->token()->revoke();
        return view('welcome');
    }

    public function get_profile()
    {
        return view('admin/profile/profile');
    }
}
