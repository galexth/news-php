<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('api/articles', ['uses' => 'ArticleController@index']);
