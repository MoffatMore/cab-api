<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $fillable = [
       'user_id',
        'cab_plate_number',
        'booking_date'
    ];
}
