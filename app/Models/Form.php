<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'scholar_course',
        'scholar_level',
        'label'
    ];

    public function questions() {
        return $this->hasMany(Question::class, 'form_id', 'id');
    }

}
