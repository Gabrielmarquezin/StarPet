<?php

require './vendor/autoload.php';

use Boringue\Backend\config\Database;
use Boringue\Backend\http\controller\UserController;
use Boringue\Backend\routes\framework\Router ;
use Boringue\Backend\routes\UserRoutes;

$path = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$RotasUser = new UserRoutes(new Router($method, $path), new UserController());

$RotasUser->initRoutes()
           ->Execute();

