<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\What3WordsGeocodeService;

class GeocodeServiceController extends Controller
{

    protected $geocoder;

    public function __construct()
    {
        $this->geocoder = new What3WordsGeocodeService();
    }

    public function forward(Request $request){
        return $this->geocoder->forward($request);
    }

    public function reverse(Request $request){
        return $this->geocoder->reverse($request);
    }

}
