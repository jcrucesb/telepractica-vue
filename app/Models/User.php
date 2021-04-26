<?php

namespace App\Models;

use App\Models\Rol;
use App\Models\EstadoUsuario;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Tymon\JWTAuth\Contracts\JWTSubject;
/*Este es el use para utilizar los roles de Laravel permission.*/
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{   
    /*Utilizar los roles dentro de esta clase.*/
    use HasRoles;
    use HasApiTokens,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'estado_usuario_id',
        //'rol_id',
        'run',
        'email',
        'name',
        'password',
        'api_token',
        'rol_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function estado_usuario(){
        return $this->belongsTo(EstadoUsuario::class);
    }
    public function rol(){
        return $this->belongsTo(Rol::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
