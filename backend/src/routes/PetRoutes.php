<?php
namespace Boringue\Backend\routes;

use Boringue\Backend\http\controller\PetController;
use Boringue\Backend\http\middlewares\DataVerification;
use Boringue\Backend\routes\contract\RoutesInterface;
use Boringue\Backend\routes\framework\Router;
use Exception;

class PetRoutes implements RoutesInterface{
    private $route;
    private $controller;

    public function __construct(Router $route, PetController $petController)
    {
        $this->route = $route;
        $this->controller = $petController;
    }

    public function initRoutes()
    {
        $route = $this->route;
        $controller = $this->controller;

        $route->post('/StarPet/backend/products/pet/add', [$controller, "add"])
              ->before(function(){
                $body = file_get_contents('php://input');
                $dados = json_decode($body, true);
                $middleware = new DataVerification();

                $verification = [
                    "photo" => $dados['photo'],
                    "nome" => $dados['nome'],
                    "preco" => $dados['preco'],
                    "quantidade" => $dados['quantidade'],
                ];

                try{
                    $middleware->ValueLenght($dados['descricao'], 1500);
                    $middleware->ValueLenght($dados['nome'], 100);
                    $middleware->ValueLenght($dados['ficha_pet']['alergias'], 500);
                    $middleware->ValueLenght($dados['ficha_pet']['observacoes'], 1000);
                    $middleware->EmptyValues($verification);

                    return true;
                }catch(Exception $e){
                    echo json_encode(["message" => $e->getMessage()]);
                    return false;
                }
              });

        $route->get('/StarPet/backend/products/pet', [$controller, "get"]);

        $route->get('/StarPet/backend/products/pet/categoria', [$controller, "getByCategoria"])
              ->before(function(){
                if(empty($_GET['nome'])){
                    http_response_code(400);
                    echo json_encode("Parametros obrigatorios");

                    return false;
                }
                
                return true;
              });
        
        $route->delete('/StarPet/backend/products/pet/delete', [$controller, "delete"]);
        
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