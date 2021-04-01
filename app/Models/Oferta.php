<?php

namespace App\Models;

use App\Models\Carrera;
use App\Models\Empresa;
use App\Models\Supervisor;
use App\Models\Postulacion;
use App\Models\EstadoOferta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Oferta extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'empresa_id',
        'estado_oferta_id',
        'supervisor_id',
        'nombre_oferta',
        'descripcion',
        'remunerada',
        'valor_remuneracion',
        'fecha_inicio',
        'fecha_termino',
        'requisitos_min',
        'cupos_totales',
        'postulaciones_recibidas'
    ];

    // BelongsTo
    public function empresa(){
        return $this->belongsTo(Empresa::class);
    }

    public function estado_oferta(){
        return $this->belongsTo(EstadoOferta::class);
    }

    public function supervisor(){
        return $this->belongsTo(Supervisor::class);
    }
    
    // BelongsToMany
    public function carreras(){
        return $this->belongsToMany(Carrera::class, 'oferta_carreras');
    }
    
    // HasMany
    public function postulaciones(){
        return $this->hasMany(Postulacion::class);
    }
    
}
