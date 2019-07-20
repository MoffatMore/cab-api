<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cab extends Model
{
    protected $fillable = [
        'name',
        'distance',
        'user_id',
        'plate_number',
        'rating',
        'price',
        'status',
        'lat',
        'long',
        'status'
    ];
}
