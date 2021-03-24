<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'estado_post_id',
        'oferta_id',
        'practicante_id',
        'nombre',
        'fecha',
        'hora'
    ];

    // BelongsTo
    public function estado_post(){
        return $this->belongsTo(EstadoPost::class);
    }

    public function oferta(){
        return $this->belongsTo(Oferta::class);
    }

    public function practicante(){
        return $this->belongsTo(Practicante::class);
    }

    // HasMany
    public function entrevistas(){
        return $this->hasMany(Entrevista::class);
    }    
}
