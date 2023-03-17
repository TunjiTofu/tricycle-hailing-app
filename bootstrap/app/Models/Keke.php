<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keke extends Model
{
    use HasFactory;
    use HasUuids;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'rider_id','id');
    }
}
