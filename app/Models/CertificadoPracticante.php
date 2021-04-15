<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificadoPracticante extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'practicante_id',
        'nombreCurso',
        'nombreProfesionalCurso',
        'duracionMesesCurso',
        'duracionHorasCurso',
        'certificacion',
        'rutaArchivo',
    ];
}
