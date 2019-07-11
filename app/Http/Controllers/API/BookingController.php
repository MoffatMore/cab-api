<?php

namespace App\Http\Controllers\API;

use App\Cab;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    //

    public function bookCab(Request $request){

        $cab = Cab::where([
            'plate_number'=>$request->plate_number
        ])->get();

        if ($cab && $cab->status == 1){
            $array = [
                ''
            ];
        }
    }
}
