<?php

namespace App\Models;

use App\Models\Carrera;
use App\Models\Institucion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InstitucionCarrera extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'carrera_id',
        'institucion_id'
    ];

    // BelongsTo
    public function carrera(){
        return $this->belongsTo(Carrera::class);
    }

    public function institucion(){
        return $this->belongsTo(Institucion::class);
    }
    
}
