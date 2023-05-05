<?php
namespace Boringue\Backend\routes;

use Boringue\Backend\http\controller\PedidoProdutoController;
use Boringue\Backend\http\middlewares\CPF;
use Boringue\Backend\http\middlewares\DataVerification;
use Boringue\Backend\routes\contract\RoutesInterface;
use Boringue\Backend\routes\framework\Router;
use Exception;

class PedidoProdutoRoutes implements RoutesInterface{
    private $route;
    private $controller;

    public function __construct(Router $route, PedidoProdutoController $pedido_controller)
    {
        $this->route = $route;
        $this->controller = $pedido_controller;
    }

    public function initRoutes()
    {
        $route = $this->route;
        $controller = $this->controller;

        $route->post('/StarPet/backend/pedido_produto/add', [$controller, "addPedido"])
              ->before(function(){
                $body = file_get_contents('php://input');
                $dados = json_decode($body, true);

                $pedido_data = [
                    "cod_user" => !isset($dados['cod_user']) ? null : $dados['cod_user'],
                    "cod_produto" => !isset($dados['cod_produto']) ? null : $dados['cod_produto'],
                    "cpf" => !isset($dados['cpf']) ? null : $dados['cpf'],
                    "rua" => !isset($dados['rua']) ? null : $dados['rua'],
                    "bairro" => !isset($dados['bairro']) ? null : $dados['bairro'],
                    "casa_number" => !isset($dados['casa_number']) ? null : $dados['casa_number'],
                    "telefone" => !isset($dados['telefone']) ? null : $dados['telefone'],
                    "email" => !isset($dados['email']) ? null : $dados['email'],
                    "preco" => !isset($dados['preco']) ? null : $dados['preco'],
                    "quantidade" => !isset($dados['quantidade']) ? null : $dados['quantidade'],
                    "nome" => !isset($dados['nome']) ? null : $dados['nome'],
                    "cep" => !isset($dados['cep']) ? null : $dados['cep'],
                    "city" => !isset($dados['city']) ? null : $dados['city'],
                    "uf" => !isset($dados['uf']) ? null : $dados['uf'],
                ];

                $middleware = new DataVerification();
                $CPF = new CPF($pedido_data['cpf']);

                try{
                    $middleware->EmptyValues($pedido_data);
                    $middleware->ValueLenght($pedido_data['cep'], 9);

                    $CPF->lenghtCPF();
                    $CPF->isInvalid();
                    return true;
                }catch(Exception $e){
                    echo json_encode(["message" => $e->getMessage()]);
                    http_response_code(400);
                    return false;
                }

              });

        $route->get('/StarPet/backend/pedido_produto/find', [$controller, "getPedido"]);
        $route->get('/StarPet/backend/pedido_produto/find/categoria', [$controller, "getByCategoria"])
              ->before(function(){
                if(!isset($_GET['categoria'])){
                    echo json_encode(["message" => "falta parametros na url"]);
                    http_response_code(400);
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

