<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'booking';
    protected $primaryKey = 'booking_id';
    public $timestamps = false;

    public function payment()
    {
        return $this->hasOne(Payment::class, 'booking_id', 'booking_id');
    }

    public function sch_air_plane()
    {
        return $this->belongsTo(SchAirPlane::class, 'sch_airplane_id', 'sch_air_plane_id');
    }

    public function user_registered()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
