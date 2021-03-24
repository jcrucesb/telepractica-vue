<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mencion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre'
    ];

    // HasMany
    public function carreras(){
        return $this->hasMany(Carrera::class);
    }
    
}
