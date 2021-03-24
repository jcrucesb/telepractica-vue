<?php

namespace App\Models;

use App\Models\Practicante;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoPractica extends Model
{
    use HasFactory;
        
    protected $fillable = [
        'id',
        'nombre'
    ];
    
    // HasMany
    public function practicantes(){
        return $this->hasMany(Practicante::class);
    }
}
