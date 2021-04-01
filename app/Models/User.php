<?php

namespace App\Models;

use App\Models\Rol;
use App\Models\EstadoUsuario;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
/*Este es el use para utilizar los roles de Laravel permission.*/
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{   
    /*Utilizar los roles dentro de esta clase.*/
    use HasRoles;
    use HasFactory, Notifiable;

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
    
}
