<?php

/** @var \Laravel\Lumen\Routing\Router $router */


$router->group(['prefix' => 'api/series', 'middleware' => 'auth'], function () use ($router) {
    $router->get('', 'SerieController@index');
    $router->get('{id}', 'SerieController@show');
    $router->post('', 'SerieController@store');
    $router->put('{id}', 'SerieController@update');
    $router->delete('{id}', 'SerieController@delete');
    $router->get('{serieId}/episodes', 'EpisodeController@searchForSerie');
});
