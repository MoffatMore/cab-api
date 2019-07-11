<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cab extends Model
{
    protected $fillable = [
        'name',
        'distance',
        'plate_number',
        'rating',
        'price',
        'lat',
        'long'
    ];
}
