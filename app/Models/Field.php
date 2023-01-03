<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'backend_name',
        'frontend_name',
        'type',
        'regex_validation',
        'select_values'
    ];

}
