<?php

namespace App\Models;

use App\Models\Carrera;
use App\Models\Practicante;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Institucion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'usuario_id',
        'run',
        'nombre',
        'sigla',
        'web',
        'email',
        'telefono'
    ];

    // BelongsTo
    public function user(){
        return $this->belongsTo(User::class);
    }

    // BelongsToMany
    public function carreras(){
        return $this->belongsToMany(Carrera::class, 'institucion_carreras');
    }

    // HasMany
    public function practicantes(){
        return $this->belongsToMany(Practicante::class);
    }
}
