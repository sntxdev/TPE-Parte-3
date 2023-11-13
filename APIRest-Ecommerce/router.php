<?php
require_once 'config.php';
require_once 'libs/configRouter.php';

require_once 'app/controllers/gameControllerApi.php';
require_once 'app/controllers/categoryControllerApi.php';


$router = new Router();

/* GAMES routes */
$router->addRoute('games', 'GET', 'GameControllerApi', 'get');
$router->addRoute('games/:ID', 'GET', 'GameControllerApi', 'get');
$router->addRoute('games/:ID/:sobrecurso', 'GET', 'GameControllerApi', 'get');
$router->addRoute('games', 'POST', 'GameControllerApi', 'create');
$router->addRoute('games/:ID', 'PUT', 'GameControllerApi', 'update');
$router->addRoute('games/:ID', 'DELETE', 'GameControllerApi', 'delete');

/* OFFERS games */
$router->addRoute('offers', 'GET', 'GameControllerApi', 'getOffers');

/* CATEGORIES routes */
$router->addRoute('categories', 'GET', 'CategoryControllerApi', 'get');
$router->addRoute('categories', 'POST', 'CategoryControllerApi', 'create');
$router->addRoute('categories/:ID', 'GET', 'CategoryControllerApi', 'get');
$router->addRoute('categories/:ID', 'PUT', 'CategoryControllerApi', 'update');
$router->addRoute('categories/:ID', 'DELETE', 'CategoryControllerApi', 'delete');

/* USER routes */
$router->addRoute('user/token', 'GET', 'UserApiController', 'getToken');

#               del htaccess resource=(), verbo con el que llamo GET/POST/PUT/etc
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
