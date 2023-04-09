<?php

require './vendor/autoload.php';

use Boringue\Backend\config\Database;
use Boringue\Backend\http\controller\ProdutoController;
use Boringue\Backend\http\controller\UserController;
use Boringue\Backend\routes\framework\Router ;
use Boringue\Backend\routes\ProdutoRoutes;
use Boringue\Backend\routes\UserRoutes;

$path = explode("?", $_SERVER['REQUEST_URI']);
$method = $_SERVER['REQUEST_METHOD'];

$RotasUser = new UserRoutes(new Router($method, $path[0]), new UserController());
$RotasProducts = new ProdutoRoutes(new Router($method, $path[0]), new ProdutoController());

$RotasUser->initRoutes()
           ->execute();

$RotasProducts->initRoutes()
              ->execute();
