<?php
namespace Boringue\Backend\routes;

use Boringue\Backend\http\controller\AdocaoController;
use Boringue\Backend\http\middlewares\CPF;
use Boringue\Backend\http\middlewares\DataVerification;
use Boringue\Backend\routes\contract\RoutesInterface;
use Boringue\Backend\routes\framework\Router;
use Exception;

class AdocaoRoutes implements RoutesInterface{
    private $route;
    private $controller;

    public function __construct(Router $route, AdocaoController $adocao_controller)
    {
        $this->route = $route;
        $this->controller = $adocao_controller;
    }

    public function initRoutes()
    {
        $route = $this->route;
        $controller = $this->controller;

        $route->post('/StarPet/backend/pedido/adocao/add', [$controller, "addPedido"])
              ->before(function(){
                $data = [
                    "cod_user" => filter_input(INPUT_POST, 'cod_user', FILTER_DEFAULT),
                    "cod_pet" => filter_input(INPUT_POST, 'cod_pet', FILTER_DEFAULT),
                    "email" => filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
                    "cpf" => filter_input(INPUT_POST, 'cpf', FILTER_DEFAULT),
                    "rua" => filter_input(INPUT_POST, 'rua', FILTER_DEFAULT),
                    "bairro" => filter_input(INPUT_POST, 'bairro', FILTER_DEFAULT),
                    "telefone" => filter_input(INPUT_POST, 'telefone', FILTER_DEFAULT),
                    "casa" => filter_input(INPUT_POST, 'casa', FILTER_DEFAULT)
                ];

                $middleware1 = new DataVerification();
                $middlewareCPF = new CPF($data['cpf']);

                try{
                    $middleware1->EmptyValues($data);
                    $middleware1->ValueLenght($data['rua'], 100);
                    $middleware1->ValueLenght($data['bairro'], 100);
                    $middlewareCPF->lenghtCPF();
                    $middlewareCPF->isInvalid();

                    return true;
                }catch(Exception $e){
                    http_response_code(400);
                    echo json_encode(["message" => $e->getMessage()]);
                    return false;
                }
              });
        //$route->get('/StarPet/backend/pedido/adocao', [$controller, "getPedido"]);

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