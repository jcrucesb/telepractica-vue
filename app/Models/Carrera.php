<?php

namespace App\Models;

use App\Models\Escuela;
use App\Models\Mencion;
use App\Models\Institucion;
use App\Models\Practicante;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carrera extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'escuela_id',
        'mencion_id',
        'nombre'
    ];

    // BelongsTo
    public function escuela(){
        return $this->belongsTo(Escuela::class);
    }

    public function mencion(){
        return $this->belongsTo(Mencion::class);
    }

    // BelongsToMany
    public function institucions(){
        return $this->belongsToMany(Institucion::class, 'institucion_carreras');
    }

    public function ofertas(){
        return $this->belongsToMany(Oferta::class, 'oferta_carreras');
    }   

    public function practicantes(){
        return $this->belongsToMany(Practicante::class);
    }
}
