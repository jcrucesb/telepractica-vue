<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoUsuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre'
    ];
    
    // HasMany
    public function users(){
        return $this->hasMany(User::class);
    }
    
}
