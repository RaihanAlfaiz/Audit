<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',
        'unit',
        'unit_name',
        'price',
    ];

    public function addition()
    {
        return $this->hasMany(Addition::class);
    }
}
