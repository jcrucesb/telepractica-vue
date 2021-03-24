<?php

namespace App\Models;

use App\Models\Oferta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstadoOferta extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre'
    ];

    // HasMany
    public function ofertas(){
        return $this->hasMany(Oferta::class);
    }
    
}
