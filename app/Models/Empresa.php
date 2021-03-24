<?php

namespace App\Models;

use App\Models\Area;
use App\Models\User;
use App\Models\Oferta;
use App\Models\Supervisor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'area_id',
        'run',
        'email',
        'razon_social',
        'nombre_ficticio',
        'giro',
        'descripcion',
        'web',
        'telefono',
        'direccion',
        'fecha_inicio_actividades'
    ];

    // BelongsTo
    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    // HasMany
    public function ofertas(){
        return $this->hasMany(Oferta::class);
    }

    public function supervisors(){
        return $this->hasMany(Supervisor::class);
    }
    
}
