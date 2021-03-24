<?php

namespace App\Models;

use App\Models\Empresa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre'
    ];
    
    // HasMany
    public function empresas(){
        return $this->hasMany(Empresa::class);
    }
}
