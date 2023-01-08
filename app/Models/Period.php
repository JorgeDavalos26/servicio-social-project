<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'label',
    ];

    public function groups()
    {
        return $this->hasMany(Group::class, "period_id", "id");
    }

}
