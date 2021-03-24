<?php

namespace App\Models;

use App\Models\Practicante;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Experiencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'practicante_id',
        'nombre_exp',
        'descripcion_exp',
        'duracion_exp',
        'actividades_exp'
    ];

    // BelongsTo
    public function practicante(){
        return $this->belongsTo(Practicante::class);
    }
    
}
