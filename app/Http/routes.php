<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});
//http://geocode.arcgis.com/arcgis/rest/services/World/GeocodeServer/geocodeAddresses?

//GeocodeServer is the service

$app->get('GeocodeServer/geocodeAddresses',[
    'as' => 'esri_forward',
    'uses' => 'GeocodeServiceController@forward'
]);

$app->get('GeocodeServer/reverseGeocode',[
    'as' => 'esri_reverse',
    'uses' => 'GeocodeServiceController@reverse'
]);

$app->get('forward',[
    'as' => 'forward',
    'uses' => 'GeocodeServiceController@forward'
]);

$app->get('reverse',[
    'as' => 'forward',
    'uses' => 'GeocodeServiceController@reverse'
]);
