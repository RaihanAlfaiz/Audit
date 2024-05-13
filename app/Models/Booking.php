<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id',
        'penambahan_id',
        'total_payment',
        'ktp',
        'receipt_full',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function addition()
    {
        return $this->belongsTo(Addition::class);
    }
}
