<?php

namespace App\Models;

use App\Models\Booking;
use App\Models\AirPlane;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchAirPlane extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'sch_air_plane';
    protected $primaryKey = 'sch_air_plane_id';
    public $timestamps = false;

    public function air_plane()
    {
        return $this->belongsTo(AirPlane::class, 'air_plane_id', 'air_plane_id');
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'booking_id', 'booking_id');
    }
}
