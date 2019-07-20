<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $fillable = [
       'user_id',
        'plate_number',
        'booking_date'
    ];

    public function user(){

        return $this->hasMany('App\User');
    }
}
