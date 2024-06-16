<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $dates = ['event_date'];
    protected $fillable = [
        'tenant_name',
        'event_name',
        'email',
        'institution_origin',
        'phone',
        'capacity',
        'event_date',
        'rehearsal_date',
        'receipt_dp',
        'start_time',
        'end_time',
        'package_id', // Ubah ini menjadi package_id
        'status',
        'remaining_payment',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function booking()
    {
        return $this->hasOne(Booking::class, 'event_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    protected $appends = ['color_status'];

    public function getColorAttribute()
    {
        $x = "";
        if ($this->status == "Complete") {
            $x = "primary";
        } else if ($this->status == "DP") {
            $x = "warning";
        } else if ($this->status == "Pending") {
            $x = "danger";
        } else if ($this->status == "Process") {
            $x = "info";
        } else if ($this->status == "Success") {
            $x = "success";
        } else if ($this->status == "rehearsal") {
            $x = "gray";
        } else if ($this->status == "ready") {
            $x = "info";
        } else {
            $x = "dark";
        }
        return $x;
    }
}
