<?php

namespace App\Models;

use App\Models\Postulacion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entrevista extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'postulacion_id',
        'comuna_id',
        'evaluacion',
        'seleccionado',
        'fecha_citacion',
        'hora_citacion',
        'correo_enviado',
    ];

    protected $casts = [
        'fecha_citacion' => 'date:d-m-Y',
    ];
    // BelongsTo
    public function postulacion(){
        return $this->belongsTo(Postulacion::class);
    }
    
}
