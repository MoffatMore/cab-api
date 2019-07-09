<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cab;

class CabController extends Controller
{
    //

    public function __construct()
    {

    }

    public function getDistance($latitude1, $longitude1, $latitude2, $longitude2)
    {

        $earth_radius = 6371;

        $dLat = deg2rad($latitude2 - $latitude1);
        $dLon = deg2rad($longitude2 - $longitude1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * asin(sqrt($a));
        $d = $earth_radius * $c;

        return round($d,2);

    }

    public function getCabs(Request $request)
    {

        $cabs = Cab::all();
        $latitude = $request->lat;
        $longitude = $request->long;

        foreach ($cabs as $cab) {

            $distance = $this->getDistance($latitude, $longitude, $cab->lat, $cab->long);
            $cab->distance = $distance;
            $cab->save();
        }

        return response()->json(['cabs' => $cabs]);
    }


}
