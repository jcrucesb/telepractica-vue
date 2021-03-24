<?php

namespace App\Models;

use App\Models\Oferta;
use App\Models\Carrera;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OfertaCarrera extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'carrera_id',
        'oferta_id'
    ];

    // BelongsTo
    public function carrera(){
        return $this->belongsTo(Carrera::class);
    }

    public function oferta(){
        return $this->belongsTo(Oferta::class);
    }
    
}
