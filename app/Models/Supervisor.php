<?php

namespace App\Models;

use App\Models\Oferta;
use App\Models\Empresa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supervisor extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'empresa_id',
        'run',
        'nombre_completo',
        'email',
        'telefono'
    ];

    // BelongsTo
    public function empresa(){
        return $this->belongsTo(Empresa::class);
    }
    
    // HasMany
    public function ofertas(){
        return $this->hasMany(Oferta::class);
    }
    
}
