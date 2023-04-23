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
                $body = file_get_contents('php://input');
                $post = json_decode($body, true);

                $data = [
                    "cod_user" => !isset($post['cod_user']) ? null : $post['cod_user'],
                    "cod_pet" => !isset($post['cod_pet']) ? null  : $post['cod_pet'],
                    "email" => !isset($post['email']) ? null : $post['email'],
                    "cpf" => !isset($post['cpf']) ? null : $post['cpf'],
                    "rua" => !isset($post['rua']) ? null : $post['rua'],
                    "bairro" => !isset($post['bairro']) ? null : $post['bairro'],
                    "telefone" => !isset($post['telefone']) ? null : $post['telefone'],
                    "casa_number" =>!isset($post['casa_number']) ? null : $post['casa_number']
                ];

                $middleware1 = new DataVerification();
                $middlewareCPF = new CPF($data['cpf']);

                try{
                    $middleware1->EmptyValues($data);
                    $middleware1->ValueLenght($data['rua'], 100);
                    $middleware1->ValueLenght($data['bairro'], 100);
                    $middlewareCPF->lenghtCPF();
                    $middlewareCPF->isInvalid();

                    if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
                        throw new Exception("email invalido");
                    }

                    return true;
                }catch(Exception $e){
                    http_response_code(400);
                    echo json_encode(["message" => $e->getMessage()]);
                    return false;
                }
              });
        $route->get('/StarPet/backend/pedido/adocao', [$controller, "getPedido"]);
              
        $route->get('/StarPet/backend/pedido/adocao/pet', [$controller, "getPedidoByPet"])
              ->before(function(){
                if(!isset($_GET['cod'])){
                    http_response_code(400);
                    echo json_encode("falta parametros na url");
                    return false;
                }
                return true;
              });
        
        
        $route->get('/StarPet/backend/pedido/adocao/pet/categoria', [$controller, "getPedidoByCategoria"])
              ->before(function(){
                if(!isset($_GET['nome'])){
                    http_response_code(400);
                    echo json_encode("falta parametros na url");
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
                die();
            }

            if ($data['action']) {
                echo $data['action']($this->route->getParams());
            }
        }
    }
}