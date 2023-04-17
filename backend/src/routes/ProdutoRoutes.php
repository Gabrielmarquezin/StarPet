<?php
namespace Boringue\Backend\routes;

use Boringue\Backend\http\controller\ProdutoController;
use Boringue\Backend\http\middlewares\ProdutoVerification;
use Boringue\Backend\routes\contract\RoutesInterface;
use Boringue\Backend\routes\framework\Router;

class ProdutoRoutes implements RoutesInterface{
    private $route;
    private $ProdutoController;
    
    public function __construct(Router $route, ProdutoController $ProdutoController)
    {
        $this->route = $route;
        $this->ProdutoController = $ProdutoController;
    }

    public function initRoutes()
    {
        $route = $this->route;
        $controller = $this->ProdutoController;

        $route->post('/StarPet/backend/products/add', [$controller, "add"])
              ->before(function(){
                    $body = file_get_contents('php://input');
                    $dados = json_decode($body, true);

                    $middlewarebefore = new ProdutoVerification($dados);
                    $null = $middlewarebefore->ValuesNotNull();
                    $lenght = $middlewarebefore->ValuesLength();

                    if(!$null){
                        echo json_encode(["message" => "valores obrigatorios: photo, preco, quantidade e categoria"]);       
                        return false;
                    }
                    
                     if($lenght != "ok" ){
                        echo json_encode(["message" => $lenght]);
                         return false; 
                    }

                    return true;
                    
              });

        $route->get('/StarPet/backend/products', [$controller, "get"]);
        $route->get('/StarPet/backend/products/categoria', [$controller, "getByCategoria"]);

        $route->delete('/StarPet/backend/products/delete', [$controller, "delete"])
        ->before(function(){
            $body = file_get_contents('php://input');
            $dados = json_decode($body, true);

            if(empty($dados['idProduto'])){
                echo json_encode(["message" => "campo idProduto nao identificado"]);
                return false;
            }
            return true;
        });

        return $this;
    }

    public function execute()
    {
        $result = $this->route->handler();

        if(!$result){    
            return;
        }

        $data = $result->getData(); 

        if(empty($data['before'])){
            call_user_func(array($data['action'][0], $data['action'][1]));
            return;
        }

        $this->middlewareBefore();
    }

    private function middlewareBefore(){
        $result = $this->route->handler();

        $data = $result->getData(); 

        foreach ($data['before'] as $before) {
            // rodo o middleware
            if (!$before($this->route->getParams())) {
                // se retornar false eu paro a execução do código
                return;
            }

            if ($data['action']) {
                call_user_func(array($data['action'][0], $data['action'][1]));
            }
        }
    }
}