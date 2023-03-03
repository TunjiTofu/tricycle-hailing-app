<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TarfinLabs\LaravelSpatial\Casts\LocationCast;

class Book extends Model
{
    use HasFactory;
    use HasUuids;

    protected $guarded = [];

    protected $casts  = [
        'pick_up' => LocationCast::class,
        'destination' => LocationCast::class,
    ];

}
