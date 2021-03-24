<?php

namespace App\Models;

use App\Models\Comuna;
use App\Models\Practicante;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'nombre'
    ];
    
    // HasMany
    public function comunas(){
        return $this->hasMany(Comuna::class);
    }

    public function practicantes(){
        return $this->hasMany(Practicante::class);
    }
    
}
