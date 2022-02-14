<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
    $client = new \GuzzleHttp\Client();
    var_dump(config('app.geocoding_api_base_endpoint'));
   // $res = $client->request('GET', 'https://api2.77sol.com.br/busca-cep?estrutura=laje&estado=SP&cidade=Santana de Parnaíba&valor_conta=200&cep=06543-001&latitude=-23.5&longitude=-46.9');
    //echo json_decode($res->getBody())->irradiancia;
    // https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=AIzaSyD_XIgndlfY4GpOWm-lkWMq1V1pQl2lUTo
    //$res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address=02035021&key=AIzaSyD_XIgndlfY4GpOWm-lkWMq1V1pQl2lUTo');
    //print_r(json_decode($res->getBody()));
   
    return $router->app->version();
});

$router->get('testing/{tipo_telhado}/{valor_conta}/{cep}', 'BudgetController@budget');

// API route group
$router->group(['prefix' => 'api'], function () use ($router) {

    // Matches "/api/register
    $router->post('register', 'AuthController@register');

    // Matches "/api/login
    $router->post('login', 'AuthController@login');

    $router->post('budget', 'BudgetController@budget');
 });

 
