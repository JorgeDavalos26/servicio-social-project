<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'field_id',
        'hidden',
        'blocked',
    ];

    protected $casts = [
        'hidden' => 'boolean',
        'blocked' => 'boolean'
    ];

    public function field() {
        return $this->belongsTo(Field::class, "field_id", "id");
    }

    public function form() {
        return $this->belongsTo(Form::class, "form_id", "id");
    }

}
