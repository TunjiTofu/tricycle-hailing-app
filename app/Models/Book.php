<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TarfinLabs\LaravelSpatial\Casts\LocationCast;
use TarfinLabs\LaravelSpatial\Traits\HasSpatial;

class Book extends Model
{
    use HasFactory;
    use HasUuids;
    use HasSpatial;

    protected $guarded = [];

    protected $casts  = [
        'pick_up' => LocationCast::class,
        'destination' => LocationCast::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'rider_id','id');
    }

    public function rating()
    {
        return $this->belongsTo(Rating::class, 'id', 'book_id');
    } 
}
