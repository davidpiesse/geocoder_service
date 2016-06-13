<?php

namespace App;


use Illuminate\Http\Request;

interface GeocodeService
{
    //shell class for all services to inherit
    public function forward(Request $request);

    public function reverse(Request $request);
//    public function convert();
}