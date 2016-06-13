<?php

namespace App;

use GuzzleHttp\Client;
use App\GeocodeService;
use Illuminate\Http\Request;

//TODO Create classes for all the ESRI responses


class What3WordsGeocodeService implements GeocodeService
{
    //extends core Geocode Service class to implement specific API calls etc for forward / reverse calls
    protected $key;

    protected $api_base_uri = "https://api.what3words.com/v2/";
    protected $api_forward = 'forward';
    protected $api_reverse = 'reverse';
    protected $client;

    public function __construct()
    {
        //associate a API key in your env file
        $this->key == env('W3W_KEY');
        $this->client = new Client(['base_uri' => $this->api_base_uri]);
    }

    //convert a string / address into a location
    public function forward(Request $request)
    {
        //needs text and f
//        $string="index.home.raft";
        $response = $this->client->request('GET', $this->api_forward, [
            'query' => [
                'key' => env('W3W_KEY', 'xxxxxxx'),
                'addr' => $request->text,
            ]
        ]);
        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody());
            //get info needed (lat lon, bounds)
            $words = $data->words;
            $latitude = floatval($data->geometry->lat);
            $longitude = floatval($data->geometry->lng);
            $bounds = [];
            //return a valid ESRI response (class defined)
            dd($words, $latitude, $longitude, $data);
        } else {
            //error
            return;
        }

    }

    //convert a location (l,l) into a string
    public function reverse(Request $request)
    {
        //need location (csv of lat,lon) and f

        //if csv
//        dd($request->all());
        $locations = explode(',', $request->location);
//        dd($locations);
        $latitude = $locations[0];
        $longitude = $locations[1];
        //if json ... ?
//        $location = json_decode($request->location);
//        $latitude = $location->x;
//        $longitude = $location->y;

        $response = $this->client->request('GET', $this->api_reverse, [
            'query' => [
                'key' => env('W3W_KEY', 'xxxxxxx'),
                'coords' => $latitude . ',' . $longitude,
            ]
        ]);
        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody());
            $words = $data->words;
            $latitude = floatval($data->geometry->lat);
            $longitude = floatval($data->geometry->lng);
            $bounds = [];
            //return a valid ESRI response (class defined)
            dd($words, $latitude, $longitude, $data);
        } else {
            //error
            return;
        }
    }
}