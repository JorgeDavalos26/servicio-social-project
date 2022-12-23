<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'solicitude_id',
        'value',
    ];

    public function question() {
        return $this->belongsTo(Question::class, "question_id", "id");
    }

    public function solicitude() {
        return $this->belongsTo(Solicitude::class, "solicitude_id", "id");
    }

}
