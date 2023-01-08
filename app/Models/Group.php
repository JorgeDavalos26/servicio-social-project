<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'period_id',
        'name'
    ];

    public function solicitudes()
    {
        return $this->hasMany(Solicitude::class, "solicitude_id", "id");
    }

    public function period()
    {
        return $this->belongsTo(Period::class, "period_id", "id");
    }

}
