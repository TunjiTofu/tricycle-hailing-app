<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TarfinLabs\LaravelSpatial\Casts\LocationCast;
use TarfinLabs\LaravelSpatial\Traits\HasSpatial;

class Place extends Model
{
    use HasFactory;
    use HasSpatial;
    use HasUuids;


    protected $guarded = [];

    protected $casts  = [
        'coordinates' => LocationCast::class,
    ];
    
}
