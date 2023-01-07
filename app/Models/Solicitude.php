<?php

namespace App\Models;

use App\Enums\SolicitudeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitude extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'user_id',
        'period_id',
        'status'
    ];

    protected $casts = [
        'status' => SolicitudeStatus::class
    ];

    public function form()
    {
        return $this->belongsTo(Form::class, "form_id", "id");
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, "solicitude_id", "id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function period()
    {
        return $this->belongsTo(Period::class, "period_id", "id");
    }

    public function group()
    {
        return $this->belongsTo(Group::class, "group_id", "id");
    }

}
