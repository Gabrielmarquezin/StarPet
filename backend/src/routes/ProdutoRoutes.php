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
                        echo json_encode(["message" => "valores obrigatorios: photo, preco, quantidade"]);
                
                        return false;
                    }

                    // if($lenght !== "ok" ){
                        
                    //    echo json_encode(["message" => $lenght]);

                    //     return false;
                    // }

                    return true;
                    
              });
        $route->get('/StarPet/backend/products', [$controller, "get"]);

        return $this;
    }

    public function execute()
    {
        $result = $this->route->handler();

        if(!$result){    
            return;
        }

        $data = $result->getData(); 
        

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