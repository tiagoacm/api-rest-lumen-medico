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
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function() use ($router){

    $router->group(['prefix' => 'especialidade'], function() use ($router){
        $router->get('' , 'EspecialidadeController@read');
        $router->get('{id}' , 'EspecialidadeController@readId');
        $router->post('', 'EspecialidadeController@create');
        $router->put('{id}' , 'EspecialidadeController@update');
        $router->delete('{id}' , 'EspecialidadeController@delete');

        $router->get('{especialidadeId}/medico', 'MedicoController@buscaPorEspecialidade');
        
    });

    $router->group(['prefix' => 'medico'], function() use ($router){
        $router->get('' , 'MedicoController@read');
        $router->get('{id}' , 'MedicoController@readId');
        $router->post('', 'MedicoController@create');
        $router->put('{id}' , 'MedicoController@update');
        $router->delete('{id}' , 'MedicoController@delete');
    });


});
