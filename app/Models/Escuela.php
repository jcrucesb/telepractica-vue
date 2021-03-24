<?php

namespace App\Models;

use App\Models\Carrera;
use App\Models\Departamento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Escuela extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'departamento_id',
        'nombre'
    ];

    // BelongsTo
    public function departamento(){
        return $this->belongsTo(Departamento::class);
    }

    // HasMany
    public function carreras(){
        return $this->hasMany(Carrera::class);
    }
    
}
