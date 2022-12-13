<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitude extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'user_id',
        'status'
    ];

    public function form()
    {
        return $this->belongsTo(Form::class, "form_id", "id");
    }

    public function responses()
    {
        return $this->hasMany(Answer::class, "solicitude_id", "id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

}
