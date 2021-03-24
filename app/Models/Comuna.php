<?php

namespace App\Models;

use App\Models\Practicante;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comuna extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'region_id',
        'nombre'
    ];

    // BelongsTo
    public function region(){
        return $this->belongsTo(Region::class);
    }

    // HasMany
    public function practicantes(){
        return $this->hasMany(Practicante::class);
    }
    
}
