<?php

require './vendor/autoload.php';

use Boringue\Backend\config\Database;
use Boringue\Backend\http\controller\AdocaoController;
use Boringue\Backend\http\controller\AvaliacaoController;
use Boringue\Backend\http\controller\PetController;
use Boringue\Backend\http\controller\ProdutoController;
use Boringue\Backend\http\controller\UserController;
use Boringue\Backend\routes\AdocaoRoutes;
use Boringue\Backend\routes\AvaliacaoRoutes;
use Boringue\Backend\routes\framework\Router ;
use Boringue\Backend\routes\PetRoutes;
use Boringue\Backend\routes\ProdutoRoutes;
use Boringue\Backend\routes\UserRoutes;

$path = explode("?", $_SERVER['REQUEST_URI']);
$method = $_SERVER['REQUEST_METHOD'];

$RotasUser = new UserRoutes(new Router($method, $path[0]), new UserController());
$RotasProducts = new ProdutoRoutes(new Router($method, $path[0]), new ProdutoController());
$RotasAvaliacao = new AvaliacaoRoutes(new Router($method, $path[0]), new AvaliacaoController());
$RotasPet = new PetRoutes(new Router($method, $path[0]), new PetController());
$RotasAdocao = new AdocaoRoutes(new Router($method, $path[0]), new AdocaoController());

$RotasUser->initRoutes()
           ->execute();

$RotasProducts->initRoutes()
              ->execute();

$RotasAvaliacao->initRoutes()
               ->execute();

$RotasPet->initRoutes()
         ->execute();

$RotasAdocao->initRoutes()
            ->execute();