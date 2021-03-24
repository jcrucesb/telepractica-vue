<?php

namespace App\Models;

use App\Models\Escuela;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre'
    ];

    // HasMany
    public function escuelas(){
        return $this->hasMany(Escuela::class);
    }
}
