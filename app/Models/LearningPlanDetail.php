<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningPlanDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_learning_plan',
        'id_template_fill',
        'value',
    ];
}
