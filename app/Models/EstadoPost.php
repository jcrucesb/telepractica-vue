<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre'
    ];

    // HasMany
    public function postulaciones(){
        return $this->hasMany(Postulacion::class);
    }    

}
