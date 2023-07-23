<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_institute',
        'id_template',
        'id_teacher',
        'semester',
        'periode',
    ];
}
