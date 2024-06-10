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

    public function additions()
    {
        return $this->hasMany(Addition::class, 'booking_id');
    }

    public function itemList()
    {
        return $this->hasMany(ItemList::class, 'booking_id');
    }
}
