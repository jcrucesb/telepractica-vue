<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumPracticante extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'practicante_id',
    ];
}
