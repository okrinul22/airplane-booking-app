<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirPlane extends Model
{
    use HasFactory;
    protected $table = 'air_plane';
    protected $primaryKey = 'air_plane_id';
    public $timestamps = false;

    public function sch()
    {
        return $this->hasMany(SchAirPlane::class, 'air_plane_id', 'air_plane_id');
    }
}
