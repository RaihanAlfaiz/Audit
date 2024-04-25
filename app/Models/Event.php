<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'tenant_name',
        'institution_origin',
        'phone',
        'capacity',
        'event_date',
        'rehearsal_date',
        'venue',
        'description',
        'about',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
