<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TarfinLabs\LaravelSpatial\Casts\LocationCast;
use TarfinLabs\LaravelSpatial\Traits\HasSpatial;
class TripHistory extends Model
{
    use HasFactory;
    use HasUuids;
    use HasSpatial;
    
    protected $guarded = [];

    protected $casts  = [
        'start_location' => LocationCast::class,
        'current_location' => LocationCast::class,
        'end_location' => LocationCast::class,
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class,'rider_id','id');
    }
}
