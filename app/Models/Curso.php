<?php

namespace App\Models;

use App\Models\Practicante;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'practicante_id',
        'nombre_curs',
        'descripcion_curs',
        'duracion_curs',
        'adjunto_curs'
    ];

    // BelongsTo
    public function practicante(){
        return $this->belongsTo(Practicante::class);
    }
    
}
