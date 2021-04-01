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
        'name'
    ];

    public function users(){
        return $this->hasMany(User::class);
    } 
}
