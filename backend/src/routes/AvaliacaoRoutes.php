<?php
namespace Boringue\Backend\routes;

use Boringue\Backend\http\controller\AvaliacaoController;
use Boringue\Backend\http\middlewares\DataVerification;
use Boringue\Backend\routes\contract\RoutesInterface;
use Boringue\Backend\routes\framework\Router;
use Exception;

class AvaliacaoRoutes implements RoutesInterface{
    private $route;
    private $controller;

    public function __construct(Router $route, AvaliacaoController $avalicao_controller)
    {
        $this->route = $route;
        $this->controller = $avalicao_controller;
    }

    public function initRoutes()
    {
        $route = $this->route;
        $controller = $this->controller;

        $route->post('/StarPet/backend/products/messages/add', [$controller, "addMessages"])
              ->before(function(){
                    $middleware = new DataVerification();

                    $body = file_get_contents('php://input');
                    $dados = json_decode($body, true);

                    try{
                        $t = $middleware->ValueLenght($dados['message'], 1500);
                        $vazio = $middleware->EmptyValues($dados);

                        return true;
                    }catch(Exception $e){
                        http_response_code(400);
                        echo json_encode(["message" => $e->getMessage()]);
                        
                        return false;
                    }

              });

        $route->get('/StarPet/backend/products/messages',[$controller, "getMessages"]);

        $route->put('/StarPet/backend/products/messages/update', [$controller, "updateMessage"])
              ->before(function(){
                    $middleware = new DataVerification();

                    $body = file_get_contents('php://input');
                    $dados = json_decode($body, true);

                    try{
                        $t = $middleware->ValueLenght($dados['message'], 1500);
                        $vazio = $middleware->EmptyValues($dados);

                        return true;
                    }catch(Exception $e){
                        http_response_code(400);
                        echo json_encode(["message" => $e->getMessage()]);
                        
                        return false;
                    }
              });

        $route->delete("/StarPet/backend/products/messages/delete", [$controller, "deleteMessage"]);

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
                die();
            }

            if ($data['action']) {
                echo $data['action']($this->route->getParams());
            }
        }
    }
}