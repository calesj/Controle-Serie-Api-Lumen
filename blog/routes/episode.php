<?php
/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['prefix' => 'api/episode', 'middleware' => 'auth'], function () use ($router) {
$router->get('', 'EpisodeController@index');
$router->get('{id}', 'EpisodeController@show');
$router->post('', 'EpisodeController@store');
$router->put('{id}', 'EpisodeController@update');
$router->delete('{id}', 'EpisodeController@delete');
});
