<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateFill extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_template',
        'position',
        'title',
        'type',
        'column',
    ];
}
