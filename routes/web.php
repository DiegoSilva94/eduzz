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

$router->get('/', function () use ($router) {
    return app(\App\Http\Controllers\CandidatesController::class)->index();
});
$router->get('/cancidates','CandidatesController@index');
$router->post('/cancidates','CandidatesController@store');
$router->put('/cancidates/{id}','CandidatesController@update');
$router->delete('/cancidates/{id}','CandidatesController@destroy');
