<?php
    require_once 'config.php';
    require_once 'libs/router.php';

    require_once 'app/controllers/gameController.php';


    $router = new Router();

    #                 endpoint      verbo     controller           método
    $router->addRoute('juegos',     'GET',    'GameControllerApi', 'get'   );   # GameControllerApi->getGames($params)
    $router->addRoute('juegos',     'POST',   'GameControllerApi', 'create');
    $router->addRoute('juegos/:ID', 'GET',    'GameControllerApi', 'get'   );   # GameControllerApi->getGames($params[":ID"])
    $router->addRoute('juegos/:ID', 'PUT',    'GameControllerApi', 'update');
    $router->addRoute('juegos/:ID', 'DELETE', 'GameeControllerApi', 'delete');
    
    $router->addRoute('user/token', 'GET',    'UserApiController', 'getToken'   ); # UserApiController->getToken()
    
    #               del htaccess resource=(), verbo con el que llamo GET/POST/PUT/etc
    $router->route($_GET['resource']        , $_SERVER['REQUEST_METHOD']);
