<?php

namespace App\Models;

use App\Models\User;
use App\Models\Curso;
use App\Models\Comuna;
use App\Models\Region;
use App\Models\Experiencia;
use App\Models\Postulacion;
use App\Models\TipoPractica;
use App\Models\NivelEducacional;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Practicante extends Model
{
    use HasFactory;
    
    protected $casts = [
        'hab_blandas' => 'array',
        'hab_profesionals' => 'array'
    ];

    protected $fillable = [
        'id',
        'user_id',
        'carrera_id',
        'comuna_id',
        'institucion_id',
        'nivel_educacional_id',
        'region_id',
        'tipo_practica_id',
        'run',
        'nombre_completo',
        'email',
        'telefono',
        'internet_fijo',
        'equipo_computacional',
        'cantidad_horas',
        'cantidad_meses',
        'hab_blandas',
        'hab_profesionals',
        'experiencia',
    ];

    // BelongsTo
    public function carrera(){
        return $this->belongsTo(Carrera::class);
    }

    public function comuna(){
        return $this->belongsTo(Comuna::class);
    }

    public function institucion(){
        return $this->belongsTo(Institucion::class);
    }

    public function nivel_educacional(){
        return $this->belongsTo(NivelEducacional::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function tipo_practica(){
        return $this->belongsTo(TipoPractica::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    // HasMany
    public function cursos(){
        return $this->hasMany(Curso::class);
    }

    public function experiencias(){
        return $this->hasMany(Experiencia::class);
    }

    public function postulacions(){
        return $this->hasMany(Postulacion::class);
    }
    
}
