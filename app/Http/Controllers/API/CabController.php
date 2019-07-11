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

        $dLat = deg2rad(floatval($latitude2) - floatval($latitude1));
        $dLon = deg2rad(floatval($longitude2) - floatval($longitude1));

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * asin(sqrt($a));
        $d = $earth_radius * $c;

        return round($d,2);

    }

    public function getCabs(Request $request)
    {

        $cabs = Cab::all();
        $latitude = floatval($request->lat);
        $longitude = floatval($request->long);

        foreach ($cabs as $cab) {

            $dist = $this->getDistance($cab->lat, $cab->long,$latitude, $longitude);
            $cab->distance = $dist;
            $cab->save();
        }

        return response()->json($cabs);
    }


}
