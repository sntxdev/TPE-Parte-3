<?php
require_once 'config.php';
require_once 'libs/configRouter.php';

require_once 'app/controllers/gameControllerApi.php';
require_once 'app/controllers/categoryControllerApi.php';


$router = new Router();

/* GAMES routes */
#                 endpoint      verbo     controller           método
$router->addRoute('games',     'GET',    'GameControllerApi', 'get');   # GameControllerApi->get($params)
$router->addRoute('games',     'POST',   'GameControllerApi', 'create'); # GameControllerApi->create($params)
$router->addRoute('games/:ID', 'GET',    'GameControllerApi', 'get');   # GameControllerApi->get($params[":ID"])
$router->addRoute('games/:ID', 'PUT',    'GameControllerApi', 'update'); # GameControllerApi->update($params[":ID"])
$router->addRoute('games/:ID', 'DELETE', 'GameControllerApi', 'delete'); # GameControllerApi->delete($params[":ID"])

/* CATEGORIES routes */
$router->addRoute('categories',     'GET',    'CategoryControllerApi', 'get');
$router->addRoute('categories',     'POST',   'CategoryControllerApi', 'create');
$router->addRoute('categories/:ID', 'GET',    'CategoryControllerApi', 'get');
$router->addRoute('categories/:ID', 'PUT',    'CategoryControllerApi', 'update');
$router->addRoute('categories/:ID', 'DELETE', 'CategoryControllerApi', 'delete');

/* USER routes */
$router->addRoute('user/token', 'GET',    'UserApiController', 'getToken'); # UserApiController->getToken()

#               del htaccess resource=(), verbo con el que llamo GET/POST/PUT/etc
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
