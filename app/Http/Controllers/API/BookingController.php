<?php

namespace App\Http\Controllers\API;

use App\Booking;
use App\Cab;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    //

    public function requestCab(Request $request){

        $cab = Cab::where([
            'plate_number'=>$request->plate_number
        ])->get();

        if ($cab && $cab->status){
            $array = [
                'user_id'=>$request->user_id,
                'plate_number'=>$request->plate_number,
                'booking_date'=>$request->booking_date
            ];
            $booking = Booking::insert($array);

            if ($booking){

                return response()->json([
                    'success'=>true
                ]);
            }
            return response()->json([
                'success'=>false
            ]);

        }
    }
}
