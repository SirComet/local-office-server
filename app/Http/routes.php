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

$app->get('/', function () {
    return view('spa');
});

$app->group([
    'prefix' => 'api',
    'namespace' => 'App\Http\Controllers',
], function () use ($app) {

    $app->get('/status', ['uses' => 'APIController@status']);
    $app->post('/request-token', ['uses' => 'APIController@requestToken']);

});

$app->group([
    'prefix' => 'api',
    'middleware' => 'auth',
    'namespace' => 'App\Http\Controllers',
], function () use ($app) {

    $app->get('/users/{id}', ['uses' => 'UserController@view']);

    $app->get('/users/{id}/mac-addresses', ['uses' => 'MacAddressController@indexForUser']);
    $app->post('/users/{id}/mac-addresses', ['uses' => 'MacAddressController@createForUser']);

    $app->delete('/mac-addresses/{id}', ['uses' => 'MacAddressController@delete']);

});
