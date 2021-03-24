<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rol extends Model
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
